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
          <!-- row -->
          <div class="row">
            <div class="col-md-12">
              <!-- The time line -->
              <ul class="timeline">

                <li>
                  <i class="fa fa-user bg-aqua"></i>
                  <div class="timeline-item">
                    <span class="time"><i class="fa fa-clock-o"></i> Ahora</span>
                    <h3 class="timeline-header"><a href="#">Pasos e indicaciones </a> importantes para la convalidación</h3>
                    <div class="timeline-body">
                      <div class="row" style="margin-top: 10px;">
                        <div class="col-md-5">
                          Pasos para la convalidación:<br/>
                          1. Llenar la solicitud de inscripción. Ir a Solicitar/Convalidación. Revisar bien los datos ingresados ya que no podrá volver a registrarlos.<br/>
                          2. Realizar la selección de cursos a convalidar de acuerdo a su certificado de estudios superiores. En caso de no encontrar en la lista desplegable el nombre del curso necesario, puede registrarlo. 
                          Recuerde que es importante que los nombres de los cursos deben ser exactamente identicos a los que figuran en su certificado de estudios. Esta información tampoco es modificable.<br/>

                          3. Adjunte la documentación necesaria, son tres documentos obligatorios principales: Título Profesional, Certificado de Estudios, Sílabos. Previamente debe escanear su documentación en formato PDF, un archivo por cada documento requerido.
                          <br/>
                          <p>Usted puede iniciar en cualquier momento cada paso, siempre que no envíe la información.</p>
                          <p>En la sección notificaciones usted encontrará información sobre el proceso en curso de convalidación.</p>

                        </div>

                        <div class="col-md-5">

                        </div>
                      </div>
                    </div>
                  </div>
                </li>
                <!-- END timeline item -->
                <!-- timeline item -->
                <li>
                  <i class="fa fa-user bg-aqua"></i>
                  <div class="timeline-item">
                    <span class="time"><i class="fa fa-clock-o"></i> Ahora</span>
                    <h3 class="timeline-header"><a href="#">Documentos</a> Importantes</h3>
                    <div class="timeline-body">
                        

                        <div class="row" style="margin-top: 10px;">

                          <div class="col-md-5">
                      <table id="example2" class="table table-bordered table-hover">
                            <thead style="background-color:#00c0ef; color:#fff;">
                              <tr>
                                <th width="35%">Nombre de documentos</th>
                                <th width="25%">Fecha de publicación</th>
                              </tr> 
                            </thead>
                            <tbody>
                              <tr>
                                <td>Manual de Usuario.pdf</td>
                                <td>01/05/2015</td>
                              </tr>
                              <tr>
                                <td>Reglamento Interno.pdf</td>
                                <td>01/05/2015</td>
                              </tr>
                              <tr>
                                <td>Requisitos para Convalidar.pdf</td>
                                <td>01/05/2015</td>
                              </tr>
                              <tr>
                                <td>Guia del Estudiante.pdf</td>
                                <td>01/05/2015</td>
                              </tr>
                              <tr>
                                <td>Resolución UPCI.pdf</td>
                                <td>01/05/2015</td>
                              </tr>
                              <tr>
                                <td>Convenios UPCI.pdf</td>
                                <td>01/05/2015</td>
                              </tr>
                            </tbody>
                            
                        </table>
                      </div>

                      <div class="col-md-5">
                        <object 
                      data="../adjuntos/ejemplo.pdf#toolbar=1&amp;navpanes=1&amp;scrollbar=1&amp;page=5&amp;view=FitH&amp;zoom=75"
                      type="application/pdf"
                      width="135%" height="300px"
                      >
                      <param name="zoom" value="10%" />
                    </object>
                      </div>
                      </div>



                    </div>
                  </div>
                </li>
                <!-- END timeline item -->
                <!-- timeline item -->
                <li>
                  <i class="fa fa-envelope bg-blue"></i>
                  <div class="timeline-item">
                    <span class="time"><i class="fa fa-clock-o"></i> Ahora</span>
                    <h3 class="timeline-header"><a href="http://www.upci.edu.pe/admision.php?op=contacto">Contactenos</a></h3>
                    <div class="timeline-body">
                      <div class="row" style="margin-top: 10px;">

                          <div class="col-md-5">
                          <p>Universidad Peruana de Ciencias e Informatica<br>
                            Jr. Talara 748-752, Jesús Maria - Lima - Perú<br>
                            Telefono: 330-7087 | Correo: contactenos@upci.edu.pe</p>
                       <img src="http://upload.wikimedia.org/wikipedia/commons/b/bc/Panoramico-casona-upci.jpg" width="350" height="130" alt="..." class='margin' />
                       
                          </div>

                      <div class="col-md-6">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d975.3959890251281!2d-77.0420125!3d-12.072121!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9105c81501a2e5ef%3A0xd63a7e33630701a9!2sUniversidad+Peruana+de+Ciencias+e+Inform%C3%A1tica+(UPCI)!5e0!3m2!1ses-419!2spe!4v1429369310600" width="500" height="200" frameborder="0" style="border:0"></iframe>
                      </div>
                      </div>
                    </div>
                    <div class="timeline-footer">
                      <a href="http://www.upci.edu.pe/admision.php?op=contacto" class="btn btn-xs bg-blue">Consultar</a>
                    </div>
                  </div>
                </li>
                <!-- END timeline item -->
                <li>
                  <i class="fa fa-clock-o bg-gray"></i>
                </li>
              </ul>
            </div><!-- /.col -->
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