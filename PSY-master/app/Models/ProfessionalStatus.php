<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class ProfessionalStatus extends Model {

	protected $table = 'professional_statuses';
        public $guarded = ['id'];
	public $timestamps = false;
}

