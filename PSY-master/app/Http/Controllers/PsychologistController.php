<?php
namespace App\Http\Controllers;

use App\Models\Psychologist;
use App\Models\Shapah;
use App\Models\Visit;
use App\Models\ProfessionalStatus;
use App\Models\PsychologistRole;
use App\Models\Training;
use Illuminate\Support\Facades\Auth;
use App\User;
use Input;
use Log;
use DB;

class PsychologistController extends Controller {

    public function index() {
        $user=Auth::user();
        $Psychologists= new Psychologist;
        //filters
        if ( Input::has('filter_shaph') && trim(Input::get('filter_shaph')) !== '' ){
            $list_psy=DB::table('psychologists')->
                    join('psychologist_shapah', 'psychologists.id', '=', 'psychologist_shapah.psychologist_id')->
                    where('shapah_id', '=', Input::get('filter_shaph'))->lists('psychologists.id');
            $psy_array=array();
            foreach ($list_psy as $psy){
                $psy_array[]=$psy;
            }
            $Psychologists = $Psychologists->whereIn('id', $psy_array);
        }
        if (Input::has('filter_status') && trim(Input::get('filter_status')) !== ''){
            $Psychologists = $Psychologists->where('professional_status_id', '=', Input::get('filter_status'));
        }
        if (Input::has('filter_role') && trim(Input::get('filter_role')) !== ''){
            $Psychologists = $Psychologists->where('psychologist_role_id',"=",(string)Input::get('filter_role'));
        }$psychologists_array=array();
        if (Input::has('filter_year') && trim(Input::get('filter_year')) !== ''){
            $psychologists_array=DB::table('matches')->
                    join('Trainings', 'Trainings.guided_id ', '=', 'matches.psychologist_id')->
                    where('match_year','=',Input::get('filter_year'))->
                    orWhere('training_year','=',Input::get('filter_year'))->lists('psychologist_id');
            $Psychologists = $Psychologists->whereNotIn('id', $psychologists_array);
        }
        //permission
        if ($user->permission!=3){
            $psychologists=$this->getShapahPsychologists($user);
            $psychologists_array=array();
            foreach ($psychologists as $psy){
                $psychologists_array[]=(int)$psy->id;
            }
            $Psychologists = $Psychologists->whereIn('id', $psychologists_array);
        }
        $all_psychologists=$Psychologists->get();
        return view( 'indexes.psy_page', [ 'psychologists' => $all_psychologists] );
    }

    public function edit( Psychologist $psychologist ) {
            $related_data                 = $this->getPsychologistMetaFieldsData();
            $related_data['psychologist'] = $psychologist;
            $related_data['is_new']       = false;
            $related_data['form_url']     = 'psychologist.update';
            $related_data['add_shapah']   = 0;
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
        $training_num= new Training;
        $training_num=$training_num->where('guided_id', '=',$psychologist->id)->orwhere('guide_id', '=',$psychologist->id)->count();
        if ($training_num > 0){
            $error="שגיאה: לפסיכולוג ".$psychologist->last_name." ".$psychologist->first_name." קיימים מפגשי הדרכה";
            Log::info("Psychologist have training");
        }
        else {
            $psychologist->delete();
            \DB::table( 'psychologist_shapah' )->where( 'psychologist_id', '=', $psychologist->id )->delete();
        }
        $psychologists=Psychologist::get();
        return view( 'indexes.psy_page', compact( 'psychologists' ,'error') );
        //return redirect()->route( 'psychologist.index' );
    }


    private function getPsychologistMetaFieldsData() {
            $shapahs               = Shapah::all();
            $professional_statuses = ProfessionalStatus::all();
            $roles                 = PsychologistRole::all();

            return compact( 'shapahs', 'professional_statuses', 'roles' );
    }


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
            else if ($psychologist->psychologist_role_id == 6 ){
                if ( \Auth::user()->permission==3 ){
                    $permission = 3;
                    $is_manager = 1;
                }
                else {
                    $psychologist->psychologist_role_id=2;
                }

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
    
        private function getShapahPsychologists( Psychologist $psychologist ) {
           $psychologists = [];
           $main_shapah = $this->getMainShapah($psychologist);
           foreach ($main_shapah->psychologists as $shap_psy){
           $psychologists[$shap_psy->id] = $shap_psy;
           }
           return $psychologists;
   }
        
    public function getMainShapah(Psychologist $manager){
        $main_shapah = new Shapah();
        foreach ($manager->shapahs as $shapah){
            if ($manager->shapahs()->where('shapah_id',$shapah->id)->first()){
                $main_shapah = $shapah;
            }
        }
    return $main_shapah;
}
}
