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

    
    <!-- ace styles -->
    <link rel="stylesheet" href="{{ asset('/js/jquery/jquery-ui.css')}}">
    <link rel="stylesheet" href="{{ asset('/css/ace/datepicker.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('/css/ace/ui.jqgrid.min.css') }}" />
    <!-- <link rel="stylesheet" href="{{ asset('/css/ace/ace.min.css') }}" /> -->

@stop

@section('js-head')
    <script src="{{ asset('/plugins/jQuery/jQuery-2.1.3.min.js') }}"></script>
    
    <!-- ace settings handler -->
    <script src="{{ asset('/js/ace/ace-extra.min.js') }}"></script>

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
    <!-- InputMask -->
    <script src="{{asset('/plugins/input-mask/jquery.inputmask.js') }}" type="text/javascript"></script>
    <script src="{{asset('/plugins/input-mask/jquery.inputmask.date.extensions.js') }}" type="text/javascript"></script>
    <script src="{{asset('/plugins/input-mask/jquery.inputmask.extensions.js') }}" type="text/javascript"></script>

    <!-- iCheck 1.0.1 -->
    <script src="{{ asset('/plugins/iCheck/icheck.min.js') }}" type="text/javascript"></script>

    <!-- ace scripts -->
    <script src="{{ asset('/js/ace/jquery.jqGrid.min.js') }}"></script>
    <script src="{{ asset('/js/ace/grid.locale-en.js') }}"></script>
    <script src="{{ asset('/js/ace/ace-elements.min.js') }}"></script>
    <script src="{{ asset('/js/ace/ace.min.js') }}"></script>    
    <script src="{{ asset('/js/ace/ace.js') }}"></script>    
@stop

