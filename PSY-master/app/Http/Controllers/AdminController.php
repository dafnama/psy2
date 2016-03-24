<?php

namespace App\Http\Controllers;

use Log;
use App\Models\Years;
use App\Models\ProfessionalStatus;

class AdminController extends Controller {
protected $request;

   public function __construct(\Illuminate\Http\Request $request)
   {
       $this->request = $request;
   }
       
        public function create() {
            $years  = new Years;
            $is_new = true;
            $years= $years->get();
            $new_year= new Years;
            $ProfessionalStatus  = new ProfessionalStatus;
            $ProfessionalStatus= $ProfessionalStatus->get();
            $new_ProfessionalStatus  = new ProfessionalStatus;
            return view( 'forms.admin', compact( 'years', 'is_new', 'new_year','ProfessionalStatus','new_ProfessionalStatus') );
	}
        
  
        
        public function store( $data=null, $type=null) {
		$user_data = \Request::all();
                if (isset($user_data['value'])){
                    $years = new Years($user_data);
                    $years->save();
                }
                else {
                   $ProfessionalStatus  = new ProfessionalStatus($user_data); 
                   $ProfessionalStatus->save();
                }
		
               
		$years  = new Years;
                $is_new = true;
                $years= $years->get();
                $new_year= new Years;
                $ProfessionalStatus  = new ProfessionalStatus;
                $ProfessionalStatus= $ProfessionalStatus->get();
                $new_ProfessionalStatus  = new ProfessionalStatus;
                return view( 'forms.admin', compact( 'years', 'is_new', 'new_year','ProfessionalStatus','new_ProfessionalStatus') );
	}
        
    
        public function destroy( $data, $type=null) {
            $user_data = \Request::all();
            if (isset($user_data) && $user_data['type']=='year'){
                $years= new Years;
                $years=$years->where('id', '=',$data)->first();
                $years->delete();
            }
            else {
                $ProfessionalStatus= new ProfessionalStatus;
                $ProfessionalStatus=$ProfessionalStatus->where('id', '=',$data)->first();
                $ProfessionalStatus->delete();
            }
		$years  = new Years;
                $is_new = true;
                $years= $years->get();
                $new_year= new Years;
            $ProfessionalStatus  = new ProfessionalStatus;
            $ProfessionalStatus= $ProfessionalStatus->get();
            $new_ProfessionalStatus  = new ProfessionalStatus;
            return view( 'forms.admin', compact( 'years', 'is_new', 'new_year','ProfessionalStatus','new_ProfessionalStatus') );
	}
        
        
       
	
}
