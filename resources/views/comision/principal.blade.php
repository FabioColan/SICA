@role('comision')
@extends('master-comision')

@section('css')
 <link rel="stylesheet" href="{{asset('/js/jquery/jquery-ui.css')}}">
@stop

@section('js')
    <!-- jQuery 2.1.3 -->
    <script src="{{ asset('/plugins/jQuery/jQuery-2.1.3.min.js') }}"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="{{ asset('css/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <!-- FastClick -->
    <script src="{{ asset('/plugins/fastclick/fastclick.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('/js/app.min.js') }}" type="text/javascript"></script>
   
    <!-- SlimScroll -->
    <script src="{{ asset('/plugins/slimScroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>


@stop

@section('js-head')

    
@stop

@section('css-head-personalizado')
  <style>
  .campos_titulo{
    font-weight: bold;
  }
  </style>
@stop

@section('codigo-javascript')
    <script src="{{ asset('/js/jquery/jquery-ui.min.js')}}"></script>

    <script type="text/javascript">

       $(document).ready(function() {
            $("#solicitud").hide();     // Por defecto, ocultamos el DIV que contine el mensaje emergente.
            $('.disparar_mensaje').click(     // Ubicamos el evento click en el botón disparar_mensaje
                function(){
                    $("#solicitud").show(); // Ponemos en visible en contenedor del mensaje
                    $("#solicitud").dialog({
                        width: 800
                    }); // Utilizamos el método "dialog" que disparar el mensaje emergente
                  }
            );
        });

    </script>
                
    <script type="text/javascript">
      $(document).ready(function(){
        

        $('.btn-solicitar').click(function(){
              var row = $(this).parents('tr');
              var id = row.data('id');
              var form = $('#form-solicitud');
              var url = form.attr('action').replace(':POSTULANTE_CODIGO', id);
              var data = form.serialize();
              $.post(url, data, function(result){
                  //document.getElementById('contenido').innerHTML= "<p style='color:red;'>";
                  document.getElementById('codigo').innerHTML=result.codigo;
                  document.getElementById('nombres').innerHTML=result.nombres;
                  document.getElementById('apellido_paterno').innerHTML=result.apellido_paterno;
                  document.getElementById('apellido_materno').innerHTML=result.apellido_materno;
                  document.getElementById('fecha_nacimiento').innerHTML=result.fecha_nacimiento;
                  document.getElementById('lugar_nacimiento').innerHTML=result.lugar_nacimiento;
                  document.getElementById('documento_identidad').innerHTML=result.documento_identidad;
                  document.getElementById('sexo').innerHTML=result.sexo;
                  document.getElementById('direccion').innerHTML=result.direccion;
                  document.getElementById('telefono_fijo').innerHTML=result.telefono_fijo;
                  document.getElementById('telefono_celular').innerHTML=result.telefono_celular;
                  document.getElementById('colegio').innerHTML=result.colegio;
                  document.getElementById('tipo_colegio').innerHTML=result.tipo_colegio;
                  document.getElementById('ubicacion_colegio').innerHTML=result.ubicacion_colegio;
                  document.getElementById('datos_padres').innerHTML=result.datos_padres;
                  document.getElementById('telefono_padres').innerHTML=result.telefono_padres;
                  document.getElementById('nombre_usuario').innerHTML=result.nombre_usuario;
                  document.getElementById('correo').innerHTML=result.correo;
                  document.getElementById('institucion').innerHTML=result.institucion;
                  document.getElementById('carrera_ins').innerHTML=result.carrera_ins;
                  document.getElementById('carrera_upci').innerHTML=result.carrera_upci;
                  document.getElementById('modalidad').innerHTML=result.modalidad;
                  document.getElementById('ciclo').innerHTML=result.ciclo;
                  
              }).fail(function(){
                
                  alert("error " + result);
                  
                  row.show;

              });
          });
      });
  </script>
@stop

