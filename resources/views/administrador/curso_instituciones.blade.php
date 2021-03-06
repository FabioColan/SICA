@role('admin')
@extends('master-administrador')

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
        #espacio-error{
          margin-left:25px;
        }

    </style>
@stop

@section('js')

    
    <script src="{{ asset('/plugins/jQuery/jQuery-2.1.3.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/app.min.js" type="text/javascript"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../dist/js/demo.js" type="text/javascript"></script>
    <!-- Page script -->


@stop

@section('codigo-javascript')
  <script type="text/javascript">
      $(document).ready(function(){

        $('.btn-delete').click(function(){

              //e.preventDefault();

              var row = $(this).parents('tr');
              var id = row.data('id');
              
              var form = $('#form-delete');
              var url = form.attr('action').replace(':CURSO_ID',id);
              var data = form.serialize();

              row.fadeOut();

              $.post(url, data, function(result){
                  //alert(result);
                  document.getElementById(mensaje).innerHTML=result;
              }).fail(function(){
                  row.show;
              });

          });

      });
  </script>
  
@stop


@section('contenido')
  

<div id="mensaje"></div>
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
      <div class="col-md-12">
      <!-- INICIO FORM DE REGISTAR NUEVAS CURSOS PERSONALIZADO -->
              {!! Form::open(array('method' => 'post', 'role' => 'form', 'url' => 'curso_instituciones/grabar-new')) !!}
                <div class="box box-success box-solid">
                  <div class="box-header with-border">
                    <h3 class="box-title">REGISTRAR NUEVAS CARRERAS</h3>
                    <div class="box-tools pull-right">
                      <!-- <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button> -->
                    </div><!-- /.box-tools -->
                  </div><!-- /.box-header -->

                  <div class="box-body">
                    <div class="row">

                        <form class="" role="form" method="POST" action=" ">

                              <div class="col-md-3">
                                <div class="form-group {{ $errors->has('curso_nuevo_txt') ? 'has-error' : '' }}">
                                  {!! Form::label('curso_nuevo_lbl','Ingrese nombre del Curso')  !!}
                                  {!! Form::text('curso_nuevo_txt', (Input::old('curso_nombre')),array('class'=>'form-control','name'=>'curso_nombre','id'=>'curso_nombre')) !!}
                                </div>
                              </div> 
                              <div class="col-md-2">
                                <div class="form-group {{ $errors->has('creditos_curso_nuevo_txt') ? 'has-error' : '' }}">
                                  {!! Form::label('creditos_curso_nuevo_lbl','Creditos')  !!}
                                  {!! Form::text('creditos_curso_nuevo_txt', (Input::old('creditos_curso_nombre')),array('class'=>'form-control','name'=>'creditos_curso_nombre','id'=>'creditos_curso_nombre')) !!}
                                </div>
                              </div> 
                              <div class="col-md-2">
                                <div class="form-group {{ $errors->has('horas_curso_nuevo_txt') ? 'has-error' : '' }}">
                                  {!! Form::label('horas_curso_nuevo_lbl','Horas Totales')  !!}
                                  {!! Form::text('horas_curso_nuevo_txt', (Input::old('horas_curso_nombre')),array('class'=>'form-control','name'=>'horas_curso_nombre','id'=>'horas_curso_nombre')) !!}
                                </div>
                              </div>
                              <div class="col-md-2">
                                <div class="form-group {{ $errors->has('horas_teoricas_curso_nuevo_txt') ? 'has-error' : '' }}">
                                  {!! Form::label('horas_teoricas_curso_nuevo_lbl','Horas Teoricas')  !!}
                                  {!! Form::text('horas_teoricas_curso_nuevo_txt', (Input::old('horas_teoricas_curso_nombre')),array('class'=>'form-control','name'=>'horas_teoricas_curso_nombre','id'=>'horas_teoricas_curso_nombre')) !!}
                                </div>
                              </div>
                              <div class="col-md-2">
                                <div class="form-group {{ $errors->has('horas_practicas_curso_nuevo_txt') ? 'has-error' : '' }}">
                                  {!! Form::label('horas_practicas_curso_nuevo_lbl','Horas Practicas')  !!}
                                  {!! Form::text('horas_practicas_curso_nuevo_txt', (Input::old('horas_practicas_curso_nombre')),array('class'=>'form-control','name'=>'horas_practicas_curso_nombre','id'=>'horas_practicas_curso_nombre')) !!}
                                </div>
                              </div>
                              <div class="col-md-4">                              
                                <div class="form-group {{ $errors->has('carreas_nuevo_cbo') ? 'has-error' : '' }}">
                                  {!! Form::label('carrera_nuevo_lbl','Tipo de Carrera:')  !!}
                                  {!! Form::select('carreas_nuevo_cbo', $Carreras, (Input::old('carreras_tipo')),array('class'=>'form-control','name'=>'carreras_tipo','id'=>'carreras_tipo')) !!}
                                </div>
                              </div>
                              <div class="col-md-1">
                                  <button style="margin-top:25px;" type="submit" class="btn btn-warning">+</button>
                              </div>
                              <!-- <div class="col-md-2">
                               
                              </div>
                              <div class="col-md-1">
                                
                              </div> -->

                        </form><!-- /.form (seleccion/agregar/grabar de instituciones)-->
                    </div><!-- /.row -->
                  </div><!-- /.box-body -->
                </div><!-- /.box -->
                {!! Form::close() !!}
                <!-- FIN FORM DE REGISTAR NUEVAS INSTITUCIONES PERSONALIZADO -->
      </div>
            <div class="col-md-12">
              <div class="box box-info">
                <div class="box-header" align="center">
                  <h1 class="box-title">Lista de Cursos</h1>
                </div>
                <div class="box-body">
               
                  <section class="content">
                  <div class="row">
                    <div class="col-md-12">
                        <div class="box-body">
                          <table id="example2" class="table table-bordered table-hover">
                            <thead style="background-color:#3c8dbc; color:#fff;">
                              <tr>
                                <th width="5%">ID</th>
                                <th width="20%">NOMBRE</th>
                                <th width="5%">CREDITOS</th>
                                <th width="5%">HORAS TOTALES</th>
                                <th width="5">HORAS TEORICAS</th>
                                <th width="5%">HORAS PRACTICAS</th>
                                <th width="5%">CARRERA</th>
                                <th width="20%">FECHA DE CREACION</th>
                                <th width="20%">FECHA DE MODIFICACION</th>
                                <th width="10%">EVENTO</th>
                              </tr> 
                            </thead>
                            <tbody>

                                @foreach ($cur_institu as $cur_inst)
                                  <tr>  
                                    <!-- <td class="mailbox-star"><a href="#"><i class="fa fa-hand-o-right"></i></a></td> -->
                                    <td{{ $cur_inst->id }}></td>
                                    <td class="mailbox-star"><a><i class="fa fa-hand-o-right"></i></a></td>
                                    <td class="mailbox-name">{{ $cur_inst->nombre }}</td>
                                    <td class="mailbox-name">{{ $cur_inst->creditos }}</td>
                                    <td class="mailbox-name">{{ $cur_inst->horas }}</td>
                                    <td class="mailbox-name">{{ $cur_inst->horas_teoricas }}</td>
                                    <td class="mailbox-name">{{ $cur_inst->horas_practicas }}</td>
                                    <td class="mailbox-name">{{ $cur_inst->carrera_id }}</td>
                                    <td class="mailbox-date">{{ $cur_inst->created_at }}</td>
                                    <td class="mailbox-date">{{ $cur_inst->updated_at }}</td>
                                    <td><a type="button" href="{{route('curso_instituciones.edit', $cur_inst->id )}}" class="btn btn-xs btn-warning btn-updated">Actualizar</a></td>
                                  </tr>

                                @endforeach
                            </tbody>
                            
                          </table>
                        </div><!-- /.box-body -->

                    </div>
                    
                  </div>
                </section>


              
            </div><!-- /.col (left) -->
            <!-- Fin Seccion  -->
      </div>
    </div>
  </div>
@endsection

@endrole

@role('comision')
  <a href='/inactivo'></a>
@endrole

@role('alumno')
  <a href='/inactivo'></a>
@endrole

@role('inactivo')
  <a href='/inactivo'></a>
@endrole