<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
    <li class="nav-header">Main</li>

    <li class="nav-item">
      <a href="{{ url('/') }}" class="nav-link {{ set_active(Request::is('/')) }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Beranda</p>
      </a>
    </li>
    <li class="nav-header">CONTENT</li>
    <li class="nav-item">
      <a href="#" class="nav-link">
        <i class="fas fa-circle nav-icon"></i>
        <p>Level 1</p>
      </a>
    </li>
    <li class="nav-item {{ set_active([Request::is('markers*'), Request::is('kategori*')], 'menu-open') }}">
      <a href="#" class="nav-link {{ set_active([Request::is('markers*'), Request::is('kategori*')], 'active') }}">
        <i class="nav-icon fas fa-circle"></i>
        <p>
          Peta
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="/markers" class="nav-link {{ set_active(Request::is('markers*')) }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Markers</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="/kategori" class="nav-link {{ set_active(Request::is('kategori*')) }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Kategori</p>
          </a>
        </li>
      </ul>
    </li>
    <li class="nav-header">LABELS</li>
    <li class="nav-item">
      <a href="#" class="nav-link">
        <i class="nav-icon far fa-circle text-danger"></i>
        <p class="text">Important</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="#" class="nav-link">
        <i class="nav-icon far fa-circle text-warning"></i>
        <p>Warning</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="#" class="nav-link">
        <i class="nav-icon far fa-circle text-info"></i>
        <p>Informational</p>
      </a>
    </li>
  </ul>
</nav>