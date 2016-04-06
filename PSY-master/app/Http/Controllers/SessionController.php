<?php

namespace App\Http\Controllers;
use Log;
use App\Models\Match;
use App\Models\Psychologist;
use App\Models\Visit;
use App\Models\Institute;
use App\Models\Training;
use App\Models\Session;
use App\Models\Shapah;
use Illuminate\Support\Facades\Auth;
use Request;
use Input;
class SessionController extends Controller {
protected $request;

   public function __construct(\Illuminate\Http\Request $request)
   {
       $this->request = $request;
   }

   public function myFunc()
   {
       $input = $this->request->all();
       return $input;
   }


	public function index() {
            $sessions= new Session;
            if ( Input::has('filter_guid') && trim(Input::get('filter_guid')) !== '' ){
                $trains= new Training;
                $trains=$trains->where('guide_id', '=', Input::get('filter_guid'))->get();
                $train_array=array();
                foreach ($trains as $train){
                    $train_array[]=(int)$train->id;
                    
                }
                $sessions = $sessions->whereIn('trining_id', $train_array);
            }
            if (Input::has('filter_date') && trim(Input::get('filter_date')) !== ''){
                $sessions = $sessions->where('training_date', '>=', Input::get('filter_date'));
            }
            if (Input::has('filter_to_date') && trim(Input::get('filter_to_date')) !== ''){
                $sessions = $sessions->where('training_date', '<=', Input::get('filter_to_date'));
            }
            if (Input::has('filter_kind') && trim(Input::get('filter_kind')) !== ''){
                $sessions = $sessions->where('kind',"=",(string)Input::get('filter_kind'));
            }
            $user= Auth::user();
            //psycologist or manager
            if ($user->permission!=3){
                $trains_array=array();
                $trains= new Training;
                // manager
                if ($user->permission==2){
                    $psychologists=$this->getShapahPsychologists($user); 
                    $psy_array=array();
                    foreach ($psychologists as $psy){
                        if (!in_array($psy->id, $psy_array)){
                            $psy_array[]=$psy->id;
                        }
                    }
                    $trains=$trains->whereIn('guided_id', $psy_array)->get();
                    foreach ($trains as $train){
                        $trains_array[]=$train->id;
                    }  
                    $sessions = $sessions->whereIn('trining_id', $trains_array);
                }
                //psycologist
                else {
                    $trains=$trains->where('guided_id', '=',$user->id)->orWhere('guide_id', '=',$user->id)->get();
                    foreach ($trains as $train){
                        $trains_array[]=$train->id;
                    }
                    $sessions = $sessions->whereIn('trining_id', $trains_array);
                }
            }
            $sessions = $sessions->get();
            return view( 'indexes.session', compact( 'sessions'));
	}

        
        public function create() {
            $session  = new Session;
            $is_new = true;
            return view( 'forms.new_session', compact( 'session', 'is_new') );
	}
        
        public function update( Session $session ) {
		$input_data = $this->getFormUserData();
		$session->fill( $input_data );
		$session->save();
		//$this->setUserPermission( $psychologist );
		return redirect()->route( 'training.index' );
	}
        
        public function edit( Session $session ) {
		$is_new = false;
		return view( 'forms.new_session', compact( 'session', 'is_new' ) );
	}
        
        public function store() {
		$user_data = \Request::all();
		$session = new Session($user_data);
                $session->save();
		return redirect()->route( 'session.index' );
	}

        public function destroy( $ses) {
                $session= new Session;
                $session=$session->where('id', '=',$ses)->first();
                $session->delete();
		return redirect()->route( 'session.index' );
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
