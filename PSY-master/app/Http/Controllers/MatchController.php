<?php 

namespace App\Http\Controllers;

use App\Models\Institute;
use App\Models\Match;
use App\Models\Psychologist;
use App\Models\Shapah;
use Illuminate\Support\Facades\Auth;

class MatchController extends Controller {
    public function index() {
        $hours_for_matches = 0;
        $used_hours = 0;
        if (Auth::user()->permission == 2){
            $main_shapah = $this->getMainShapah( Auth::user() );
            $hours_for_matches = $main_shapah->getStandarts($main_shapah) * 42.5;

            $matches = $this->getShapahMatches( Auth::user() );
            foreach ($matches as $mat){
                if ($mat->match_year == 'התשע"ו'){
                    $used_hours = $used_hours + $mat->match_hours;
                }
            }
        }
        else{
            $all_shapah = Shapah::all();
            foreach ($all_shapah as $shapah){
                $hours_for_matches = $hours_for_matches + ( $shapah->getStandarts($shapah) *42.5 );
            }
            $matches = Match::all();
            foreach ($matches as $mat){
                if ($mat->match_year == 'התשע"ו'){
                    $used_hours = $used_hours + $mat->match_hours;
                }
            }

        }
        $psy =Auth::user();
		return view( 'indexes.match', compact( 'matches' ,'hours_for_matches','used_hours', 'psy') );
	}

    public function create() {
		$match  = new Match();
		$is_new = true;
		$institutes = $this->getShapahInstitutes( Auth::user() );
        $psychologists = $this->getShapahPsychologists( Auth::user() );

		return view( 'forms.new_match', compact( 'match', 'is_new', 'institutes' ,'psychologists') );
	}

    public function store() {
		$user_data = \Request::all();
		$match = new Match($user_data);
		$match->save();
		return redirect()->route( 'match.index', $match->id );
	}

    public function destroy(Match $mat) {

		$mat->delete();

		return redirect()->route( 'match.index' );
	}

    private function getShapahInstitutes( Psychologist $psychologist ) {
		$institutes = [];
		$main_shapah = $this->getMainShapah($psychologist);
                foreach ($main_shapah->institutes as $shap_ins){
			         $institutes[] = $shap_ins;
            }

		return $institutes;
	}

    private function getShapahPsychologists( Psychologist $psychologist ) {
		$psychologists = [];
		$main_shapah = $this->getMainShapah($psychologist);
                foreach ($main_shapah->psychologists as $shap_psy){
			         $psychologists[$shap_psy->id] = $shap_psy;
                }


		return $psychologists;
	}

    public function getShapahMatches(Psychologist $manager){
        $matches = [];
        $all_matches = Match::all();
        foreach ($all_matches as $match){
            if ($match->institute->shapah_id == $this->getMainShapah($manager)->id){
                $matches[$match->id] = $match;
            }
        }
        return $matches;
    }

    public function getMainShapah(Psychologist $manager){
        $main_shapah = new Shapah();
        foreach ($manager->shapahs as $shapah){
            if ($manager->shapahs()->where('shapah_id',$shapah->id)->first()->pivot->is_manager){
                $main_shapah = $shapah;
            }
        }
        return $main_shapah;
    }
}
