<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-dark sidebar collapse">
    <div class="position-sticky pt-3 sidebar-sticky">
      <ul class="nav flex-column">

        @can('voter')
        <li class="nav-item"  style="background-color: {{ Request::is('dashboard/vote') ? '#9223ff' : '' }} ">
          <a class="nav-link text-light {{ Request::is('dashboard/vote') ? 'active' : '' }}" aria-current="page" href="/dashboard/vote">
            <i data-feather="user-check" ></i>
            Vote
          </a>
        </li>
        @endcan

        @can('admin')
        <li class="nav-item" style="background-color: {{ Request::is('dashboard/signup') ? '#9223ff' : '' }} ">
          <a class="nav-link text-light {{ Request::is('dashboard/signup*') ? 'active' : '' }}" href="/dashboard/signup">
            <i data-feather="user-plus" ></i>
            Buat Akun
          </a>
        </li>

        <li class="nav-item" style="background-color: {{ Request::is('dashboard/result') ? '#9223ff' : '' }} ">
          <a class="nav-link text-light {{ Request::is('dashboard/result*') ? 'active' : '' }}" href="/dashboard/result">
            <i data-feather="bar-chart-2" ></i>
            Hasil
          </a>
        </li>
        @endcan

        <li class="nav-items">
          <form action="/logout" method="POST">
            @csrf
            <button id="logOut" type="submit" class="nav-link border-0 text-light">
              <i data-feather="log-out" ></i> 
              Keluar
            </button>
          </form>
        </li>

      </ul>  
    </div>
</nav>