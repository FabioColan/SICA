@role('alumno')
@extends('master-alumno')

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
    
@stop

@section('js-head')
    <script src="{{ asset('/plugins/jQuery/jQuery-2.1.3.min.js') }}"></script>
@stop

@section('css-head-personalizado')
    <style> 
        #espacio-error{
          margin-left:25px;
        }
        #fondo-azul{
          background-color: #e2e5e7;
        }

        #icon-info{
          color: #cf5018;
        }

    </style>
@stop

@section('js')
    <!-- InputMask -->
    <script src="{{asset('/plugins/input-mask/jquery.inputmask.js') }}" type="text/javascript"></script>
    <script src="{{asset('/plugins/input-mask/jquery.inputmask.date.extensions.js') }}" type="text/javascript"></script>
    <script src="{{asset('/plugins/input-mask/jquery.inputmask.extensions.js') }}" type="text/javascript"></script>
    <!-- iCheck 1.0.1 -->
    <script src="{{ asset('/plugins/iCheck/icheck.min.js') }}" type="text/javascript"></script>
    <!-- date-range-picker -->
    <script src="{{ asset('/plugins/daterangepicker/daterangepicker.js')}} " type="text/javascript"></script>
    <!-- bootstrap color picker -->
    <script src="{{ asset('/plugins/colorpicker/bootstrap-colorpicker.min.js')}} " type="text/javascript"></script>
    <!-- bootstrap time picker -->
    <script src="{{ asset('/plugins/timepicker/bootstrap-timepicker.min.js')}} " type="text/javascript"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="{{ asset('/plugins/slimScroll/jquery.slimscroll.min.js')}} " type="text/javascript"></script>
    <!-- FastClick -->
    <script src="{{ asset('/plugins/fastclick/fastclick.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('/dist/js/app.min.js')}} " type="text/javascript"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('/dist/js/demo.js')}} " type="text/javascript"></script>
    <!-- Page script -->
@stop

@section('codigo-javascript')
    <!--Muestra Combos-->
    <script>
      $(document).ready(function(){
          
        $('#institucion_id').change(function(){
          $.get("{{ url('dropdown')}}",
          { option: $(this).val() },
          function(data) {
            $('#carrera_id').empty();
            $.each(data, function(key, element) {
              $('#carrera_id').append("<option value='" + key + "'>" + element + "</option>");
            });

          });

        });


      });   
    </script>

    <script type="text/javascript">
      $(function () {
        //Datemask dd/mm/yyyy
        $("#nacimiento").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
        //Datemask2 mm/dd/yyyy
        $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
        //Money Euro
        $("[data-mask]").inputmask();

        //Date range picker
        $('#reservation').daterangepicker();
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
        //Date range as a button
        $('#daterange-btn').daterangepicker(
                {
                  ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
                    'Last 7 Days': [moment().subtract('days', 6), moment()],
                    'Last 30 Days': [moment().subtract('days', 29), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
                  },
                  startDate: moment().subtract('days', 29),
                  endDate: moment()
                },
        function (start, end) {
          $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
        );

        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
          checkboxClass: 'icheckbox_minimal-blue',
          radioClass: 'iradio_minimal-blue'
        });
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
          checkboxClass: 'icheckbox_minimal-red',
          radioClass: 'iradio_minimal-red'
        });
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
          checkboxClass: 'icheckbox_flat-green',
          radioClass: 'iradio_flat-green'
        });

        //Colorpicker
        $(".my-colorpicker1").colorpicker();
        //color picker with addon
        $(".my-colorpicker2").colorpicker();

        //Timepicker
        $(".timepicker").timepicker({
          showInputs: false
        });
      });
    </script>
@stop

@section('contenido')


    

