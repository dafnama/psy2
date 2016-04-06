<?php
namespace App\Http\Controllers;

use App\Models\Match;
use App\Models\Psychologist;
use App\Models\Visit;
use App\Models\Institute;
use Illuminate\Support\Facades\Auth;
use App\Models\Shapah;
use Input;

class VisitController extends Controller {
    public function index() {
         $visits= new Visit;
         $match_array=array();
         $match= new Match;
        //filter psycologist 
        if ( Input::has('filter_psy') && trim(Input::get('filter_psy')) !== '' ){
            $match=$match->where('psychologist_id', '=', Input::get('filter_psy'))->get();
            foreach ($match as $mat){
                $match_array[]=(int)$mat->id;    
            }
            $visits = $visits->whereIn('match_id', $match_array);
        }
        //filter institute 
        if ( Input::has('filter_institute') && trim(Input::get('filter_institute')) !== '' ){
            $match=$match->where('institute_id', '=', Input::get('filter_institute'))->get();
            $match_array=array();
            foreach ($match as $mat){
                $match_array[]=(int)$mat->id;   
            }
            $visits = $visits->whereIn('match_id', $match_array);
        }
        //filter from date 
        if (Input::has('filter_date') && trim(Input::get('filter_date')) !== ''){
            $visits = $visits->where('date', '>=', Input::get('filter_date'));
        }
        //filter until date 
        if (Input::has('filter_to_date') && trim(Input::get('filter_to_date')) !== ''){
            $visits = $visits->where('date', '<=', Input::get('filter_to_date'));
        }
        //filter activity 
        if (Input::has('filter_activity') && trim(Input::get('filter_activity')) !== ''){
            $visits = $visits->where('activity',"=",(string)Input::get('filter_activity'));
        }
        //check permission
        $user= Auth::user();
        //psycologist or manager
        if ($user->permission!=3){
            // manager
            if ($user->permission==2){
                $psychologists=$this->getShapahPsychologists($user); 
                $psy_array=array();
                foreach ($psychologists as $psy){
                    if (!in_array($psy->id, $psy_array)){
                        $psy_array[]=$psy->id;
                    }
                }
                $match= new Match;
                $match=$match->whereIn('psychologist_id', $psy_array)->get();
                foreach ($match as $mat){
                    $match_array[]=$mat->id;
                }  
                $visits = $visits->whereIn('match_id', $match_array);
            }
            //psycologist
            else {
                $match=$match->where('psychologist_id', '=',$user->id)->get();
                foreach ($match as $mat){
                    $match_array[]=$mat->id;
                }
                $visits = $visits->whereIn('match_id', $match_array);
            }
        }
        $visits = $visits->get();
            return view( 'indexes.visit', compact( 'visits' ) );
    }

    public function create() {
        $visit  = new Visit();
        $is_new = true;
        $institutes = $this->getPsychologistInstitutes( \Auth::user() );
        return view( 'forms.visit', compact( 'visit', 'is_new', 'institutes' ) );
    }

    public function store() {
        list($form_data, $visit_match) = $this->getFormData();
        $visit = new Visit( $form_data );
        $visit->match()->associate($visit_match);
        $const_psy_id = $visit_match->psychologist_id;
        //$visit->psychologist_id_const = Psychologist::find($const_psy_id)->id;

        $const_institute_id = $visit_match->institute_id;
        $visit->intitute_name_const = Institute::find($const_institute_id)->name;
        $visit->save();
            return redirect()->route( 'visit.index' );
    }

    public function show( Visit $visit ) {
        return view( 'singles.psychologist-visit', compact( 'visit' ) );
    }

    public function edit( Visit $visit ) {
        $is_new = false;
        $institutes = $this->getPsychologistInstitutes( Auth::user() );
        return view( 'forms.visit', compact( 'visit', 'is_new' ,'institutes') );

    }

    public function update( Visit $visit ) {
        list($form_data, $visit_match) = $this->getFormData();
        $visit->fill( $form_data );
        $visit->match()->associate($visit_match);
        $const_psy_id = $visit_match->psychologist_id;
        //$visit->psychologist_id_const = Psychologist::find($const_psy_id)->id;
        $visit->match_id=$visit_match->id;

        $const_institute_id = $visit_match->institute_id;
        $visit->intitute_name_const = Institute::find($const_institute_id)->name;
        $visit->save();
        return redirect()->route( 'visit.index', $visit->id );
    }

    private function getMatchForPsychologist($institute_id) {
            // todo Change hard- coded psychologist id
            return \Auth::user()->matches()->whereInstituteId( $institute_id )->first();
    }

    private function getPsychologistInstitutes( Psychologist $psychologist ) {
            $institutes = [];
            foreach ( $psychologist->matches as $match ) {
                    $institutes[$match->institute->id] = $match->institute;
            }
            return $institutes;
    }

    public function destroy(Visit $vis) {
            $vis->delete();
            return redirect()->route( 'visit.index' );
    }

    private function getFormData() {
        $form_data = \Request::except('institute_id');
        $visit_match = $this->getMatchForPsychologist(\Request::input('institute_id'));
        return [$form_data, $visit_match];
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
