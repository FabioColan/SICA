<!-- sidebar menu: : style can be found in sidebar.less -->
  <ul class="sidebar-menu">
  <li class="header">MENÚ COMISIÓN</li>
   
  <li class="{{ $active_principal }} treeview">
  <a href="{{url('/')}}">
  <i class="fa fa-envelope"></i> <span>Principal</span> 
  </a>
  </li>
  <li class="{{ $active_validar }} treeview">
  <a href="{{url('/')}}">
  <i class="fa fa-edit"></i> <span>Validar Adjuntos</span>  
  </a>
  </li>
  <li class="{{ $active_convalidar }} treeview">
  <a href="{{url('/')}}">
  <i class="fa fa-edit"></i> <span>Convalidar Cursos</span>  
  </a>
  </li>
  <li class="{{ $active_reporte }} treeview">
  <a href="#">
  <i class="fa fa-check-square-o"></i> <span>Reportes</span> 
  <ul class="treeview-menu">
  <li class="{{ $active_class_alumno }}"><a href="#"><i class="fa fa-circle-o"></i> Reporte Alumnos</a></li>
  <li class="{{ $active_class_cuadro }}"><a href="#"><i class="fa fa-circle-o"></i> Cuadro de Convalidación</a></li>
  <li class="{{ $active_class_memorando }}"><a href="#"><i class="fa fa-circle-o"></i> Memorandos</a></li>
  </ul>
  </a>
  </li>
  <li class="{{ $active_estado }} treeview">
  <a href="{{url('/comision/estado')}}">
  <i class="fa fa-clock-o"></i> <span>Estado de Trámite</span> 
  </a>
  </li>
  </ul>