<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class EditCursosCarrerasUPCIRequest extends Request {

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
			'nombre'=>'required',
			'codigo'=>'required',
			'creditos'=>'required',
			'hora_teorica'=>'required',
			'hora_practica'=>'required',
			'th'=>'required',
			'ciclo_upci_id'=>'required',
			'carrera_upci_id'=>'required',
			'plan_upci_id'=>'required',
			];
	}

}
