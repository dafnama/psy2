<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreInstituteRequest extends Request {

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
     //no validation it incremental   'educational_institute_id'=>
     // 'unique:educational_institutes|numeric',
       'shapah_id' =>'required|exists:shapahs',
       'educational_institute_name' => 'required|alpha',
       'educational_institute_city' => 'required|alpha',
       'educational_institute_address' => 'alpha_num',
       'educational_institute_phone'=> 'numeric',
       'educational_institute_email' => 'email',
       'principal_first_name'=> 'alpha',
       'principal_last_name'=> 'alpha',
       'number_of_classes'=> 'numeric|between:0,99',
       'number_of_special_classes'=> 'numeric|between:0,50',
       'number_of_special_students'=> 'numeric|between:0,2000',
       'number_of_alef_students'=> 'numeric|between:0,2000',
       'number_of_non_alef_students'=> 'numeric|between:0,500',
       'number_of_kindergarten_children'=> 'numeric|between:0,200',
       'kindergarten_type'=> 'alpha'
		];
	}
}
