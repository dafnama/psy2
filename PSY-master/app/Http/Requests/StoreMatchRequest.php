<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreMatchRequest extends Request {

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
		'psychologist_id'=> 'required|exists:psychologists|numeric',
        'educational_institute_id'=> 'required|exists:educational_institutes|numeric',
        'match_hours'=> 'numeric',
        'match_year'=> 'alpha_num'
		];
	}

}
