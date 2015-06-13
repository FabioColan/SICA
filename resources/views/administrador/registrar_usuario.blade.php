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

@section('js')
    <!-- FastClick -->
    <script src="{{ asset('/plugins/fastclick/fastclick.min.js') }}"></script>
    
    <!-- Sparkline -->
    <script src="{{ asset('/plugins/sparkline/jquery.sparkline.min.js') }}" type="text/javascript"></script>
    <!-- jvectormap -->
    <script src="{{ asset('/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}" type="text/javascript"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('/plugins/daterangepicker/daterangepicker.js') }}" type="text/javascript"></script>
    <!-- datepicker -->
    <script src="{{ asset('/plugins/datepicker/bootstrap-datepicker.js') }}" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="{{ asset('/plugins/iCheck/icheck.min.js') }}" type="text/javascript"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="{{ asset('/plugins/slimScroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
    <!-- ChartJS 1.0.1 -->
    <script src="{{ asset('/plugins/chartjs/Chart.min.js') }}" type="text/javascript"></script>

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('/js/pages/dashboard2.js') }}" type="text/javascript"></script>

    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('/js/demo.js') }}" type="text/javascript"></script>

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
    
@stop

@section('contenido')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><a href='/' type='button' class='btn bg-maroon' style='margin-rigth:5px;'><i class="fa fa-arrow-circle-left fa-lg" style='margin-right:5px;'> </i> Volver </a></div>
                <div class="panel-body">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> Hubo algunos problemas con su registro<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
               
                   
                {!! Form::open(array('method' => 'post', 'role' => 'form', 'url' => 'registrar_usuario/grabar-new')) !!}
                <div class="box box-success box-solid">
                  <div class="box-header with-border">
                    <h3 class="box-title">REGISTRAR NUEVOS USUARIOS</h3>
                    <div class="box-tools pull-right">
                      <!-- <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button> -->
                    </div><!-- /.box-tools -->
                  </div><!-- /.box-header -->

                  <div class="box-body">
                    <div class="row">

                              <div class="col-md-5">
                                <div class="form-group {{ $errors->has('nombre_nuevo_txt') ? 'has-error' : '' }}">
                                  {!! Form::label('plan_estudios_upci_nombre_lbl','Nombre')  !!}
                                  {!! Form::text('nombre_nuevo_txt', (Input::old('name')),array('class'=>'form-control','name'=>'name','id'=>'name')) !!}
                              </div>
                              </div>
                              <div class="col-md-5">
                                <div class="form-group {{ $errors->has('email_nuevo_txt') ? 'has-error' : '' }}">
                                  {!! Form::label('plan_estudios_upci_codigo_lbl','Correo electrónico')  !!}
                                  {!! Form::text('email_nuevo_txt', (Input::old('email')),array('class'=>'form-control','name'=>'email','id'=>'email')) !!}
                                </div>
                              </div>
                              <div class="col-md-5">
                                <div class="form-group {{ $errors->has('contraseña_nuevo_txt') ? 'has-error' : '' }}">
                                  {!! Form::label('plan_estudios_upci_codigo_lbl','Contraseña')  !!}
                                  {!! Form::password('contraseña_nuevo_pass', array('class'=>'form-control','name'=>'password','id'=>'password')) !!}
                                </div>
                              </div>
                              <div class="col-md-5">
                                <div class="form-group {{ $errors->has('contraseña_nuevo_repit_txt') ? 'has-error' : '' }}">
                                  {!! Form::label('plan_estudios_upci_codigo_lbl','Confirmar Contraseña')  !!}
                                  {!! Form::password('contraseña_repit_pass', array('class'=>'form-control','name'=>'password_confirmation','id'=>'password_confirmation')) !!}
                                </div>
                              </div>
                              <div class="col-md-5">
                                <div class="form-group {{ $errors->has('tipo_usuario_txt') ? 'has-error' : '' }}">
                                  {!! Form::label('instituciones_nuevo_lbl','Tipo de usuario')  !!}
                                  {!! Form::select('tipo_usuario_txt', $rol, '',array('class'=>'form-control','name'=>'tipo_usuario','id'=>'tipo_usuario')) !!}
                                </div>
                              </div>
                              <div class="col-md-1">
                                  <button style="margin-top:25px;" type="submit" class="btn btn-warning">Crear Usuario</button>
                              </div>

                    </div><!-- /.row -->
                  </div><!-- /.box-body -->
                </div><!-- /.box -->
                {!! Form::close() !!}









                </div>
                
            </div>
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