<?php

namespace App\Http\Controllers;

use App\Models\Psychologist;
use App\Models\Shapah;
use App\Models\Visit;
use App\Models\ProfessionalStatus;
use App\Models\PsychologistRole;
use App\User;

class PsychologistController extends Controller {

	public function index() {
		$all_psychologists = Psychologist::paginate(5);

		return view( 'indexes.psy_page', [ 'psychologists' => $all_psychologists ] );
	}

	public function edit( Psychologist $psychologist ) {
		$related_data                 = $this->getPsychologistMetaFieldsData();
		$related_data['psychologist'] = $psychologist;
		$related_data['is_new']       = false;
		$related_data['form_url']     = 'psychologist.update';
		$related_data['add_shapah']   = 0;

		// return $shapahs;
		return view( 'forms.psy_new', $related_data );
	}

	public function update( Psychologist $psychologist ) {
		$input_data = $this->getFormUserData();
		$psychologist->fill( $input_data );
		$psychologist->save();



		$this->setUserPermission( $psychologist );


		return redirect()->route( 'psychologist.index' );
	}

	public function show( Psychologist $psychologist ) {
        $all_visits = Visit::all();
		return view( 'singles.psychologist', compact( 'psychologist', 'all_visits' ) );
	}

	public function create() {
		$psychologist                 = new Psychologist();
		$related_data                 = $this->getPsychologistMetaFieldsData();
		$related_data['psychologist'] = $psychologist;
		$related_data['is_new']       = true;
		$related_data['form_url']     = 'psychologist.store';
		$related_data['add_shapah']   = 0;

		return view( 'forms.psy_new', $related_data );
	}

	public function store() {
		$user_data    = $this->getFormUserData();
		$psychologist = new Psychologist( $user_data );
		$this->setUserPermission( $psychologist );

		return redirect()->route( 'psychologist.show', $psychologist->id );
	}

	public function destroy( Psychologist $psychologist ) {
		$psychologist->delete();
		\DB::table( 'psychologist_shapah' )->where( 'psychologist_id', '=', $psychologist->id )->delete();

		return redirect()->route( 'psychologist.index' );
	}

	/**
	 * @return array
	 */
	private function getPsychologistMetaFieldsData() {
		$shapahs               = Shapah::all();
		$professional_statuses = ProfessionalStatus::all();
		$roles                 = PsychologistRole::all();

		return compact( 'shapahs', 'professional_statuses', 'roles' );
	}

	/**
	 * @return array
	 */
	private function getFormUserData() {
		$input_data             = \Request::except( 'shapah_id', 'add_shapah' );
		$input_data['password'] = bcrypt( $input_data['password'] );

		return $input_data;
	}

	private function setUserPermission( Psychologist & $psychologist ) {
		$shapah_id = \Request::Only( 'shapah_id' )['shapah_id'];
		$permission = 1;
		$is_manager = 0;
		// is manager
		if ( $psychologist->psychologist_role_id == 1 ) {
			$permission = 2;
			//set the record in psychologist_shapah table
			$is_manager = 1;
		}
		// isn't a manager
		$psychologist->permission = $permission;
		$psychologist->save();
		$add_shapah = \Request::input('add_shapah');
		if ( $add_shapah == 'on' ) {
			if ( !$psychologist->hasShapah(\Request::input('shapah_id')) ) {
				$psychologist->shapahs()->attach([$shapah_id => ['is_manager' => $is_manager]]);
			}
		} else {
			$psychologist->shapahs()->sync( [ $shapah_id => [ 'is_manager' => $is_manager ] ] );
		}

	}
}
