<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
      <img src="{{asset('dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">{{__('mycustom.adminpanel')}}</span>
      <br>
    
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      
      

      

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          
              
          
         
         @can('users')
         

        
         

         

         <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="fas fa-user"></i>
              <p>
              {{__('mycustom.users')}} 
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            
            <ul class="nav nav-treeview">
            @can('add-user')
              <li class="nav-item">
                <a href="{{route('users.create')}}" class="nav-link">
                  <i class="far fa-circle fa-r"></i>
                  <p>{{__('mycustom.addnewuser')}}</p>
                </a>
              </li>
              @endcan
              @can('all-users')
              <li class="nav-item">
                <a href="{{route('users.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{__('mycustom.allusers')}}</p>
                </a>
              </li>
              @endcan
            </ul>
          </li>
         @endcan
         @can('roles')
         <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="fa-solid fa-circle-minus"></i>
              <p>
              {{__('mycustom.roles')}}
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            @can('add-role')
              <li class="nav-item">
                <a href="{{route('roles.create')}}" class="nav-link">
                  <i class="far fa-circle fa-r"></i>
                  <p>{{__('mycustom.addnewrole')}}</p>
                </a>
              </li>
              @endcan
              @can('all-roles')
              <li class="nav-item">
                <a href="{{route('roles.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{__('mycustom.allroles')}}</p>
                </a>
              </li>
              @endcan
              
              
            </ul>
          </li>
         @endcan
         
         
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>