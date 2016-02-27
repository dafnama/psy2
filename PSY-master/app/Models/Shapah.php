<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Shapah extends Model {
	protected $table = 'shapahs';
	public $timestamps = false;
	public $guarded = [ 'id' ];

    public function getStandarts(Shapah $shapah){
        $sum = 0;
        foreach ($shapah->institutes as $ins){
            $sum = $sum + $ins->standart_before_cover;
        }
        return $sum;
    }

	public function institutes() {
		return $this->hasMany( 'App\Models\Institute', 'shapah_id' );
	}

	public function psychologists() {
		return $this->belongsToMany( 'App\Models\Psychologist', 'psychologist_shapah', 'shapah_id', 'psychologist_id' );
	}
}
