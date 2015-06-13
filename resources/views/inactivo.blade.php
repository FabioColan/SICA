@extends('app-inactivo')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Información Importante!</div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> Hubo algunos problemas con su entrada.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					Su usuario se encuentra inactivo, no puede acceder al sistema. Si cree que es un error, comunicarse con el Administrador de Sistema.
			</div>
			<div class="panel-footer">
				Copyright &copy; 2015 <i>Realizado por Alumnos de la Facultad de Ing. de Sistemas e Informática.</i> <img width='25%' style="float:right; padding-right:25px;" class="img-responsive" src="{{url('/img/herramientas.png')}}" /> 
			</div>
		</div>
	</div>
	</div>
</div>
@endsection

