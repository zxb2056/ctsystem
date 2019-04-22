<nav class="navbar navbar-expand-md navbar-dark bg-info px-0  fixed-top">
    <div class="d-flex align-items-center">
      <a class=" ml-3" href="/dashboard.html">
        <span class="glyphicon glyphicon-home"></span>
        <i class="fa fa-home fa-2x " style="color:white"></i>
      </a>
      <a href="/dashboard.html">
        <span class="mx-2 h6 text-white">牧场管理系统</span>
      </a>
    </div>
    <button type="button" id="sidebarCollapse" class="btn btn-info border-left border-right">
      <i class="fa fa-align-left"></i>
      <small>显示/隐藏侧边栏</small>
    </button>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-collapse collapse in justify-content-end pr-4" id="navbarNavDropdown">
      <ul class="nav navbar-nav ">
        <li class="dropdown  mx-2  pr-2"><a href="#" class="dropdown-toggle text-white" data-toggle="dropdown">@guest请登录@endguest @auth {{Auth::user()->username}} @endauth</a>
          <ul class="dropdown-menu">
            <li><a href="{{url('/admin/login/logout')}}"><small>退出</small></a></li>
          </ul>
        </li>
        <li class=" mx-2 pr-2"><a href="#" class=" text-white ">使用说明</a>
        </li>

      </ul>
    </div>
  </nav>