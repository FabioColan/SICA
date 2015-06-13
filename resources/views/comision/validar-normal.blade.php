@role('comision')
@extends('master-comision')

@section('css')
    <!-- Morris chart -->
    <link href="{{ asset('/plugins/morris/morris.css') }}" rel="stylesheet" type="text/css" />
    <!-- daterange picker -->
    <link href="{{ asset('/plugins/daterangepicker/daterangepicker-bs3.css') }}" rel="stylesheet" type="text/css" />
    <!-- iCheck for checkboxes and radio inputs -->
    <link href="{{ asset('/plugins/iCheck/all.css') }}" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link href="{{ asset('/plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet" type="text/css" />
    <!-- Daterange picker -->
    <link href="{{ asset('/plugins/daterangepicker/daterangepicker-bs3.css') }}" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="{{ asset('/css/AdminLTE.css') }}" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="{{ asset('/css/skins/_all-skins.css') }}" rel="stylesheet" type="text/css" />
@stop

@section('js-head')
    <script src="{{ asset('/plugins/jQuery/jQuery-2.1.3.min.js') }}"></script>
@stop

@section('css-head-personalizado')
    <style> 
        #radio(
              float:left;
              margin-right:500px;
          );
    </style>
@stop

@section('js')
    
    <!-- AdminLTE App -->
    <script src="{{ asset('/dist/js/app.min.js')}}" type="text/javascript"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('/dist/js/demo.js')}}" type="text/javascript"></script>
    <!-- Page script -->


@stop

@section('contenido')
	<div class="row">
  {!! Form::open(array('method' => 'post', 'role' => 'form', 'url' => 'comision/vali')) !!}    
            <!-- Inicio Seccion de Solicitu de Convalidación -->
            <div class="col-md-5">
              <div class="box box-primary box-solid">
                <div class="box-header">
                  <h3 class="box-title">Validar Documentación</h3>
                </div>
                <div class="box-body">
                  <div class="row" align='right'>
                      <div class="col-md-12">
                        <div class="btn-group">
                            <a href='{{ url('/')}}' type='button' class='btn  bg-maroon' role='button'><i class="fa fa-arrow-left" style='margin-right:5px;'></i>Volver a Listado</a>
                        </div>
                      </div>
                  </div><!--/.row-->

                  @foreach ($solicitu as $so)
                  <div class="row">
                    <div class="form-group">
                      <div class="col-md-12">
                        {!! Form::label ('nombres_lbl', 'Institución de Procedencia') !!}
                        <input class='form-control' value='{{ $so->nombre_inst }}' id='instituto' disabled >
                      </div>
                    </div>
                  </div>
                   <div class="row">
                    <div class="form-group">
                      <div class="col-md-12">
                        {!! Form::label ('nombres_lbl', 'Carrera Profesional') !!}
                        <input class='form-control' value='{{ $so->nombre_ca_inst }}' id='carrera_instituto' disabled >
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group">
                      <div class="col-md-12">
                        {!! Form::label ('nombres_lbl', 'Carrera a convalidar UPCI') !!}
                        <input class='form-control' value='{{ $so->nombre_ca_upci }}' id='carrera_upci' disabled >
                      </div>
                    </div>
                  </div>
                  @endforeach

                  

                  <div class="row">
                    <div class="form-group">
                      <div class="col-md-6">
                        {!! Form::label ('codigo_lbl', 'Nombres') !!}
                        <input class='form-control' value='{{ $postulante->nombres }}' id='nombres' disabled >
                      </div>
                      <div class="col-md-6">
                        {!! Form::label ('nombre_postulante_lbl', 'Apellidos') !!}
                        <input class='form-control' value='{{ $postulante->apellido_paterno.' '.$postulante->apellido_paterno }}' id='apellidos' disabled >
                      </div>
                      
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group">
                      <div class="col-md-12">
                        {!! Form::label ('nombres_lbl', 'Codigo Postulante') !!}
                        <input class='form-control' value='{{ $postulante->codigo }}' disabled>
                        <input class='form-control' value='{{ $postulante->codigo }}' id='codigo_postulante' name='codigo_postulante' type='hidden'>
                      </div>
                      
                    </div>
                  </div>
             
                  <div class="row">
                    <div class="col-md-12">
                       
                        <div class="box-body" style="margin-top:25px;">
                          <table id="example2" class="table table-bordered table-hover">
                            <thead style="background-color:#00c0ef; color:#fff;">
                              <tr>
                                <th width="20%">Nombre archivos adjuntados</th>
                                <th width="15%">Fecha</th>
                                <th width="5%">Acción</th>
                              </tr> 
                            </thead>
                            <tbody>
                              
                              @foreach ($var_doc as $e)
                              <tr>
                                <td style='font-size:12px;'>{{ $e->nombre }}</td>
                                <td style='font-size:12px;'>{{ $e->fecha }}</td>
                                <td ><button class="btn btn-block btn-default btn-xs">Ver</button></td>
                              </tr>
                              @endforeach
                              
                            </tbody>
                            
                          </table>
                        </div><!-- /.box-body -->
                      
                       
                    </div>
                    
                  </div>

                  <div class="form-group {{ $errors->has('carrera_postul_id') ? 'has-error' : '' }}">
                      {!! Form::label ('estado_lbl', 'Seleccione Estado a Notificar') !!}<br />
                      {!! Form::select ('estado_cbo', $esta, (Input::old('estado')), array('class'=>'form-control','name'=>'estado','id'=>'estado')) !!}
                  </div>
                  <div align='right'>
                      <button type="submit" class="btn btn-flat btn-success">GUARDAR Y NOTIFICAR</button>
                  </div>
                </div><!-- /.box-body -->

              </div><!-- /.box -->
              
            </div><!-- /.col (left) -->
            <!-- Fin Seccion de Solicitu de Convalidación -->
    {!! Form::close() !!}

            <div class="col-md-7">
              
              <div class="box box-info">
                <div class="box-header">
                  <center>
                  <h3 class="box-title">Vista Previa</h3>
                </center>
                </div>

                <div class="box-body">

                  <!--<embed style="width:100%; height:500px;" scale="50%" src="../../adjuntos/ejemplo.pdf" >-->
                      <object 
                      data="/adjuntos/19802.png#toolbar=1&amp;navpanes=1&amp;scrollbar=1&amp;page=5&amp;view=FitH&amp;zoom=75"
                      type="application/pdf"
                      width="100%" height="500px"
                      >
                      <param name="zoom" value="10%" />
                      </object>
                  <br />
                  <a href="#">Abrir en Nueva Ventana</a>
                </div><!-- /.box-body -->

              </div><!-- /.box -->
          




            </div><!-- /.col (left) -->





          </div><!-- /.row -->
	@stop

@endrole

@role('admin')
  <a href='/no_autorizado'></a>
@endrole

@role('alumno')
  <a href='/no_autorizado'></a>
@endrole

@role('inactivo')
  <a href='/inactivo'></a>
@endrole