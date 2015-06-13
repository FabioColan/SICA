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

@section('js-head')
  <script type="text/javascript">
         function cambiarDataObject(nuevaurl) { 
            var obj       = $('#carga');
            var container = $(obj).parent();
            $(obj).attr('data', nuevaurl);
            var newobj    = $(obj).clone();
            $(obj).remove();
            $(container).append(newobj);


  }

</script>


@stop

@section('codigo-javascript')
<script type="text/javascript">
      $(document).ready(function(){

        $('.btn-ver').click(function(){
          
              var row = $(this).parents('tr');
              var id = row.data('id');
              var form = $('#form-adjunto');
              var url = form.attr('action').replace(':ADJUNTO_NOMBRE', id);
              var data = form.serialize();
              $.post(url, data, function(result){
                  //document.getElementById('contenido').innerHTML= "<p style='color:red;'>";
                  document.getElementById('objeto').innerHTML=result.r;

              }).fail(function(){
                
                  alert("error " + result);
                  
                  row.show;

              });
          });
      });
  </script>
@stop

@section('js')
    
    <!-- AdminLTE App -->
    <script src="{{ asset('/dist/js/app.min.js')}}" type="text/javascript"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('/dist/js/demo.js')}}" type="text/javascript"></script>
    <!-- Page script -->


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
  {!! Form::open(array('method' => 'post', 'role' => 'form', 'url' => 'comision/vali')) !!}    
            <!-- Inicio Seccion de Solicitu de Convalidación -->
            <div class="col-md-5">
              <div class="box box-primary box-solid">
                <div class="box-header">
                  <h3 class="box-title">Validar Documentación</h3>
                </div>
                <div class="box-body">
                  <div class="row" align='right'>
                      <div class="col-md-6">
                        <input class='form-control' value='aqui va el estado' id='estado' type='hidden' >
                      </div>
                      <div class="col-md-6">
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
                        <input class='form-control' value='{{ $postulante->apellido_paterno.' '.$postulante->apellido_materno }}' id='apellidos' disabled >
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
                                <th width="18%">Tipo</th>
                                <th width="20%">Nom. Archivo</th>
                                <th width="15%">Fecha</th>
                                <th width="5%"></th>
                                <th width="5%"></th>
                              </tr> 
                            </thead>
                            <tbody>
                              
                              @foreach ($var_doc as $e)
                              <tr  data-id="{{ $e->nombre }}">
                                <td style='font-size:12px;'>{{ $e->tipo }}</td>
                                <td style='font-size:12px;'>{{ $e->nombre }}</td>
                                <td style='font-size:12px;'>{{ $e->fecha }}</td>
                                <td ><a class='btn btn-xs btn-default  btn-ver' role='button'>Ver</a>
                                </td>
                                <td><a type='button'  href="javascript:void(0);" onclick="window.open('{{url('/adjuntos/')}}{{'/'.$e->nombre}}', 
                                  'popup', 'left=390, top=200, width=800, height=500, toolbar=0, resizable=1')" class="btn btn-block btn-default btn-xs">Abrir</a>
                                </td>
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

                  <!--INICIO BOTÓN SIGUIENTE -->
                  <div align="right" style='margin-bottom:25px;'>
                          <a type='button' class="btn btn-flat btn-success" data-toggle="modal" data-target="#notificar"><strong>GUARDAR Y NOTIFICAR <i class="fa fa-rocket fa-lg" style='margin-left:5px;'></i></strong></a>
                  </div>
                  <!-- Modal -->
                  <div class="modal fade modal-success" id="notificar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title" id="myModalLabel">Esta a punto de actualizar el estado de la documentación.</h4>
                        </div>
                        <div class="modal-body">
                          <div class="form-group">
                            <label for="message-text" class="control-label">Mensaje:</label>
                            <textarea class="form-control" id="mensaje" name="mensaje" style='font-color:#000'></textarea>
                          </div>

                          <i class='fa fa-info-circle' style='margin-right:5px;'></i> Recuerda que una vez guardada la información ya no podrá rectificar los datos ingresados.
                        </div>
                        <div class="modal-footer">
                          <a type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</a>
                          <button type="submit" class="btn btn-primary"><i class="fa fa-save" style='margin-right:5px;'></i> Guardar y Notificar</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!--FIN BOTÓN SIGUIENTE -->
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
                    <div id='objeto'></div>

                </div><!-- /.box-body -->

              </div><!-- /.box -->
          




            </div><!-- /.col (left) -->





          </div><!-- /.row -->

      {!! Form::open(['route'=>['comision.adjunto' ,':ADJUNTO_NOMBRE'], 'method'=>'POST', 'id'=>'form-adjunto']) !!}
      {!! Form::close() !!}

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