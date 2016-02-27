<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Match extends Model {
    protected $table = 'matches';
	public $guarded = ['id'];
	public $timestamps = false;

	public function psychologist() {
		return $this->belongsTo( 'App\Models\Psychologist' );
	}

	public function institute() {
		return $this->belongsTo( 'App\Models\Institute', 'institute_id' );
	}

	public function visits() {
		return $this->hasMany( 'App\Models\Visit' );
	}
}
