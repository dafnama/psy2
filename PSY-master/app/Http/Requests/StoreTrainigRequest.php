<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreTrainigRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return false;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
		'guided_id'=> 'numeric',
                'guide_id'=> 'numeric',
                //'kind'=> 'alpha|max:100',
                'training_hours'=> 'numeric',
                'training_year'=> 'alpha_num'
		];
	}

}
