<?php
namespace App\Http\Controllers;

use Log;
use App\Models\Years;
use App\Models\Training_kinds;
use App\Models\ProfessionalStatus;
use App\Models\Psychologist;

class AdminController extends Controller {
    protected $request;

   public function __construct(\Illuminate\Http\Request $request)
   {
       $this->request = $request;
   }
       
    public function create($error=null) {
        $years  = new Years;
        $is_new = true;
        $years= $years->get();
        $new_year= new Years;
        $ProfessionalStatus  = new ProfessionalStatus;
        $ProfessionalStatus= $ProfessionalStatus->get();
        $new_ProfessionalStatus  = new ProfessionalStatus;
        $training_kinds= new Training_kinds();
        $training_kinds= $training_kinds->get();
        $new_training_kind= new Training_kinds();
        return view( 'forms.admin', compact( 'years', 'is_new', 'new_year','ProfessionalStatus','new_ProfessionalStatus','training_kinds','new_training_kind','error') );
    }
        
  
        
    public function store( $data=null) {
        $user_data = \Request::all();
        //store new year
        if (isset($user_data['value'])){
            $years = new Years($user_data);
            $years->save();
        }//store new professional status
        else if (isset($user_data['professional_status_description'])){
           $ProfessionalStatus  = new ProfessionalStatus($user_data); 
           $ProfessionalStatus->save();
        }
        else { //store new training status
            $training_kind= new Training_kinds($user_data);
            $training_kind->save();
        }
        return $this->create();
    }


    public function destroy( $data) {
        $user_data = \Request::all();
        $error='';
        //delete year
        if (isset($user_data) && $user_data['type']=='year'){
            $years= new Years;
            $years=$years->where('id', '=',$data)->first();
            $years->delete();
        }//delete professional status
        else if (isset($user_data) && $user_data['type']=='status'){
            $psychologist= new Psychologist();
            $psychologist=$psychologist->where('professional_status_id', '=',$data)->count();
            if(isset($psychologist) && $psychologist>0){
                $error="שגיאה- לא ניתן למחוק סטאטוס זה מכיוון שקיימות רשומות לפסיכולוגים המכילות סטאטוס זה";
            }
            else {
                $ProfessionalStatus= new ProfessionalStatus;
                $ProfessionalStatus=$ProfessionalStatus->where('id', '=',$data)->first();
                $ProfessionalStatus->delete();
            }
        }
        else{//delete training status
             $training_kinds= new Training_kinds();
             $training_kinds=$training_kinds->where('id', '=',$data)->first();
             $training_kinds->delete();
        }
        return $this->create($error);
    }


       
	
}
