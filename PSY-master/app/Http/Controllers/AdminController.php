<?php

namespace App\Http\Controllers;

use App\Models\Years;

class AdminController extends Controller {
protected $request;

   public function __construct(\Illuminate\Http\Request $request)
   {
       $this->request = $request;
   }

    public function index() {
        $years  = new Years;
        $is_new = true;
        $years= $years->get();
        return view( 'forms.admin', compact( 'years', 'is_new'));
    }

        
        public function create() {
            $years  = new Years;
            $is_new = true;
            $years= $years->get();
            $new_year= new Years;
            return view( 'forms.admin', compact( 'years', 'is_new', 'new_year') );
	}
        
  
        
        public function store() {
		$user_data = \Request::all();
		$years = new Years($user_data);
                $years->save();
		$years  = new Years;
                $is_new = true;
                $years= $years->get();
                $new_year= new Years;
                return view( 'forms.admin', compact( 'years', 'is_new', 'new_year'));
	}

        public function destroy( $Year) {
                $years= new Years;
                $years=$years->where('id', '=',$Year)->first();
                $years->delete();
		$years  = new Years;
                $is_new = true;
                $years= $years->get();
                $new_year= new Years;
        return view( 'forms.admin', compact( 'years', 'is_new', 'new_year'));
	}
        
        
       
	
}
