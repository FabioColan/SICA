@role('alumno')


@extends('master-alumno')


@section('css')
    
@stop


@section('js-head')

@stop


@section('css-head-personalizado')
    <style> 
        #espacio-error{
          margin-left:25px;
        }

    </style>
@stop

@section('js')

@stop


@section('codigo-javascript')
    
@stop


@section('contenido')



    @if($errors->has())
      <div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-ban"></i> Errores encontrados! Ingrese la información solicitada.</h4>
      @foreach ($errors->all() as $error)
      
        <div id='espacio-error'>- {{ $error }}</div>
      
      @endforeach
      </div>
  @endif

    <div class="row">
            <!-- Inicio Seccion de Solicitu de Convalidación -->
            <div class="col-md-9">
              <div class="box box-info">
                <div class="box-header">
                  <h3 class="box-title">Solicitud de Ampliación</h3>
                </div>
                <div class="box-body">
              
                    Aún no ha solicitado convalidación.

                </div><!-- /.box-body -->
              </div><!-- /.box -->
              
            </div><!-- /.col (left) -->
            <!-- Fin Seccion de Solicitu de Convalidación -->

            <div class="col-md-3">

              <div class="box box-info">
                <div class="box-header">
                  <h3 class="box-title">Info</h3>
                </div>

                <div class="box-body">
                </div><!-- /.box-body -->

              </div><!-- /.box -->
            </div><!-- /.col (left) -->

          </div><!-- /.row -->
            <!-- Fin Seccion de Solicitu de Convalidación -->

@stop


@endrole

@role('admin')
    <a href='/no_autorizado'></a>
@endrole

@role('comision')
    <a href='/no_autorizado'></a>
@endrole

@role('inactivo')
    <a href='/inactivo'></a>
@endrole