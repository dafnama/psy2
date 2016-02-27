<?php 

namespace App\Http\Controllers;
use App\Models\Shapah;
use App\Models\Institute;

class ShapahController extends Controller {

    public function show(Shapah $shapah) {
		return view( 'singles.shapah', compact('shapah'));
	}




}
