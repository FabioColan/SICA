<!DOCTYPE html>
<html>
 <head>
   <meta charset="UTF-8">
   <title>Sistema de Convalidación de Alumnos (SICA)</title>
   <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
   <!-- Bootstrap 3.3.2 -->
   <link href="{{ asset('/css/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
   <!-- Font Awesome Icons -->
   <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
   <!-- Ionicons -->
   <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
   <!-- Theme style -->
   <link href="{{ asset('/css/AdminLTE.css') }}" rel="stylesheet" type="text/css" />
   <!-- AdminLTE Skins. Choose a skin from the css/skins 
        folder instead of downloading all of them to reduce the load. -->
   <link href="{{ asset('/css/skins/_all-skins.css') }}" rel="stylesheet" type="text/css" />
       
   @yield('css')

   @yield('js-head')

   @yield('css-head-personalizado')

   <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
   <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
   <!--[if lt IE 9]>
       <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
       <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
   <![endif]-->
 </head>
 <body class="skin-blue">
       <div class="wrapper">
     
     @include('administrador/dist/header-administrador')      

     <!-- Left side column. contains the logo and sidebar -->
     <aside class="main-sidebar">
       <!-- sidebar: style can be found in sidebar.less -->
       <section class="sidebar">
           @include('administrador/dist/menu-administrador')
       </section>
       <!-- /.sidebar -->
     </aside>


     <!-- Content Wrapper. Contains page content -->
     <div class="content-wrapper">
       
       <!-- Main content -->
       <section class="content">
         <!-- Info boxes -->
         @yield('contenido')

       </section><!-- /.content -->
     </div><!-- /.content-wrapper -->

     @include('administrador/dist/footer-administrador')

   </div><!-- ./wrapper -->

   
   <!-- AdminLTE App -->
   <script src="{{ asset('/js/app.min.js') }}" type="text/javascript"></script>
   <!-- Bootstrap 3.3.2 JS -->
   <script src="{{ asset('/css/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
   
   

   @yield('js')

   <!--Codigo Javascript-->
     @yield('codigo-javascript')
      
    
 </body>

  
</html>