@section('contenido')

        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Postulantes
            <small>{{ $post = DB::table('postulantes')->count()}} postulantes encontrados.</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Principal</a></li>
            <li class="active">Listado</li>
          </ol>
          
        </section>

        <!-- Main content -->
        <section class="content">

          <div class="row">
            <div class="col-md-12">
              <div class="box box-primary">
                
                <div class="box-body no-padding">
                 
                  <div class="table-responsive mailbox-messages">
                    <table class="table table-hover table-striped">
                      <thead style="background-color:#3c8dbc; color:#fff;">
                              <tr>
                                <th ></th>
                                <th width='5%'>Código</th>
                                <th width='20%'>Nombres y Apellidos</th>
                                <th width='25%'>Estado</th>
                                <th>Fec. Creación</th>
                                <th>Fec. Modif.</th>
                                <th></th>
                                <th ></th>
                              </tr> 
                            </thead>
                      <tbody>
                        
                        @foreach ($var_solicitud as $so)
                        <tr data-id="{{ $so->codigo }}">
                              <td class="mailbox-star"><a href="#"><i class="fa fa-user"></i></a></td>
                              <td class="mailbox-name"><a>{{ $so->codigo }}</a></td>
                              <td class="mailbox-name"><a>{{ $so->nombres }}</a></td>
                              <td class="mailbox-name"><a>{{ $so->estado }}</a></td>
                              <td class="mailbox-name"><a>{{ $so->fecha_creacion }}</a></td>
                              <td class="mailbox-name"><a>{{ $so->fecha_modificacion }}</a></td>
                              <td class="mailbox-name" hidden><a>{{ $so->estado_convalidacion }}</a></td>
                              <td align='center'>
                                @if ($so->estado_convalidacion==1)
                                   <a href="{{url('comision/validar', $so->codigo )}}" class="btn btn-xs btn-flat bg-blue">Validar Adjuntos</a>
                                @elseif ($so->estado_convalidacion==2)

                                @elseif ($so->estado_convalidacion==3)

                                @elseif ($so->estado=='Registró Solicitud Postulante, Cursos y Adjuntos.')
                                   <a href="{{url('comision/validar', $so->codigo )}}" class="btn btn-xs btn-flat bg-blue">Validar Adjuntos</a>
                                @endif
                                   <a class='btn btn-xs btn-flat bg-orange disparar_mensaje btn-solicitar' role='button'>Ver Solicitud</a>
                              </td>
                        </tr>
                        @endforeach
                                                 
                      </tbody>
                    </table><!-- /.table -->

                  </div><!-- /.mail-box-messages -->
                </div><!-- /.box-body -->
                <div class="box-footer no-padding">
                  <div class="mailbox-controls">
                    
                  </div>
                </div>
              </div><!-- /. box -->
            </div><!-- /.col -->

                

          </div><!-- /.row -->
          

        </section><!-- /.content -->

        <section class="content-header" >
          <h1>
            Postulantes Atendidos
            <small>{{ $post = DB::table('listado_postulantes_comision')->count()}} postulantes encontrados.</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Principal</a></li>
            <li class="active">Listado</li>
          </ol>
          
        </section>


        <section class="content" >
        <div class='row'>
            <div class='col-md-12'>
              <div class="box box-primary">
                
                <div class="box-body no-padding">
                 
                  <div class="table-responsive mailbox-messages">
                    <table class="table table-hover table-striped">
                      <thead style="background-color:#3c8dbc; color:#fff;">
                              <tr>
                                <th ></th>
                                <th width='10%'>Código</th>
                                <th width='25%'>Nombres y Apellidos</th>
                                <th width='15%'>Estado</th>
                                <th >Fec.Creación</th>
                                <th >Fec.Modif.</th>
                                <th ></th>
                              </tr> 
                            </thead>
                      <tbody>
                        
                        @foreach ($var_post as $p)
                        <tr data-id="{{ $p->codigo }}">
                              <td class="mailbox-star"><a href="#"><i class="fa fa-user"></i></a></td>
                              <td class="mailbox-name"><a>{{ $p->codigo }}</a></td>
                              <td class="mailbox-name"><a>{{ $p->nombres }}</a></td>
                              <td class="mailbox-name"><a>{{ $p->estado }}</a></td>
                              <td class="mailbox-name"><a>{{ $p->fecha_creacion }}</a></td>
                              <td class="mailbox-name"><a>{{ $p->fecha_modificacion }}</a></td>
                              <td align='center'>
                                @if ($p->estado=='Completo')
                                  <a href="{{url('comision/convalidar/show', $p->codigo )}}" class="btn btn-xs btn-flat  bg-green">Convalidar Cursos</a>
                                @elseif ($p->estado=='Incompleto')
                                  <a href="{{url('comision/validar', $p->codigo )}}" class="btn btn-xs btn-flat bg-blue">Validar Adjuntos</a>
                                @elseif ($p->estado=='En proceso')
                                  <a href="{{url('comision/validar', $p->codigo )}}" class="btn btn-xs btn-flat bg-blue">Validar Adjuntos</a>
                                @endif
                                <a class='btn btn-xs btn-flat bg-orange disparar_mensaje btn-solicitar' role='button'>Ver Solicitud</a>
                              </td>
                        </tr>
                        @endforeach
                                                 
                      </tbody>
                    </table><!-- /.table -->

                  </div><!-- /.mail-box-messages -->
                </div><!-- /.box-body -->
                <div class="box-footer no-padding">
                  <div class="mailbox-controls">
                    
                  </div>
                </div>
              </div><!-- /. box -->

            </div>
          </div>
      </section>

      {!! Form::open(['route'=>['comision.solicitud' ,':POSTULANTE_CODIGO'], 'method'=>'POST', 'id'=>'form-solicitud']) !!}
      {!! Form::close() !!}

      @include('comision/detalles/solicitud')

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