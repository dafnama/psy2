<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Training extends Model {
    protected $table = 'trainings';
	public $guarded = ['id'];
	public $timestamps = false;

	public function psychologist() {
		return $this->belongsTo( 'App\Models\Psychologist' );
	}

	
}