<div class="row">

  <!-- INICIO LEFT-->
  <form class="" role="form" method="POST" action="{{ url('/solicitar/registrarCursos') }}">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <div class="col-md-9">
        @if($errors->has())
          <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-ban"></i> Errores encontrados! Ingrese la información solicitada.</h4>
              @foreach ($errors->all() as $error)
                <div id='espacio-error'>- {{ $error }}</div>
              @endforeach
          </div>
        @endif
        <div class="box box-primary box-solid" id="fondo-azul">
          <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-pencil-square-o fa-lg" style="margin-right:5px;"> </i> FICHA DE INSCRIPCIÓN </h3>
            <div class="box-tools pull-right">
              <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div><!-- /.box-tools -->
          </div><!-- /.box-header -->

          <div class="box-body">

                <!--INCIO CABECERA FICHA-->
                <div class="row">
                    <div class="col-md-3 ">
                      <div class="form-group {{ $errors->has('codigo_alumno_txt') ? 'has-error' : '' }}">
                        {!! Form::label ('codigo_alumno_lbl', 'Código de Postulante*') !!} 
                        <i id='icon-info' class='fa fa-info-circle' data-toggle='tooltip' data-placement='right' title='Su código de postulante es generado por la Universidad.'></i>
                        {!! Form::text ('codigo_alumno_txt', '', array('class'=>'form-control')) !!}
                      </div>
                    </div><!-- /.col (left)-->

                    <div class="col-md-5 col-md-offset-4">
                      <div class="form-group {{ $errors->has('opc_moda_ing') ? 'has-error' : '' }}">
                          <div class="box box-solid">
                            <div class="box-body">
                             {!! form::label ('modalidad_lbl', 'Modalidad de Estudio*') !!}<br />
                             {!! Form::radio ('opc_moda_ing','Cepre-UPCI',      false,   array('class'=>'minimal','id'=>'radio')) !!} Cepre-UPCI
                             {!! Form::radio ('opc_moda_ing','Ordinario',       false,  array('class'=>'minimal','id'=>'radio')) !!} Ordinario
                             {!! Form::radio ('opc_moda_ing','Extraordinario',  true,  array('class'=>'minimal','id'=>'radio')) !!} Extraordinario 
                             {!! Form::radio ('opc_moda_ing','virtual',  false,  array('class'=>'minimal','id'=>'radio')) !!} Virtual 
                            </div><!-- /.box-body -->
                          </div><!-- /.box -->
                      </div>
                    </div><!-- /.col (right)-->
                </div><!-- /.row -->
                <!--FIN  CABECERA FICHA-->

                <div class="row">

                        <div class="col-md-12">
                          <div class="box box-primary">
                            <div class="box-header">
                              <h3 class="box-title"><strong>Datos Personales</strong></h3>
                            </div>
                            <div class="box-body">

                              <!-- INICIO PRIMERA FILA -->
                              <div class="row">
                                <div class="col-md-3">
                                  <div class="form-group {{ $errors->has('apellido_paterno_txt') ? 'has-error' : '' }}">
                                    {!! Form::label ('apellido_paterno_lbl', 'Apellido  Paterno*') !!}
                                    {!! Form::text ('apellido_paterno_txt', '', array('class'=>'form-control','id'=>'apellido_paterno')) !!}
                                  </div>
                                </div>
                                <div class="col-md-4">
                                  <div class="form-group {{ $errors->has('apellido_materno_txt') ? 'has-error' : '' }}">
                                    {!! Form::label ('apellido_materno_lbl', 'Apellido  Materno*') !!}
                                    {!! Form::text ('apellido_materno_txt', '', array('class'=>'form-control')) !!}
                                  </div>
                                </div> 

                                <div class="col-md-5">
                                  <div class="form-group {{ $errors->has('nombres_txt') ? 'has-error' : '' }}">                           
                                    {!! Form::label ('nombres_lbl', 'Nombres*') !!}
                                    {!! Form::text ('nombres_txt', '', array('class'=>'form-control')) !!}
                                  </div>
                                </div>
                              </div>
                              <!-- FIN PRIMERA FILA -->

                              <!-- INICIO SEGUNDA FILA -->
                              <div class='row'>
                                <div class="col-md-3">
                                  <div class="form-group {{ $errors->has('fecha_nac_txt') ? 'has-error' : '' }}">
                                    {!! Form::label ('fecha_nac_lbl', 'Fecha de Nacimiento*') !!}
                                    <div class="input-group">
                                      <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                      </div>
                                      {!! Form::text ('fecha_nac_txt', '', array('class'=>'form-control', 'id'=>'nacimiento')) !!}
                                    </div><!-- /.input group -->
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group {{ $errors->has('lugarNac_txt') ? 'has-error' : '' }}">
                                    {!! Form::label ('lugarNac_lbl', 'Lugar de Nacimiento*') !!}
                                    {!! Form::text ('lugarNac_txt', '', array('class'=>'form-control')) !!}
                                  </div>
                                </div>
                                <div class="col-md-3">
                                  <div class="form-group {{ $errors->has('docIndentidad_txt') ? 'has-error' : '' }}">
                                    {!! Form::label ('docIndentidad_lbl', 'Documento de Identidad*') !!}
                                    {!! Form::text ('docIndentidad_txt', '', array('class'=>'form-control')) !!}
                                  </div>
                                </div>
                              </div>
                              <!-- FIN SEGUNDA FILA -->

                              <!-- INICIO TERCERA FILA -->
                              <div class='row'>
                                <div class="col-md-2">
                                  <label for="">Sexo*</label>
                                  <br>
                                  <div class="form-group {{ $errors->has('opc_sex') ? 'has-error' : '' }}">
                                    {!! Form::radio('opc_sex','M',  true,   array('class'=>'minimal','id'=>'radio')) !!} M
                                    {!! Form::radio('opc_sex','F',  false,  array('class'=>'minimal','id'=>'radio')) !!} F
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group {{ $errors->has('direccion_txt') ? 'has-error' : '' }}">
                                    {!! Form::label ('direccion_lbl', 'Dirección Domiciliaria*') !!}
                                    {!! Form::text ('direccion_txt', '', array('class'=>'form-control')) !!}
                                  </div>
                                </div>
                                <div class="col-md-2">
                                  <div class="form-group {{ $errors->has('telefono_txt') ? 'has-error' : '' }}">
                                    {!! Form::label ('telefono_lbl', 'Teléfono Fijo*') !!}
                                    {!! Form::text ('telefono_txt', '', array('class'=>'form-control')) !!}
                                  </div>
                                </div>
                                <div class="col-md-2">
                                  <div class="form-group  {{ $errors->has('celular_txt') ? 'has-error' : '' }}">
                                    {!! Form::label ('celular_lbl', 'Telefono Celular*') !!}
                                    {!! Form::text ('celular_txt', '', array('class'=>'form-control')) !!}
                                  </div>
                                </div>
                              </div>
                              <!-- FIN TERCERA FILA -->
                              <div class='row' >
                                <div class='row' align='center' style='font-size:9px; background-color:#dde0e4; margin: 5px 15px 5px 15px; padding: 3px 3px 3px 3px; '>
                                <div class="col-md-12" >

                                  <strong>COLEGIO DE PROCEDENCIA</strong>

                                </div>
                              </div>
                                
                              </div>
                              <!-- INICIO CUARTA FILA -->
                              <div class='row' style='background-color:#eaeaea; margin: -5px 0px 1px 0px;'>
                                <div class="col-md-4">
                                  <div class="form-group  {{ $errors->has('colegio_txt') ? 'has-error' : '' }}">
                                    {!! Form::label ('colegio_lbl', 'Nombre del Colegio*') !!}
                                    {!! Form::text ('colegio_txt', '', array('class'=>'form-control')) !!}
                                  </div>
                                </div>
                                <div class="col-md-4">
                                  <div class="form-group  {{ $errors->has('opc_colegio') ? 'has-error' : '' }}" style='margin-top:25px; background-color:#dde0e4; padding: 5px 5px 5px 5px;'>
                                    {!! Form::radio('opc_colegio', 'Nacional',    true,   array('class'=>'minimal', 'id'=>'radio', 'value'=>'opcion_1')) !!} Nacional
                                    {!! Form::radio('opc_colegio', 'Particular',  false,  array('class'=>'minimal', 'id'=>'radio', 'value'=>'opcion_2')) !!} Particular
                                    {!! Form::radio('opc_colegio', 'Parroquial',  false,  array('class'=>'minimal', 'id'=>'radio', 'value'=>'opcion_3')) !!} Parroquial
                                  </div>                                  
                                </div>
                                <div class="col-md-4">
                                  <div class="form-group  {{ $errors->has('ubicacion_cole_txt') ? 'has-error' : '' }}">
                                    {!! Form::label ('ubicacion_cole_lbl', 'Ubicacion de Colegio*') !!}
                                    {!! Form::text ('ubicacion_cole_txt', '', array('class'=>'form-control')) !!}
                                  </div>
                                </div>
                              </div>
                              <!-- FIN CUARTA FILA -->

                              <div class='row' >
                                <div class='row' align='center' style='font-size:9px; background-color:#dde0e4; margin: 5px 15px 5px 15px; padding: 3px 3px 3px 3px; '>
                                <div class="col-md-12" >

                                  <strong>EESTUDIOS REALIZADOS</strong>

                                </div>
                              </div>
                            </div>
                              <!-- INICIO QUINTA FILA -->
                              <div class='row' style='background-color:#eaeaea; margin: -5px 0px 1px 0px;'>
                                <!-- ============ -->
                                <div class="col-md-5">
                                  <div class="form-group  {{ $errors->has('institucion_id') ? 'has-error' : '' }}">
                                    {!! Form::label ('instituciones_lbl', 'Instituto o Universidad*') !!} 
                                    <i id='icon-info' class="fa fa-info-circle" data-toggle='tooltip' data-placement='right' title='Si su Instituto o Universidad no se 
                                    encuentra en la lista, comunicarse con el administrador.'></i><br />
                                    {!! Form::select ('institucion_slc', $inst, '', array('class'=>'form-control', 'name'=>'institucion_id', 'id'=>'institucion_id')) !!}
                                  </div>
                                </div>
                                
                                <div class="col-md-4">
                                  <div class="form-group  {{ $errors->has('carrera_id') ? 'has-error' : '' }}">
                                    <label >Carrera Profesional*</label>
                                    <i id='icon-info' class="fa fa-info-circle" data-toggle='tooltip' data-placement='right' title='Las carreras dependen de la institución seleccionada, en caso no se muestre una carrera, primero seleccione la institución de procedencia. 
                                    Caso contrario comunicarse con la Universidad.'></i><br />
                                    {!! Form::select('carrera_cbo', $carrera_institucion, '', array('class'=>'form-control','id'=>'carrera_id','name'=>'carrera_id'))  !!}
                                  </div>
                                </div>
                                <div class="col-md-3">
                                  <div class="form-group  {{ $errors->has('ciclo_txt') ? 'has-error' : '' }}">
                                    {!! Form::label ('ciclo_lbl', 'Ciclo*') !!}
                                    {!! Form::text ('ciclo_txt', '', array('class'=>'form-control')) !!}
                                  </div>
                                </div>
                              </div>
                              <!-- FIN QUINTA FILA -->

                              <!-- INICIO SEXTA FILA -->
                              <div class='row'>
                                <div class="col-md-8">
                                  <div class="form-group  {{ $errors->has('padres_txt') ? 'has-error' : '' }}">
                                    {!! Form::label('padres_lbl','Apellidos y Nombres del Padre o Apoderado') !!}
                                    {!! Form::text('padres_txt','',array('class'=>'form-control')) !!}
                                  </div>
                                </div>
                                <div class="col-md-4">
                                  <div class="form-group  {{ $errors->has('telefono_txt') ? 'has-error' : '' }}">
                                    {!! Form::label('telefono_lbl','Teléfono')!!}
                                    {!! Form::text('telefono_txt_padres','', array('class'=>'form-control')) !!}
                                  </div>
                                </div>
                              </div><!--/.row -->
                              <!-- INICIO SEXTA FILA -->


                            </div><!-- /.box-body -->

                          </div><!-- /.box -->
                        </div><!-- /.col 12 (left) -->

                </div><!-- /.row -->

                <div class="row">
                  <div class="col-md-12">
                    <div class="box box-primary">

                      <div class="box-header">
                        <h3 class="box-title"><strong>Datos Académicos</strong></h3>
                      </div>
                      <div class="box-body">
                        <div class="row">
                          <div class="col-md-7">
                            <div class="form-group  {{ $errors->has('carrera_postul_id') ? 'has-error' : '' }}">
                              {!! Form::label ('carrer_postul_lbl', 'Carrera a la que Postula*') !!}<br />
                              {!! Form::select ('carrer_postul_cbo', $carr, (Input::old('carrera_postul_id')), array('class'=>'form-control', 'name'=>'carrera_postul_id', 'id'=>'carrera_postul_id')) !!}
                            </div>
                          </div>
                          <div class="col-md-5">
                            <div class="form-group {{ $errors->has('carrera_postul_id') ? 'has-error' : '' }}">
                              {!! Form::label ('modalidad_lbl', 'Modalidad de Estudios*') !!}<br />
                              {!! Form::select ('modalidad_cbo', $moda, (Input::old('modalidad')), array('class'=>'form-control','name'=>'modalidad','id'=>'modalidad')) !!}
                            </div>
                          </div>
                        </div><!-- /.row -->
                      </div><!-- /.box-body -->

                    </div><!-- /.box -->
                  </div><!-- /.col (left) -->
                </div><!-- /.row -->

                <div class="row">
                  <div class="form-group">
                    <div class="col-md-12">
                      <label>
                        {!! Form::checkbox('terminos_chk', 's', true, array('class'=>'minimal','value'=>'1')) !!}
                        <span> Conozco y acepto todas las disposiciones del Reglamento General de Admisión, al cual me someto. Declaro que la información proporcionada es real y verídica.</span>
                      </label>
                    </div>
                  </div>
                </div>
          </div><!-- /.box-body -->

       </div><!-- /.box -->
       <div align="right" style='margin-bottom:25px;'>
              <button DISABLED class="btn btn-primary btn-lg"><strong>1 de 3</strong></button>
              <a type='button' class="btn btn-primary btn-lg" data-toggle="modal" data-target="#enviar_solicitud"><strong>SIGUIENTE <i class="fa fa-arrow-circle-right fa-lg"></i></strong></a>
       </div>
        <!-- Modal -->
        <div class="modal fade modal-primary" id="enviar_solicitud" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">¿Esta seguro de realizar la inscripción?</h4>
              </div>
              <div class="modal-body">
                <i class='fa fa-info-circle' style='margin-right:5px;'></i> Recuerda que una vez guardada ya no podrá rectificar los datos ingresados.
              </div>
              <div class="modal-footer">
                <a type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</a>
                <button type="submit" class="btn btn-primary"><i class="fa fa-save" style='margin-right:5px;'></i> Registrar Solicitud</button>
              </div>
            </div>
          </div>
        </div>
      </div><!--/.col irght-->
  </form>
  <!-- FIN LEFT-->
  

  <!-- INICIO RIGHT-->
  <div class="col-md-3">
    <div class="box box-primary box-solid" >
      <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-book fa-lg" style="margin-right:5px;"> </i> AYUDA </h3>
            <div class="box-tools pull-right">
              <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div><!-- /.box-tools -->
          </div><!-- /.box-header -->
      <div class="box-body">
        
      </div><!-- /.box-body -->
    </div><!-- /.box -->
  </div><!-- /.col (left) -->
  <!-- FIN RIGHT-->

</div><!-- /.row -->
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