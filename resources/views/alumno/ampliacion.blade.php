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
                  <div class="row">
                    <div class="form-group">
                    <div class="col-md-3">
                      <label for="">Código Alumno</label>
                      <input type="text" class="form-control" placeholder="" disabled>
                    </div>
                    <div class="col-md-4">
                      <label for="">Centro de Estudios</label>
                      <input type="text" class="form-control" placeholder="" disabled>
                    </div>
                    <div class="col-md-5">
                      <label for="">Carrera Profesional / Especialidad</label>
                      <input type="text" class="form-control" placeholder="" disabled>
                    </div>
                   
                    <div class="form-group">
                    <div class="col-md-7">
                      <label for="">Documento</label>
                      <input type="text" class="form-control" placeholder="" disabled>
                    </div>
                    <div class="col-md-2"><br>
                    <div class="btn btn-default btn-file">
                      <i class="fa fa-paperclip"></i> Adjuntar...
                      <input type="file" name="attachment"/>
                    </div>
                    </div>
                    
                    <div class="col-md-1"><a href="{{url('/registrar')}}">
                      <button style="margin-top:25px;" type="submit" class="btn btn-primary">
                        ENVIAR SOLICITUD</button>
                    </div>
                    </div>


                 
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-9 col-md-offset-3">
                       
                    </div>
                    
                  </div>

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