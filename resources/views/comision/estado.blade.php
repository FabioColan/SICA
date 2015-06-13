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
    <!-- InputMask -->
    <script src="{{asset('/plugins/input-mask/jquery.inputmask.js') }}" type="text/javascript"></script>
    <script src="{{asset('/plugins/input-mask/jquery.inputmask.date.extensions.js') }}" type="text/javascript"></script>
    <script src="{{asset('/plugins/input-mask/jquery.inputmask.extensions.js') }}" type="text/javascript"></script>

    <!-- iCheck 1.0.1 -->
    <script src="{{ asset('/plugins/iCheck/icheck.min.js') }}" type="text/javascript"></script>


    <!-- date-range-picker -->
    <script src="../../plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <!-- bootstrap color picker -->
    <script src="../../plugins/colorpicker/bootstrap-colorpicker.min.js" type="text/javascript"></script>
    <!-- bootstrap time picker -->
    <script src="../../plugins/timepicker/bootstrap-timepicker.min.js" type="text/javascript"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="../../plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='../../plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/app.min.js" type="text/javascript"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../dist/js/demo.js" type="text/javascript"></script>
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
        $("#nacimiento").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
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
            <!-- Inicio Seccion de Solicitu de Convalidación -->
            <div class="col-md-9">

              <div class="box box-info">
                <div class="box-header">
                  <h3 class="box-title">Estado de Trámite</h3>
                </div>
                <div class="box-body">
                  <div class="row">
                    <div class="form-group">
                      <div class="col-md-4">
                         
                          <div class="form-group">
                            <label>Rango de Fechas:</label>
                            <div class="input-group">
                              <span class="input-group-addon">
                                <input type="checkbox" >
                              </span>
                            
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                               <input type="text"  class="form-control pull-right" id="reservation"/>
                           
                             
                            </div><!-- /input-group -->
                          </div><!-- /.form group -->
                      </div>

                      <div class="col-md-3">

                        <label for="">Estado:</label>
                          <div class="input-group">
                              <span class="input-group-addon">
                                <input type="checkbox">
                              </span>
                            <select class="form-control">
                              <option>Completo</option>
                              <option>Incompleto</option>
                              <option>Expedito</option>
                            </select>
                          </div><!-- /input-group -->
                      </div>
                      <div class="col-md-3">
                        <label for="">Procedencia:</label>
                          <div class="input-group">
                                <span class="input-group-addon">
                                  <input type="checkbox">
                                </span>
                              <select class="form-control">
                                <option>Universidad</option>
                                <option>Instituto Superior</option>
                              </select>
                          </div>
                      </div>
                      <div class="col-md-2">
                        <button style="margin-top:25px; width-max:110px; width:100%;" type="submit" class="btn btn-primary">FILTRAR</button>
                      </div>

                    </div>
                  </div>


                  <div class="row" >
                    <section class="content">
                    <div class="row">
                      <div class="col-md-12">
                          <div class="box-body">
                            <table id="example2" class="table table-bordered table-hover">
                              <thead style="background-color:#3c8dbc; color:#fff;">
                                <tr>
                                  <th>Código Alumno</th>
                                  <th>Trámite</th>
                                  <th>Estado</th>
                                  <th>Fecha Inicio</th>
                                </tr> 
                              </thead>
                              <tbody>
                                <tr>
                                  <td>0703000406</td>
                                  <td>Ampliación de Convalidación</td>
                                  <td>Incompleto</td>
                                  <td>01/01/2015</td>
                                </tr>
                                <tr>
                                  <td>0703000406</td>
                                  <td>Ampliación de Convalidación</td>
                                  <td>Incompleto</td>
                                  <td>01/01/2015</td>
                                </tr>
                                <tr>
                                  <td>0703000406</td>
                                  <td>Solicitud de Convalidación</td>
                                  <td>Completo</td>
                                  <td>01/01/2013</td>
                                </tr>
                              </tbody>
                              
                            </table>
                          </div><!-- /.box-body -->

                      </div>
                      
                    </div>
                  </section>




                    
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