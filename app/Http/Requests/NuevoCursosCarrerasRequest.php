<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class NuevoCursosCarrerasRequest extends Request {

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
			'curso_nombre' => 'required',
			'creditos_curso_nombre' => 'required|numeric',
			'horas_curso_nombre' => 'required|numeric',
			'horas_teoricas_curso_nombre' => 'required|numeric',
			'horas_practicas_curso_nombre' => 'required|numeric',
			'carreras_tipo' => 'required'
		];
	}

}
