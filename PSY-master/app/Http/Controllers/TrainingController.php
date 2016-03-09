<?php

namespace App\Http\Controllers;

use App\Models\Match;
use App\Models\Psychologist;
use App\Models\Visit;
use App\Models\Institute;
use App\Models\Training;
use App\Models\Shapah;
use Illuminate\Support\Facades\Auth;

class TrainingController extends Controller {
	public function index() {
       $trainings = Training::all();
		return view( 'indexes.training', compact( 'trainings' ));
	}

        
        public function create() {
            $training  = new Training();
            $is_new = true;
            $psychologists = $this->getShapahPsychologists( Auth::user() );
            return view( 'forms.new_training', compact( 'training', 'is_new' ,'psychologists') );
	}
        
        public function update( Training $training ) {
		$input_data = $this->getFormUserData();
		$training->fill( $input_data );
		$training->save();
		//$this->setUserPermission( $psychologist );
		return redirect()->route( 'training.index' );
	}
        
        public function edit( Training $training ) {
		$is_new = false;
                $psychologists = $this->getShapahPsychologists( Auth::user() );
		return view( 'forms.new_training', compact( 'training', 'is_new','psychologists' ) );
	}
        
        public function store() {
		$user_data = \Request::all();
		$training = new Training($user_data);
                $training->save();
		return redirect()->route( 'training.index' );
	}

        public function destroy(Training $train) {
		$train->delete();
		return redirect()->route( 'training.index' );
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
