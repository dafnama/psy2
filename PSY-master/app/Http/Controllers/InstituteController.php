<?php

namespace App\Http\Controllers;


use App\Models\Institute;
use App\Models\Psychologist;
use App\Models\Shapah;
use Illuminate\Support\Facades\Auth;


class InstituteController extends Controller {

	public function index() {
        $institutes = $this->filterRelevantInstitutes(Auth::user());
		return view( 'indexes.institute_page',  ['institutes'=> $institutes ]);
	}

	public function edit( Institute $institute ) {
		$shapahs = Shapah::all();
		$is_new = false;
		return view( 'forms.institute_new', compact( 'institute', 'shapahs', 'is_new' ) );
	}

	public function update(Institute $institute ) {
		$form_data = \Request::all();
		$institute->fill( $form_data );
		$institute->save();

        $standart_hours = $this->calc_hours($institute);
        \DB::table('institutes')
            ->where('id', $institute->id)
            ->update(['standart_before_cover' => $standart_hours]);

		return redirect()->route( 'institute.index' );
	}

	public function show(Institute $institute ) {
		return view( 'singles.educational_institute', compact( 'institute' ) );
	}

	Public function destroy(Institute $institute) {
		$institute->delete();
		return redirect()->route( 'institute.index' );
	}

   	public function create() {
		$institute = new Institute();
	    $view_data = $this->getInstituteMetaData();
		$view_data['institute'] = $institute;
		$view_data['is_new'] = true;

		return view( 'forms.institute_new', $view_data );
	}

	public function store() {
		$user_data = $this->getFormUserData();
		$institute = new Institute($user_data);
		$institute->save();

        $standart_hours = $this->calc_hours($institute);

        \DB::table('institutes')
            ->where('id', $institute->id)
            ->update(['standart_before_cover' => $standart_hours]);

		return redirect()->route( 'institute.show', $institute->id );
	}

	private function getFormUserData() {
		return \Request::all();
	}

	private function getInstituteMetaData() {
		$shapahs = Shapah::all();

		return compact( 'shapahs' );
	}

	private function filterRelevantInstitutes( Psychologist $user ) {
		if ( $user->permission == 3 ) {
            $institutes = Institute::where('name', '<>', "דיווח כללי")->paginate(5);
            return $institutes;
		}

		return $this->getInstitutesForPsychologist( $user );
	}

	function getInstitutesForPsychologist( Psychologist $psychologist ) {
		return \DB::table( 'psychologist_shapah' )
		         ->join( 'shapahs', 'shapahs.id', '=', 'psychologist_shapah.shapah_id' )
		         ->join( 'institutes', 'institutes.shapah_id', '=', 'shapahs.id' )
		         ->where( 'psychologist_shapah.psychologist_id', '=', $psychologist->id )
		         ->select('institutes.*', 'shapahs.shapah_name as shapah_name')->paginate(5);
	}

    function calc_hours(Institute $ins){
        $first_standart = ($ins->number_of_alef_students + $ins->number_of_kindergarten_children) / 500;
        $second_standart = ($ins->number_of_non_alef_students ) / 1000;
        $third_standart = ($ins->number_of_special_students) / 300;

        $all_standarts = $first_standart + $second_standart + $third_standart;
        return $all_standarts;
    }
}
