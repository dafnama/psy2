<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreVisitReportRequest extends Request {

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
			'educational_institute_id'=> 'required|unique:educational_institutes|numeric',
            'date' => 'required|date'
            'activity1'=> 'required|alpha',
            'activity2'=> 'alpha',
            'length_in_institute' => 'required_without:length_in_shapah|numeric|between:0.5,12',
            'length_in_shapah' => 'required_without:length_in_institute|numeric|between:0.5,12',
            'comment1'=> 'alpha|max:100',
            'comment2'=> 'alpha|max:100'
		];
	}

}
