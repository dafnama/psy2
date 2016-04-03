<?php

namespace App\Http\Controllers;
use Log;
use App\Models\Match;
use App\Models\Psychologist;
use App\Models\Visit;
use App\Models\Institute;
use App\Models\Training;
use App\Models\Shapah;
use Illuminate\Support\Facades\Auth;
use App\Models\Session;
use App\Models\Years;
use Input;

class TrainingController extends Controller {
	public function index() {
            $user=Auth::user();
            $trainings= new Training;
            if ( Input::has('filter_guid') && trim(Input::get('filter_guid')) !== '' ){
                $trainings = $trainings->where('guide_id', '=', Input::get('filter_guid'));
            }
            if ( Input::has('filter_guided') && trim(Input::get('filter_guided')) !== '' ){
                $trainings = $trainings->where('guided_id', '=', Input::get('filter_guided'));
            }
            if (Input::has('filter_year') && trim(Input::get('filter_year')) !== ''){
                $trainings = $trainings->where('training_year', '=', (string)Input::get('filter_year'));
            }
            if (Input::has('filter_hours') && trim(Input::get('filter_hours')) !== ''){
                $trainings = $trainings->where('training_hours ', '=', Input::get('filter_hours'));
            }
            //permission
            if ($user->permission!=3){
                $psychologists=$this->getShapahPsychologists($user);
                $psychologists_array=array();
                foreach ($psychologists as $psy){
                    $psychologists_array[]=(int)$psy->id;
                }
                $trainings = $trainings->whereIn('guided_id', $psychologists_array);
            }
            $trainings = $trainings->get();
            return view( 'indexes.training', compact( 'trainings' ));
	}

        
        public function create() {
            $training  = new Training();
            $is_new = true;
            $user=Auth::user();
            if ($user->permission!=3){
                $psychologists = $this->getShapahPsychologists( $user);
            }
            else {
                 $psychologists= new Psychologist;
                 $psychologists= $psychologists->get();
            }
            $form_url     = 'training.store';
            $array_years=new Years;
            $array_years= $array_years->get();
            return view( 'forms.new_training', compact( 'training', 'is_new' ,'psychologists','form_url','array_years') );
	}
        
        public function update( $train ) {
		$input_data = Input::All();
                $training= new Training;
                $training=$training->where('id', '=', $train)->first();
		$training->fill($input_data);
                $training->save();
		return redirect()->route( 'training.index' );
	}
        
        
        public function edit($train ) {
                $training= new Training;
                $training=$training->where('id', '=', $train)->first();
                if (!($training)){
                    $trainings = $trainings->get();
                }
		$is_new = false;
                $psychologists = $this->getShapahPsychologists( Auth::user() );
                $form_url    = 'training.update';
                $array_years=new Years;
                $array_years= $array_years->get();
		return view( 'forms.new_training', compact( 'training', 'is_new','psychologists','form_url' ,'array_years') );
	}

        public function store() {
		$user_data = \Request::all();
		$training = new Training($user_data);
                $training->save();
		return redirect()->route( 'training.index' );
	}
        
        
        public function destroy($training ) {
                $session_num= new Session;
                $session_num=$session_num->where('trining_id', '=',$training)->count();
                if ($session_num > 0){
                    $error="שגיאה: להדרכה זאת קיים דיווח מפגש הדרכה";
                    Log::info("Training have sessions");
                }
                else {
                    $train= new Training;
                    $train=$train->where('id', '=', $training)->first();
                    $train->delete();
                }
                $trainings= new Training;
                $trainings= $trainings->get();
                return view( 'indexes.training', compact( 'trainings' ,'error') );
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