@section('codigo-javascript')
  <script src="{{ asset('/js/jquery/jquery-ui.min.js')}}"></script>

  <script type="text/javascript">

       $(document).ready(function() {
        
            $("#cuadro_cesca").hide();     // Por defecto, ocultamos el DIV que contine el mensaje emergente.
            $('.abrir_cuadro').click(     // Ubicamos el evento click en el botón disparar_mensaje
                function(){
                    $("#cuadro_cesca").show(); // Ponemos en visible en contenedor del mensaje
                    $("#cuadro_cesca").dialog({
                        width: 900
                    }); // Utilizamos el método "dialog" que disparar el mensaje emergente
                  }
            );
        });

  </script>
   <script>
      $(document).ready(function(){
          
        $('#ciclo').change(function(){
          $.get("{{ url('cursos_upci')}}",
          { option: $(this).val() },
          function(data) {
            $('#cursos_upci').empty();
            $.each(data, function(key, element) {
              $('#cursos_upci').append("<option value='" + key + "'>" + element + "</option>");
            });

          });

        });


      });   
    </script>

    
    
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
              <div class="box box-primary box-solid">
                <div class="box-header">
                  <h3 class="box-title">Validar Expediente</h3>
                </div>
                
                <div class="box-body">
                  <div class="row" align='right' style='margin-bottom:15px;' >
                      <div class="col-md-6">
                        
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
                      <div class="col-md-4">
                        {!! Form::label ('nombres_lbl', 'Institución de Procedencia') !!}
                        <input class='form-control' value='{{ $so->nombre_inst }}' id='instituto' disabled >
                      </div>
                      <div class="col-md-4">
                        {!! Form::label ('nombres_lbl', 'Carrera Profesional') !!}
                        <input class='form-control' value='{{ $so->nombre_ca_inst }}' id='carrera_instituto' disabled >
                      </div>
                      <div class="col-md-4">
                        {!! Form::label ('nombres_lbl', 'Carrera a convalidar UPCI') !!}
                        <input class='form-control' value='{{ $so->nombre_ca_upci }}' id='carrera_upci' disabled >
                      </div>
                    </div>
                  </div>
                  @endforeach

                  <div class="row">
                    <div class="form-group">
                      <div class="col-md-4">
                        {!! Form::label ('nombres_lbl', 'Codigo Postulante') !!}
                        <input class='form-control' value='{{ $postulante->codigo }}' disabled>
                        <input class='form-control' value='{{ $postulante->codigo }}' id='codigo_postulante' name='codigo_postulante' type='hidden'>
                      </div>
                      <div class="col-md-4">
                        {!! Form::label ('codigo_lbl', 'Nombres') !!}
                        <input class='form-control' value='{{ $postulante->nombres }}' id='nombres' disabled >
                      </div>
                      <div class="col-md-4">
                        {!! Form::label ('nombre_postulante_lbl', 'Apellidos') !!}
                        <input class='form-control' value='{{ $postulante->apellido_paterno.' '.$postulante->apellido_paterno }}' id='apellidos' disabled >
                      </div>
                      
                    </div>
                  </div>

                  <div class="row" style="margin-top:25px;">
                    <div class="form-group">
                    <div class="col-md-5">
                      <label for="">Cursos Solicitados</label>
                          <table id="example2" class="table table-bordered table-hover">
                            <thead style="background-color:#d2d6de; color:#fff;">
                              <tr>
                                <th hidden></th>
                                <th width="10%">Nombre Curso</th>
                                <th width="5%">Horas/Crédito</th>
                                <th width="5%">Nota</th>
                              </tr> 
                            </thead>
                            <tbody>
                              @foreach($cursos_solicitud as $cu)
                              <tr>
                                <td hidden>{{ $cu->id }}</td>
                                <td>{{ $cu->nombre }}</td>
                                <td>{{ $cu->horas }}</td>
                                <td>{{ $cu->nota }}</td>
                              </tr>
                              @endforeach
                            </tbody>
                            
                          </table>
                    </div>
                      
                    <div class="col-md-7">
                      <label for="">Documentos Adjuntos</label>
                          <table id="example2" class="table table-bordered table-hover">
                            <thead style="background-color:#d2d6de; color:#fff;">
                              <tr>
                                <th width="20%">Tipo</th> 
                                <th width="50%">Nombre</th>
                                <th width="29%">Fecha</th>
                                <th width="10%">Acción</th>
                              </tr> 
                            </thead>
                            <tbody>
                              @foreach ($var_doc as $e)
                              <tr>
                                <td style='font-size:12px;'>{{ $e->tipo }}</td>
                                <td style='font-size:12px;'>{{ $e->nombre }}</td>
                                <td style='font-size:12px;'>{{ $e->fecha }}</td>
                                <td><a type='button'  href="javascript:void(0);" onclick="window.open('{{ url('/adjuntos/')}}{{'/'.$e->nombre }}', 
                                  'popup', 'left=390, top=200, width=800, height=500, toolbar=0, resizable=1')" class="btn btn-block btn-default btn-xs">Abrir</a>
                                </td>
                              </tr>
                              @endforeach
                            </tbody>
                            
                          </table>
                    </div>
                    </div>
                  </div>
                  <button class='btn btn-primary abrir_cuadro'><i class="fa fa-diamond" style='margin-right:5px;'></i>GENERAR CUADRO CESCA</button>
                  
                </div><!-- /.box-body -->

              </div><!-- /.box -->
              
            </div><!-- /.col (left) -->
            <!-- Fin Seccion de Solicitu de Convalidación -->


            <!-- INICIO CUADRO CESCA -->
            <div id="cuadro_cesca">

              <table id="grid-table"></table>

              <div id="grid-pager"></div>

            </div>
            <!-- FIN CUADRO CESCA -->


            <div class="col-md-3">
             
              <div class="box box-info">
                <div class="box-header">
                  <h3 class="box-title">Ayuda</h3>
                </div>

                <div class="box-body">

                  
                </div><!-- /.box-body -->

              </div><!-- /.box -->
           
            </div><!-- /.col (left) -->

          </div><!-- /.row -->


          <div class="row">
            <!-- Inicio Seccion de Solicitu de Convalidación -->
            <div class="col-md-12">
              <div class="box box-info">
                <div class="box-header">
                  <h3 class="box-title"><strong>CUADRO DE CONVALIDACIÓN</strong></h3>
                </div>
                <div class="box-body">
                  <div class="row">
                    {!! Form::open(array('method' => 'post', 'role' => 'form', 'url' => 'comision/convalidar/grabar')) !!}
                    <input class='form-control' value='{{ $postulante->codigo }}' id='cod_pos_grabar' name='cod_pos_grabar' type='hidden'>
                    <input class='form-control' value='{{ $postulante->id }}' id='id_pos_grabar' name='id_pos_grabar' type='hidden'>
                    <div class="form-group">
                      <div class="col-md-1">
                        <label for="">Ciclo</label>
                        {!! Form::select('ciclos_cbo', $ciclos, '', array('class'=>'form-control','id'=>'ciclo','name'=>'ciclo'))  !!}
                      </div>
                      <div class="col-md-3">
                        <label for="">Cursos UPCI</label>
                        {!! Form::select('cursos_upci_cbo', $cursos_upci , (Input::old('cursos_upci')), array('class'=>'form-control','id'=>'cursos_upci','name'=>'cursos_upci'))  !!}
                      </div>
                      <div class="col-md-1">
                        <label for="">NOTA</label>
                        {!! Form::text('nota_upci_txt', (Input::old('nota_upci')), array('class'=>'form-control','name'=>'nota_upci','id'=>'nota_upci')) !!}
                      </div>
                      <div class="col-md-3 col-md-offset-1">
                        <label for="">Cursos Institución</label>
                        <select class="form-control" name='cursos_institucion' id='cursos_institucion'>
                          @foreach ($cursos_solicitud as $c )
                          <option value='{{ $c->id }}'>{{$c->nombre}}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="col-md-1">
                        <label for="">HORAS</label>
                        <input type="text" class="form-control" placeholder="2" disabled>
                      </div>
                      <div class="col-md-1">
                        <label for="">NOTA</label>
                        {!! Form::text('nota_instituto_txt', (Input::old('nota_instituto')), array('class'=>'form-control','name'=>'nota_instituto','id'=>'nota_instituto')) !!}
                      </div>
                      <div class="col-md-1">
                        <button class="btn btn-block btn-success" style="margin-top:25px;">+</button>    
                      </div>  
                    </div>
                  </div>

                  {!! Form::close() !!}
                  <!-- <div class="row">
                    <div class="col-md-1 col-md-offset-2">
                      <label for="">CRED</label>
                      <input type="text" class="form-control" placeholder="4" disabled>
                    </div>
                    <div class="col-md-1">
                      <label for="">HT</label>
                      <input type="text" class="form-control" placeholder="0" disabled>
                    </div>
                    <div class="col-md-1">
                      <label for="">HP</label>
                      <input type="text" class="form-control" placeholder="2" disabled>
                    </div>
                    <div class="col-md-1">
                      <label for="">TH</label>
                      <input type="text" class="form-control" placeholder="2" disabled>
                    </div>
                  </div> -->

                  <div class="row" style="margin-top:25px;">
                    <div class="form-group">
                       <table id="grid-table"></table>

                            <div id="grid-pager"></div>
                    <div class="col-md-12">
                      <label for="">Cursos Solicitados</label>

                          <div class="table-responsive">
                           
                          <!-- <table id="example2" class="table table-bordered table-hover"> -->
                          <table id="example2" class="table table-bordered table-hover">
                            <thead style="background-color:#DAD118; color:#fff;">
                              <tr>
                                <th hidden></th>
                                <th>Ciclo</th>
                                <th>COD</th>
                                <th>Asignatura</th>
                                <th>CRED</th>
                                <th>HT</th>
                                <th>HP</th>
                                <th>TH</th>
                                <th>NOTA</th>
                                <th style="background-color:#fff; color:#fff;"></th>
                                <th style="background-color:#D81B60; color:#fff;">Asignatura equivalente</th>
                                <th style="background-color:#D81B60; color:#fff;">Horas</th>
                                <th style="background-color:#D81B60; color:#fff;">Nota</th>
                              </tr> 
                            </thead>
                            <tbody>
                              @foreach($cuadro as $cua)
                              <tr>
                                <td hidden>{{ $cua->id }}</td>
                                <td>{{ $cua->ciclo }}</td>
                                <td>{{ $cua->codigo_curso_upci }}</td>
                                <td>{{ $cua->nombre_curso_upci }}</td>
                                <td>{{ $cua->creditos }}</td>
                                <td>{{ $cua->hora_teorica }}</td>
                                <td>{{ $cua->hora_practica }}</td>
                                <td>{{ $cua->th }}</td>
                                <td>{{ $cua->nota_curso_upci }}</td>
                                <td></td>
                                <td>{{ $cua->nombre_curso_i }}</td>
                                <td>{{ $cua->hora_curso_i }}</td>
                                <td>{{ $cua->nota_curso_i }}</td>
                              </tr>
                              @endforeach
                            </tbody>
                          </table>
                        </div><!--Fin Div table responsive -->
                    </div>
                    </div>
                  </div>
                  <div class="row" style="margin-top:25px;" >
                    <div class="col-md-7">
                      <div class="btn-group">
                          <button type="button" class="btn  btn-flat btn-warning"><i class="fa fa-magic fa-lg"></i> Volver a Generar</button>
                          <button type="button" class="btn  btn-flat btn-primary"><i class="fa fa-print fa-lg"></i> Imprimir</button>      
                          <button type="button" class="btn  btn-flat btn-primary"><i class="fa fa-file-excel-o fa-lg"></i> Exportar Excel</button>    
                          <button type="button" class="btn  btn-flat btn-primary"><i class="fa fa-file-word-o fa-lg "></i> Exportar Word</button>    
                      </div>
                    </div>
                    <div class="col-md-2 col-md-offset-3" align="right">
                        <button type="button" class="btn btn-flat" style="color:#fff; background-color:black; margin-bottom:25px;"><i class="fa fa-paper-plane-o fa-lg"></i> NOTIFICAR ALUMNO</button>
                    </div>
                  </div>


                </div><!-- /.box-body -->

              </div><!-- /.box -->
              <div align="right">
              
              <div>
            </div><!-- /.col (left) -->
            <!-- Fin Seccion de Solicitu de Convalidación -->


            

          </div><!-- /.row -->

          <!-- ROW MODIFICAR ASIGNATURAS -->          
          <div class="row">
            <div class="col-md-12">
              <div class="box box-danger expanded-box">
                <div class="box-header">
                  <h3 class="box-title">ASIGNATURA CARRERA PROFESIONAL UPCI</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                  </div><!-- /.box-tools -->
                </div>
                <div class="box-body">
                  <div class="row">
                    <div class="form-group">
                    <div class="col-md-4">
                      <label for="">Cursos Habilitados - UPCI</label>
                        <select class="form-control">
                              <option>Taller de Lenguaje y Literatura</option>
                              <option>Realidad Nacional</option>
                              <option>Estadística I</option>
                              <option>Contabilidad General</option>
                        </select>
                    </div>
                    <div class="col-md-1">
                      <button type="button" class="btn btn-flat btn-danger" style="margin-top:25px; margin-bottom:25px;">-</button>
                    </div>
                    <div class="col-md-2">
                      <label for="">CICLO</label>
                      <input type="text" class="form-control" placeholder="0" >
                    </div>
                    <div class="col-md-2">
                      <label for="">CÓDIGO</label>
                      <input type="text" class="form-control" placeholder="2" >
                    </div>
                    <div class="col-md-1">
                      <label for="">NOTA</label>
                      <input type="text" class="form-control" placeholder="2" >
                    </div>
                    <div class="col-md-2">
                      <button type="button" class="btn btn-flat btn-primary" style="margin-top:25px; margin-bottom:25px;">ACTUALIZAR</button>
                    </div>
                    </div>
                  </div>
                </div><!-- /.box-body -->

              </div><!-- /.box -->
              
            </div><!-- /. FIN col-md-12 -->
          </div>
          <!-- FIN DE ROW MODIFICAR ASIGNATURAS -->

          <!-- ROW MODIFICAR ASIGNATURAS -->          
          <div class="row">
            <div class="col-md-12">
              <div class="box box-danger expanded-box">
                <div class="box-header">
                  <h3 class="box-title">ASIGNATURA EQUIVALENTE INSTITUCIÓN PROCEDENCIA</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                  </div><!-- /.box-tools -->
                </div>
                <div class="box-body">
                  <div class="row">
                    <div class="form-group">
                    <div class="col-md-4">
                      <label for="">Cursos Habilitados - UPCI</label>
                        <select class="form-control">
                              <option>Taller de Lenguaje y Literatura</option>
                              <option>Realidad Nacional</option>
                              <option>Estadística I</option>
                              <option>Contabilidad General</option>
                        </select>
                    </div>
                    <div class="col-md-1">
                      <button type="button" class="btn btn-flat btn-danger" style="margin-top:25px; margin-bottom:25px;">-</button>
                    </div>
                    <div class="col-md-2">
                      <label for="">HORAS</label>
                      <input type="text" class="form-control" placeholder="2" >
                    </div>
                    <div class="col-md-1">
                      <label for="">NOTA</label>
                      <input type="text" class="form-control" placeholder="2" >
                    </div>
                    <div class="col-md-4">
                      <button type="button" class="btn btn-flat btn-primary" style="margin-top:25px; margin-bottom:25px;">ACTUALIZAR</button>
                    </div>
                    </div>
                  </div>
                </div><!-- /.box-body -->

              </div><!-- /.box -->
              
            </div><!-- /. FIN col-md-12 -->
          </div>
          <!-- FIN DE ROW MODIFICAR ASIGNATURAS -->
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