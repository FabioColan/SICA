<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class GrabarCursosCuadroRequest extends Request {

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
			'cod_pos_grabar'=>'required',
			'nota_instituto'=>'required',
			'nota_upci'=> 'required',
			'cursos_upci'=>'required',
			'cursos_institucion' =>'required'
		];
	}

}
