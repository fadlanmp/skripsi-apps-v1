<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
      <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page" href="/dashboard">
            <span data-feather="home"></span>
            Dashboard
          </a>
        </li>
        @canany(['ustad', 'santri'])
            
        <li class="nav-item">
          <a class="nav-link {{ Request::is('dashboard/profil') ? 'active' : '' }}" aria-current="page" href="/dashboard/profil">
            <span data-feather="user"></span>
            Profil
          </a>
        </li>
        @endcanany
        {{-- <li class="nav-item">
          <a class="nav-link {{ Request::is('dashboard/users/create') ? 'active' : '' }}" href="/dashboard/users/create">
            <span data-feather="user-plus"></span>
            Tambah User
          </a>
        </li> --}}
        <li class="nav-item">
          <a class="nav-link {{ Request::is('dashboard/ustad') ? 'active' : '' }}" href="/dashboard/ustads">
            <span data-feather="users"></span>
            Daftar Ustad
          </a>
        </li>
        @canany(['admin', 'ustad'])
        <li class="nav-item">
          <a class="nav-link {{ Request::is('dashboard/santri') ? 'active' : '' }}" href="/dashboard/santris">
            <span data-feather="users"></span>
            Daftar Santri
          </a>
        </li>
        @endcanany
        <li class="nav-item">
          <a class="nav-link {{ Request::is('dashboard/nilais') ? 'active' : '' }}" href="/dashboard/nilais">
            <span data-feather="bar-chart-2"></span>
            Daftar Nilai
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('dashboard/kitabs') ? 'active' : '' }}" href="/dashboard/kitabs">
            <span data-feather="book"></span>
            Daftar Kitab
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('dashboard/posts*') ? 'active' : '' }}" href="/dashboard/posts">
            <span data-feather="file-text"></span>
            Blog
          </a>
        </li>
      </ul>
    </div>
  </nav>