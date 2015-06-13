

@role('alumno')
@extends('master-alumno')

@section('css')
    
    <!-- DATA TABLES -->
    <link href="{{ asset('/plugins/datatables/dataTables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
    

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

    
    
    <script src="{{ asset('/plugins/datatables/jquery.dataTables.js')}}" type="text/javascript"></script>

    <script src="{{ asset('/plugins/datatables/dataTables.bootstrap.js')}}" type="text/javascript"></script>

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

  <script type="text/javascript">
      $(function () {
        $("#example1").dataTable();
        $('#lista_cursos').dataTable({
          "bPaginate": true,
          "bLengthChange": false,
          "bFilter": false,
          "bSort": true,
          "bInfo": true,
          "bAutoWidth": false
        });
      });
    </script>
  
@stop


@section('contenido')

 <div class="row">
  
            <div class="col-md-8">

              <!-- INICIO FORM DE REGISTAR/SELECCIONAR CURSOS PERSONALIZADO -->
              <div class="box box-primary box-solid">
                  <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-graduation-cap fa-lg" style='margin-right:5px;'></i> REGISTRO DE CURSOS A CONVALIDAR</h3>
                    <div class="box-tools pull-right">
                      <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div><!-- /.box-tools -->
                  </div><!-- /.box-header -->

                  <div class="box-body">
                    <div class="row">

              {!! Form::open(array('method' => 'post', 'role' => 'form', 'url' => 'registrar/grabar')) !!}

                              <div class="col-md-7">
                                <div class="form-group {{ $errors->has('cursos') ? 'has-error' : '' }}">
                                  {!! Form::label('curso_lbl','Seleccione Curso*')  !!}
                                  {!! Form::select('curso_cbo', $cursos_institucion_carrera, (Input::old('cursos')) , array('class'=>'form-control','name'=>'cursos','id'=>'cursos')) !!}
                                  @if ($errors->has('cursos')) <p class='help-block'>{{ $errors->first('cursos') }} </p> @endif
                                </div>
                              </div>
                              <div class="col-md-2">
                                <div class="form-group {{ $errors->has('horas') ? 'has-error' : '' }}">
                                {!! Form::label('horas_lbl','Horas*')  !!}
                                {!! Form::text('horas_txt', (Input::old('horas')), array('class'=>'form-control','name'=>'horas','id'=>'horas')) !!}
                                @if ($errors->has('horas')) <p class='help-block'>{{ $errors->first('horas') }} </p> @endif
                                </div>
                              </div>
                              <div class="col-md-2">
                                <div class="form-group {{ $errors->has('nota') ? 'has-error' : '' }}">
                                {!! Form::label('nota_lbl','Nota*')  !!}
                                {!! Form::text('nota_txt', (Input::old('nota')) , array('class'=>'form-control','name'=>'nota','id'=>'nota')) !!}
                                @if ($errors->has('nota')) <p class='help-block'>{{ $errors->first('nota') }} </p> @endif
                                </div>
                              </div>
                              <div class="col-md-1">
                                <button style="margin-top:25px; margin-bottom:25px;" type="submit" class="btn btn-success">+</button>
                              </div>

              {!! Form::close() !!}<!-- /.form (seleccion/agregar/grabar de cursos)-->
                        

                    </div><!-- /.row -->
                    <div class="row">
                      <div class="col-md-12">
                        <!-- INICIO LISTADO CURSOS -->
                        <div class="box box-primary box-solid">

                          <div class="box-body">
                            <table id="lista_cursos" class="table table-bordered table-hover">
                                <thead style="background-color:#3c8dbc; color:#fff;">

                                  <tr>
                                    <th hidden width="3%">Id</th>
                                    <th width="40%">Cursos</th>
                                    <th width="10%">Horas</th>
                                    <th width="10%">Nota</th>
                                    <th width="5%"></th>
                                  </tr> 
                                </thead>
                                <tbody>
                                  @foreach ($curso_usua_selec as $curs)
                                    <tr data-id="{{ $curs->id }}">
                                          <td hidden>{{ $curs->id }}</td>
                                          <td>{{ $curs->nombre }}</td>
                                          <td>{{ $curs->horas }}</td>
                                          <td>{{ $curs->nota }}</td>
                                          <td align='center'><a type="button" href="#" class="btn btn-xs btn-danger btn-delete">Eliminar</a></td>
                                    </tr>
                                  @endforeach
                                </tbody>
                            </table>
                          </div>
                        </div>
                        <!-- FIN LISTADO CURSOS  -->
                      </div>
                    </div>
                    <!-- INICIO FORM DE REGISTAR NUEVOS CURSOS PERSONALIZADO -->
                    <div class="row">
                    
                    {!! Form::open(array('method' => 'post', 'role' => 'form', 'url' => 'registrar/grabar-new')) !!}
                    <div class="row">
                      <div class="col-md-12">
                              <div class="col-md-7">
                                <div class="form-group {{ $errors->has('curso_nombre') ? 'has-error' : '' }}">
                                  {!! Form::label('curso_nuevo_lbl','Registre nuevo curso', array('data-toggle'=>'tooltip','data-placement'=>'right','title'=>'Si el curso no se encuentra en la lista anterior, registrlo desde aquí.'))  !!}
                                  {!! Form::text('curso_nuevo_txt', '',array('class'=>'form-control','name'=>'curso_nombre','id'=>'curso_nombre')) !!}
                                  @if ($errors->has('curso_nombre')) <p class='help-block'>{{ $errors->first('curso_nombre') }} </p> @endif
                                </div>
                              </div>
                              <div class="col-md-2">
                                  <button style="margin-top:25px;" type="submit" class="btn btn-warning">+</button>
                              </div>
                              <div class="col-md-3">
                              </div>
                      </div>
                      
                    </div><!-- /.row -->
                    {!! Form::close() !!}
                    </div>
                    <!-- FIN FORM DE REGISTAR NUEVOS CURSOS PERSONALIZADO -->  
                    <div class="row">
                      <div class="col-md-12">
                        <div class="nota" style="color:#68a026;" >
                            @if (Session::has('flash_message'))
                              {{ Session::get('flash_message') }}
                            @endif
                        </div>
                      </div>
                    </div>

                  </div><!-- /.box-body -->
              </div><!-- /.box -->

              <!--INICIO BOTÓN SIGUIENTE -->
              <div align="right" style='margin-bottom:25px;'>
                      <button DISABLED class="btn btn-primary btn-lg"><strong>2 de 3</strong></button>
                      <a type='button' class="btn btn-primary btn-lg" data-toggle="modal" data-target="#registrar_cursos"><strong>SIGUIENTE <i class="fa fa-arrow-circle-right fa-lg"></i></strong></a>
              </div>
              <!-- Modal -->
              <div class="modal fade modal-primary" id="registrar_cursos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel">¿Esta seguro de registrar los cursos seleccionados?</h4>
                    </div>
                    <div class="modal-body">
                      <i class='fa fa-info-circle' style='margin-right:5px;'></i> Recuerda que una vez guardada la información ya no podrá rectificar los datos ingresados.
                    </div>
                    <div class="modal-footer">
                      <a type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</a>
                      <a type="button" href="{{ url('/enviar/cursos') }}" class="btn btn-primary"><i class="fa fa-save" style='margin-right:5px;'></i> Registrar Cursos</a>
                    </div>
                  </div>
                </div>
              </div>
              <!--FIN BOTÓN SIGUIENTE -->

              <!-- FIN FORM DE REGISTAR/SELECCIONAR CURSOS PERSONALIZADO -->
            </div><!-- /.col (left) -->
            
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
                    <dt>IMPORTANTE:</dt>
                    <dd>LOS NOMBRES DE LOS CURSOS QUE REGISTRE DEBEN SER EXACTAMENTE IGUALES A LOS QUE FIGURAN EN SU CERTIFICADO DE ESTUDIOS.</dd>
                    <dt>Paso 1:</dt>
                    <dd>Seleccione el curso que desea se le convalide. Si no encuentra el curso registrelo. <img src="{{ asset('/img/nuevo_curso.png')}}" /></dd>
                    <dt>Paso 2:</dt>
                    <dd>Verifique que ha seleccionado todos los cursos a convalidar, no podrá rectificar una vez que envía la información.</dd>
                    <dt>Paso 3:</dt>
                    <dd>Use el botón <img src="{{ asset('/img/boton_siguiente.png')}}" /> para continuar con el proceso.</dd>
                  </dl>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col (left) -->
            <!-- FIN RIGHT-->

             {!! Form::open(['route'=>['curso.delete' ,':CURSO_ID'], 'method'=>'DELETE', 'id'=>'form-delete']) !!}

             {!! Form::close() !!}
</div>

@endsection

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