<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class PostFormRequestFichas extends Request {

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
			'codigo_alumno_txt' => 'required|digits:10|unique:postulantes,codigo',
			'opc_moda_ing'=>'required',

			'apellido_paterno_txt'=>'required|string:255',
			'apellido_materno_txt'=>'required|string:255',

			'terminos_chk'=>'required',
			'nombres_txt'=>'required|string:255',
			'fecha_nac_txt'=>'required|date_format:"d-m-Y"',
			'lugarNac_txt'=>'required|string:255',
			'docIndentidad_txt'=>'required|digits:8|integer|unique:postulantes,documento_identidad',
			'opc_sex'=>'required',
			'direccion_txt'=>'required|string:255',
			'telefono_txt'=>'required|string:255',
			'celular_txt'=>'required|string:255',
			'colegio_txt'=>'required|string:255',
			'opc_colegio'=>'required',
			'ubicacion_cole_txt'=>'required|string:255',
			'ciclo_txt'=>'required|string:255',


			//upci
			'carrera_postul_id'=>'exists:carrera_instituciones,id',
			'modalidad'=>'exists:modalidades,id',
			
			//instituciones
			'institucion_id'=>'exists:instituciones,id',
			'carrera_id'=>'exists:carrera_upci,id'
			


		];
	}

}
