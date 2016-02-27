<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class Psychologist extends Model implements AuthenticatableContract {
	protected $guarded = [ 'id' ];
	protected $hidden = ['password', 'remember_token'];

	use Authenticatable;


	public function institutes() {
		return $this->hasManyThrough( 'App\Models\Institute', 'App\Models\Shapah' );
	}

	public function status() {
		return $this->belongsTo( 'App\Models\ProfessionalStatus', 'professional_status_id' );
	}

	public function role() {
		return $this->belongsTo( 'App\Models\PsychologistRole', 'psychologist_role_id' );
	}

	public function shapahs() {
		return $this->belongsToMany( 'App\Models\Shapah', 'psychologist_shapah', 'psychologist_id', 'shapah_id' )->withPivot('is_manager');
	}

	public function matches() {
		return $this->hasMany( 'App\Models\Match' );
	}

    public function visits() {
		return $this->hasManyThrough('App\Models\Visit', 'App\Models\Match' );
	}

	private function getRoleCode( $name ) {
		$roles = \Config::get( 'auth.roles' );

		return $roles[ $name ];
	}

	public function isManager() {
		return $this->permission == $this->getRoleCode( 'manager' );
	}

	public function isUser() {
		return $this->permission == $this->getRoleCode( 'user' );
	}

	public function isAdmin() {
		return $this->permission === $this->getRoleCode( 'admin' );
	}

	public function hasShapah($shapah_id) {
		return $this->shapahs->contains( $shapah_id );
	}
}
