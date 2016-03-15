<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Session extends Model {
	protected $table = 'session';
	public $guarded = ['id'];
	public $timestamps = false;

	public function training() {
		return $this->belongsTo( 'App\Models\training' );
	}
        
        public function psychologist() {
		return $this->belongsTo( 'App\Models\Psychologist' );
	}

}
