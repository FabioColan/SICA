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
    <script type="text/javascript">
      $(document).ready(function(){
        setTimeout(function() {
        $(".nota").fadeOut(1500);
        },3000);

        $('.btn-delete').click(function(){

              //e.preventDefault();

              var row = $(this).parents('tr');
              var id = row.data('id');
              
              var form = $('#form-delete');
              var url = form.attr('action').replace(':ADJUNTO_ID',id);
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
      <div class="box box-primary box-solid">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-upload" style='margin-right:5px;'></i> LISTA DE ARCHIVOS ADJUNTOS </h3>
          <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div><!-- /.box-tools -->
        </div><!-- /.box-header -->
        <div class="box-body">
          <table id="example2" class="table table-bordered table-hover">
            <thead style="background-color:#00c0ef; color:#fff;">
              <tr>
                <th hidden></th>
                <th width="20%">Nombre archivos adjuntados</th>
                <th width="15%">Fecha</th>
                <th width="5%">Acción</th>
              </tr> 
            </thead>
            <tbody>

              @foreach ($var_doc as $e)
              <tr data-id="{{ $e->id }}">
                <td hidden>{{ $e->nombre }}</td>
                <td style='font-size:12px;'>{{ $e->nombre }}</td>
                <td style='font-size:12px;'>{{ $e->fecha }}</td>
                <td ><button class="btn btn-block btn-default btn-xs bg-red btn-delete">Eliminar</button></td>
              </tr>
              @endforeach

            </tbody>

          </table>
        </div><!-- /.box-body -->
        </div>
      </div>
    </div>

  <div class="row">
  		<div class="col-md-8">
          <div class="box box-primary box-solid">
                  <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-upload" style='margin-right:5px;'></i> ADJUNTAR ARCHIVOS</h3>
                    <div class="box-tools pull-right">
                      <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div><!-- /.box-tools -->
                  </div><!-- /.box-header -->

                  <div class="box-body">
                    
                    {!! Form::open(array('url'=>'adjuntar/completar','role'=>'form', 'files' => true)) !!}
                      <div class="row">
                          <div class='col-md-10'>
                            <div class="form-group">
                              {!! Form::label('adicional_lbl','Archivo Adicional*') !!}
                              {!! Form::file('adicional_file', array('class'=>'form-control','id'=>'Archivo_Adicional','name'=>'Archivo_Adicional')) !!}
                            </div>
                          </div>
                          <div class='col-md-2' style='margin-top:25px;'>
                            <div class="form-group">
                              <button class="btn btn-success"> + </button>
                            </div>
                          </div>
                      </div>
                    {!! Form::close() !!}
                  </div><!-- /.box-body -->

          </div><!-- /.box -->

          
          {!! Form::open(array('url'=>'adjuntar/enviar','role'=>'form', 'files' => true)) !!}
          <!--INICIO BOTÓN SIGUIENTE -->
          <div align="right" style='margin-bottom:25px;'>
                  <a type='button' class="btn btn-primary btn-lg" data-toggle="modal" data-target="#enviar"><strong> ENVIAR <i class="fa fa-paper-plane fa-lg"></i></strong></a>
          </div>
          <input type='hidden' value='1'></input>
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
              <dd><li>Usted puede eliminar los adjuntos incorrectos y adicionar los archivos solicitados.</li></dd>
              <dd><li>Solo está permitido adjuntar archivos de tipo .pdf</li></dd>
            </dl>
          </div><!-- /.box-body -->
        </div><!-- /.box -->
      </div><!-- /.col (left) -->
      <!-- FIN RIGHT-->

  </div>
  {!! Form::open(['route'=>['adjunto.delete' ,':ADJUNTO_ID'], 'method'=>'DELETE', 'id'=>'form-delete']) !!}
  {!! Form::close() !!}  

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
