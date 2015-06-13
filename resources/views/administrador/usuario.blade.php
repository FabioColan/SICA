@role('admin')

@extends('master-administrador')

@section('css')

@stop

@section('js-head')
    <script src="{{ asset('/plugins/jQuery/jQuery-2.1.3.min.js') }}"></script>
@stop

@section('js')
    
@stop

@section('codigo-javascript')
    <script type="text/javascript">
      $(document).ready(function(){
        setTimeout(function() {
        $(".nota").fadeOut(1500);
        },3000);

        $('.btn-deshabilitar').click(function(){

              //e.preventDefault();

              var row = $(this).parents('tr');
              var id = row.data('id');
              
              var form = $('#form-deshabilitar');
              var url = form.attr('action').replace(':USER_ID',id);
              var data = form.serialize();
              
              $.post(url, data, function(result){

                  location.reload();
                  document.getElementById(mensaje).innerHTML=result;
                  

              }).fail(function(){
                  row.show;
              });

          });

        $('.btn-habilitar').click(function(){

              //e.preventDefault();

              var row = $(this).parents('tr');
              var id = row.data('id');
              
              var form = $('#form-habilitar');
              var url = form.attr('action').replace(':USER_ID',id);
              var data = form.serialize();
              
              $.post(url, data, function(result){
                  
                  location.reload();
                  document.getElementById(mensaje).innerHTML=result;
                  

              }).fail(function(){
                  row.show;
              });

          });



      });
  </script>

@stop

@section('contenido')
<div class="row">
            <div class="col-md-12">
              <div class="box box-info">

                <div class="box-header">
                  
                    <div class="col-md-10">
                        <h1 class="box-title">Lista de Usuarios :</h1>
                        {{$post = DB::table('users')->count()}} usuarios registrados
                    </div>

                    <div class="col-md-2">
                        <a href="{{url('/registrar_usuario')}}" class="btn btn-sm btn-flat btn-block bg-green"><i class="fa fa-user-plus fa-lg" style='margin-right:5px;'></i> Registrar Usuario</a>
                    </div>
                </div>

                <div class="box-body">
                  <section class="content">
                  <div class="row">
                    <div class="col-md-12">
                        <div class="box-body">
                          <table id="example2" class="table table-bordered table-hover responsive">
                            <thead style="background-color:#3c8dbc; color:#fff; font-size:10px;">
                              <tr>
                                <th width="3%"></th>
                                <th width="20%">NOMBRE</th>
                                <th width="20%">E-MAIL</th>
                                <th width="20%">ROL</th>
                                <th width="20%">FECHA DE CREACION</th>
                                <th width="20%">FECHA DE MODIFICACION</th>
                                <th></th>
                               </tr> 
                            </thead>
                            <tbody>

                                @foreach ($us as $u)
                                 <tr data-id="{{ $u->id }}">  
                                   <td class="mailbox-star"><a><i class="fa fa-user"></i></a></td>
                                   <td class="mailbox-name">{{ $u->name }}</td>
                                   <td class="mailbox-name">{{ $u->email }}</td>
                                   <td class="mailbox-name">{{ $u->rol }}</td>
                                   <td class="mailbox-date">{{ $u->created_at }}</td>
                                   <td class="mailbox-date">{{ $u->updated_at }}</td>
                                   <td >
                                    @if ($u->rol == 'Inactivo')
                                        <button class="btn btn-block btn-default btn-xs bg-green btn-habilitar">Habilitar</button>
                                    @elseif ($u->rol == 'Administrador')
                                    
                                    @else
                                        <button class="btn btn-block btn-default btn-xs bg-red btn-deshabilitar">Deshabilitar</button>
                                    @endif
                                    </td>

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
  {!! Form::open(['route'=>['user.deshabilitar' ,':USER_ID'], 'method'=>'POST', 'id'=>'form-deshabilitar']) !!}
  {!! Form::close() !!}  
  {!! Form::open(['route'=>['user.habilitar' ,':USER_ID'], 'method'=>'POST', 'id'=>'form-habilitar']) !!}
  {!! Form::close() !!}  
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