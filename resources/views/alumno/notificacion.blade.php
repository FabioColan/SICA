@role('alumno')

@extends('master-alumno')

@section('css')
    <!-- daterange picker -->
    <link href="{{ asset('/plugins/daterangepicker/daterangepicker-bs3.css')}}" rel="stylesheet" type="text/css" />

    <!-- iCheck for checkboxes and radio inputs -->
    <link href="{{ asset('/plugins/iCheck/all.css')}}" rel="stylesheet" type="text/css" />

    <!-- Theme style -->
    <link href="{{ asset('/css/AdminLTE.css')}}" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="{{ asset('/css/skins/_all-skins.css')}}" rel="stylesheet" type="text/css" />
    
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
     <!-- jQuery 2.1.3 -->
    <script src="{{ asset('/plugins/jQuery/jQuery-2.1.3.min.js') }}"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="{{ asset('css/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <!-- FastClick -->
    <script src="{{ asset('/plugins/fastclick/fastclick.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('/js/app.min.js') }}" type="text/javascript"></script>
        <!-- InputMask -->
    <script src="{{ asset('/plugins/input-mask/jquery.inputmask.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/plugins/input-mask/jquery.inputmask.date.extensions.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/plugins/input-mask/jquery.inputmask.extensions.js') }}" type="text/javascript"></script>
    <!-- date-range-picker -->
    <script src="{{ asset('/plugins/daterangepicker/daterangepicker.js') }}" type="text/javascript"></script>
    <!-- iCheck 1.0.1 -->
    <script src="{{ asset('/plugins/iCheck/icheck.min.js') }}" type="text/javascript"></script>
    <!-- SlimScroll -->
    <script src="{{ asset('/plugins/slimScroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
    <!-- FastClick -->
    <script src="{{ asset('/plugins/fastclick/fastclick.min.js') }}"></script>

@stop

@section('codigo-javascript')
    <!-- page script -->
    <script type="text/javascript">
      $(function () {
        //Datemask dd/mm/yyyy
        $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
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
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Notificaciones
            <small>-</small>
          </h1>
          
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-9">
              <div class="box box-primary">
                
                <div class="box-body no-padding">
                 
                  <div class="table-responsive mailbox-messages">
                    <table class="table table-hover table-striped">
                      <thead style="background-color:#3c8dbc; color:#fff;">
                        <tr>
                          <th></th>
                          <th>Codigo Postulante</th>
                          <th>Nombres y Apellidos</th>
                          <th>Descripción</th>
                          <th>Id Estado</th>
                          <th>Fecha</th>
                        </tr> 
                      </thead>
                      <tbody>
                        @foreach ($notifi as $noti)
                          <tr>  
                                <td class="mailbox-star"><a href="#"><i class="fa fa-hand-o-right"></i></a></td>
                                <td>{{ $noti->codigo }}</td>
                                <td class="mailbox-name">{{ $noti->nombres }}, {{ $noti->paterno }} {{ $noti->materno }}</td>
                                <td class="mailbox-subject">{{ $noti->descripcion }}</td>
                                <td class="mailbox-star">{{ $noti->estado }}</td>
                                <td class="mailbox-date">{{ $noti->fecha }}</td>
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
                    <dt>NOTA:</dt>
                    <dd>Aquí se mostrará el progreso de su convalidación.</dd>
                    <dd>Cuando termine el proceso será informado(a) desde aquí y por correo.</dd>
                    <dd>Permaneza pendiente hasta recibir el mensaje de confirmación satisfactoria al proceso de convalidación.</dd>
                    <dt>Solo debe seguir 3 pasos, luego espere a recibir indicaciones de parte de la Comisión de Convalidación de la Universidad.</dt>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col (left) -->
            <!-- FIN RIGHT-->

          </div><!-- /.row -->
        </section><!-- /.content -->
      </div>
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