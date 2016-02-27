<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class StorePsychologistRequest extends Request {

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
            'license_number'=> 'required|unique:psychologists|numeric',
            'start_working_date' => 'date'
            'first_name'=> 'required|alpha',
            'last_name'=> 'required|alpha',
            'city_of_residence' => 'alpha',
            'availability'=> 'required|numeric|between:1,50',
            'phone'=> 'numeric',
            'psychologist_email' => 'required|email',
            'password'=> 'required|min:8',
            'psychologist_role_id' =>'exists:psychologist_roles',
            'professional_status_id' =>'exists:professional_statuses'
        ];
	}

}
