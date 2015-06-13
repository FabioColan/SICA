@role('alumno')
@extends('master-alumno')

@section('css')
    
@stop

@section('js-head')
    <!-- jQuery 2.1.3 -->
    <script src="{{ asset('/plugins/jQuery/jQuery-2.1.3.min.js') }}"></script>
@stop

@section('css-head-personalizado')
   
@stop


@section('js')
   <!-- Slimscroll -->
    <script src="{{ asset('/plugins/slimScroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
    <!-- FastClick -->
    <script src="{{ asset('/plugins/fastclick/fastclick.min.js')}}"></script>

@stop

@section('codigo-javascript')
    
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
  		<div class="col-md-8">
          <div class="box box-primary box-solid">
                  <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-upload" style='margin-right:5px;'></i> ADJUNTAR DOCUMENTACIÓN OBLIGATORIA</h3>
                    <div class="box-tools pull-right">
                      <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div><!-- /.box-tools -->
                  </div><!-- /.box-header -->

                  <div class="box-body">
                    
                    {!! Form::open(array('url'=>'adjuntar/grabar','role'=>'form', 'files' => true)) !!}
                          
                          <div class="form-group">
                            {!! Form::label('silabo_lbl','Silabo*') !!}
                            {!! Form::file('silabo_file', array('class'=>'form-control','id'=>'Silabos','name'=>'Silabos')) !!}
                          </div>
                          <div class="form-group">
                            {!! Form::label('certificado_lbl','Certificado de Estudios*') !!}
                            {!! Form::file('certificado_file',array('class'=>'form-control','id'=>'Certificado_de_Estudios','name'=>'Certificado_de_Estudios')) !!}
                          </div>
                          <div class="form-group">
                            {!! Form::label('titulo_lbl','Título Profesional*') !!}
                            {!! Form::file('titulo_file', array('class'=>'form-control','id'=>'Titulo_Profesional','name'=>'Titulo_Profesional')) !!}
                          </div>
                          <h4>Documento opcional</h4>
                          <div class="form-group">
                            {!! Form::label('titulo_lbl','Opcional') !!}
                            {!! Form::file('titulo_file', array('class'=>'form-control','id'=>'Opcional','name'=>'Opcional')) !!}
                          </div>

                  </div><!-- /.box-body -->

          </div><!-- /.box -->

          

          <!--INICIO BOTÓN SIGUIENTE -->
          <div align="right" style='margin-bottom:25px;'>
                  <button DISABLED class="btn btn-primary btn-lg"><strong>3 de 3</strong></button>
                  <a type='button' class="btn btn-primary btn-lg" data-toggle="modal" data-target="#enviar"><strong> ENVIAR <i class="fa fa-paper-plane fa-lg"></i></strong></a>
          </div>
          <!-- Modal -->
          <div class="modal fade modal-primary" id="enviar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="myModalLabel">¿Esta seguro de enviar los archivos adjuntos?</h4>
                </div>
                <div class="modal-body">
                  <i class='fa fa-info-circle' style='margin-right:5px;'></i> Recuerda que una vez guardada la información ya no podrá rectificar los datos ingresados.
                </div>
                <div class="modal-footer">
                  <a type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</a>
                  <button type="submit" class="btn btn-primary"><i class="fa fa-save" style='margin-right:5px;'></i> Enviar </a>
                </div>
              </div>
            </div>
          </div>
          <!--FIN BOTÓN SIGUIENTE -->

          {!! Form::close() !!}

  		</div>
  		<!-- INICIO RIGHT-->
      <div class="col-md-4">
        <div class="box box-primary box-solid" >
          <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-book fa-lg" style='margin-right:5px;'> </i> AYUDA </h3>
                <div class="box-tools pull-right">
                  <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div><!-- /.box-tools -->
              </div><!-- /.box-header -->
          <div class="box-body">
            <dl>
              <dt>Tenga en cuenta lo siguiente</dt>
              <dd><li>Es indispensable que adjunte los 3 principales requisitos para el proceso de convalidación.</li></dd>
              <dd><li>Solo está permitido adjuntar los siguientes tipos de archivos: .pdf, .docx, .doc, .jpg, .png</li></dd>

              
              
            </dl>
          </div><!-- /.box-body -->
        </div><!-- /.box -->
      </div><!-- /.col (left) -->
      <!-- FIN RIGHT-->

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



