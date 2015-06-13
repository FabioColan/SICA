<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class NuevoCursosCarrerasUPCIRequest extends Request {

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
			'curso_upci_nombre' => 'required',
			'curso_upci_codigo' => 'required',
			'creditos_curso_upci' => 'required',
			'horas_teoricas_curso_upci' => 'required',
			'horas_practicas_curso_upci' => 'required',
			'horas_curso_upci' => 'required',
			'ciclos_upci' => 'required',
			'carreras_upci' => 'required',
			'plan_upci' => 'required',
		];
	}

}
