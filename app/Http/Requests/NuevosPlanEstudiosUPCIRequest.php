<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class NuevosPlanEstudiosUPCIRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'plan_estudios_upci_nombre' => 'required',
			'plan_estudios_upci_codigo' => 'required',
			
		];
	}

}
