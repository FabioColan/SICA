  <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MENÚ ADMINISTRADOR</li>
            <li class="{{ $active_usuario }} treeview">
              <a href="{{url('/usuario')}}">
                <i class="fa fa-user"></i> <span>Principal</span> 
              </a>
            </li>
            <li class="{{ $active_mantenimiento }} treeview">
              <a href="#">
                <i class="fa fa-edit"></i> <span>Mantenimiento</span> 
                      <ul class="treeview-menu">
                        <li class="{{ $active_class_inst }}"><a href="{{url('/instituciones')}}"><i class="fa fa-edit"></i>Instituciones</a></li>
                        <li class="{{ $active_class_carr_inst }}"><a href="{{url('/carreras_instituciones')}}"><i class="fa fa-edit"></i>Carreras Instituciones</a></li>
                        <li class="{{ $active_class_cur_inst }}"><a href="{{url('/curso_instituciones')}}"><i class="fa fa-edit"></i>Cursos Instituciones</a></li>
                        <li class="{{ $active_class_moda }}"><a href="{{url('/modalidad_estudio')}}"><i class="fa fa-edit"></i>Modalidad de Estudio</a></li>
                        <li class="{{ $active_class_facu_upci }}"><a href="{{url('/facultad_upci')}}"><i class="fa fa-edit"></i>Facultades Upci</a></li>
                        <li class="{{ $active_class_carr_upci }}"><a href="{{url('/carreras_upci')}}"><i class="fa fa-edit"></i>Carreras Upci</a></li>
                        <li class="{{ $active_class_plan_upci }}"><a href="{{url('/plan_estudios_upci')}}"><i class="fa fa-edit"></i>Plan de Estudio Upci</a></li>
                        <li class="{{ $active_class_cicl_upci }}"><a href="{{url('/ciclo_upci')}}"><i class="fa fa-edit"></i>Ciclo Upci</a></li>
                        <li class="{{ $active_class_cur_upci }}"><a href="{{url('/curso_carreras_upci')}}"><i class="fa fa-edit"></i>Cursos Upci</a></li>
                      </ul>
              </a>
            </li>
          </ul>