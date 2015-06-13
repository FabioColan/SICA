  <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MENÚ POSTULANTE</li>
            
            <li class="{{ $active_principal }} treeview">
              <a href="{{url('/')}}">
                <i class="fa fa-dashboard"></i> <span>Principal</span> 
              </a>
            </li>
           
            <li class="{{ $active_solicitar }} treeview">
              <a href="#">
                <i class="fa fa-edit"></i> <span>Solicitar</span> 
                      <ul class="treeview-menu">
                        <li class="{{ $active_class_solicitar }}"><a href="{{url('/solicitar')}}"><i class="fa fa-check-square-o"></i>Convalidación</a></li>
                        
                      </ul>
              </a>
            </li>
            <li class="{{ $active_adjuntar }} treeview">
              <a href=" {{ url('/adjuntar') }}">
                <i class="fa fa-files-o"></i> <span>Adjuntar Documentos</span> 
              </a>
            </li>
             <li class="{{ $active_notificacion }} treeview">
              <a href="{{url('/notificacion')}}">
                <i class="fa fa-envelope"></i> <span>Notificaciones</span> 
              </a>
            </li>
            
          </ul>