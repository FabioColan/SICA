      <!-- Inicio Header -->
      <header class="main-header">
        <!-- Logo -->
        <a href="#" class="logo"><img class="img-responsive" src="{{ url('img/logo_upci.png') }}"></a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Navegación</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
             
                          
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="{{ url('/img/foto_usuario.jpg') }}" class="user-image" alt="User Image"/>
                  <span class="hidden-xs">Hola, {{ Auth::user()->name }}</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="{{ url('/img/foto_usuario.jpg') }}" class="img-circle" alt="User Image" />
                    <p>
                      {{ Auth::user()->email }}
                      <small>Registrado desde {{ Auth::user()->created_at }}</small>
                    </p>
                  </li>
                  
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    
                    <div class="pull-right">
                      <a href="{{ url('/auth/logout') }}" class="btn btn-default btn-flat">Cerrar Sesión</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Fin Header -->