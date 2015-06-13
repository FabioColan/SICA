<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class SeleccionCursosInstitucionRequest extends Request {

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
			'cursos' => 'required',
			'horas' => 'required|numeric|between:1,6',
			'nota' => 'required|numeric|between:0,20'
		];
	}

}
