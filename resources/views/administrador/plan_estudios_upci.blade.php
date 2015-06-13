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
      <!-- INICIO FORM DE REGISTAR NUEVAS FACULTAD PERSONALIZADO -->
              {!! Form::open(array('method' => 'post', 'role' => 'form', 'url' => 'plan_estudios_upci/grabar-new')) !!}
                <div class="box box-success box-solid">
                  <div class="box-header with-border">
                    <h3 class="box-title">REGISTRAR NUEVOS PLANES DE ESTUDIO</h3>
                    <div class="box-tools pull-right">
                      <!-- <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button> -->
                    </div><!-- /.box-tools -->
                  </div><!-- /.box-header -->

                  <div class="box-body">
                    <div class="row">

                        <form class="" role="form" method="POST" action=" ">

                              <div class="col-md-5">
                                <div class="form-group {{ $errors->has('plan_estudio_upci_nombre_txt') ? 'has-error' : '' }}">
                                  {!! Form::label('plan_estudios_upci_nombre_lbl','Ingrese Año del Plande estudio de la UPCI')  !!}
                                  {!! Form::text('plan_estudios_upci_nombre_txt', (Input::old('plan_estudios_upci_nombre')),array('class'=>'form-control','name'=>'plan_estudios_upci_nombre','id'=>'plan_estudios_upci_nombre')) !!}
                                </div>
                              </div>
                              <div class="col-md-5">
                                <div class="form-group {{ $errors->has('plan_estudio_upci_codigo_txt') ? 'has-error' : '' }}">
                                  {!! Form::label('plan_estudios_upci_codigo_lbl','Ingrese Codigo del Plande estudio de la UPCI')  !!}
                                  {!! Form::text('plan_estudios_upci_codigo_txt', (Input::old('plan_estudios_upci_codigo')),array('class'=>'form-control','name'=>'plan_estudios_upci_codigo','id'=>'plan_estudios_upci_codigo')) !!}
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
                  <h1 class="box-title">Lista de Planes de Estudio de la UPCI</h1>
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
                                <th width="30%">NOMBRE</th>
                                <th width="20%">CODIGO</th>
                                <th width="20%">FECHA DE CREACION</th>
                                <th width="20%">FECHA DE MODIFICACION</th>
                                <th width="10%">EVENTO</th>
                              </tr> 
                            </thead>
                            <tbody>

                                @foreach ($plan as $pl)
                                  <tr>  
                                    <!-- <td class="mailbox-star"><a href="#"><i class="fa fa-hand-o-right"></i></a></td> -->
                                    <td{{ $pl->id }}></td>
                                    <td class="mailbox-star"><a><i class="fa fa-hand-o-right"></i></a></td>
                                    <td class="mailbox-name">{{ $pl->nombre }}</td>
                                    <td class="mailbox-name">{{ $pl->codigo_resolucion }}</td>
                                    <td class="mailbox-date">{{ $pl->created_at }}</td>
                                    <td class="mailbox-date">{{ $pl->updated_at }}</td>
                                    <td><a type="button" href="{{route('plan_estudios_upci.edit', $pl->id )}}" class="btn btn-xs btn-warning btn-updated">Actualizar</a></td>
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