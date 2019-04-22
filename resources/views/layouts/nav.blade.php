<div class="container px-0">
            <nav class="navbar navbar-expand-lg navbar-light px-0">
                <a class="navbar-brand" href="/index.html">
                    <h5>洛阳辰涛牧业科技有限公司</h5>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
                    aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <form class="form-inline ml-auto my-2 my-lg-0" >
                    @guest
                        <a href="{{asset('/login.html')}}" class="btn btn-outline-dark mr-3 btn-sm" >登录</a>
                        <a href="{{asset('/register.html')}}" class="btn btn-outline-dark btn-sm" >注册</a>
                    @endguest
                    @auth
                    <div class="dropdown">
                   <button class="btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" id="dropdownMenuButton">{{Auth::user()->name}} 您好</button> 
                   <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{url('/user/me/setting')}}">个人中心</a>
                    <a class="dropdown-item" href="{{url('/logout')}}">退出登录</a>
                    </div>
                    </div>
                    @endauth
                    </form>
                </div>

            </nav>
            <nav class="navbar navbar-expand-lg navbar-dark bg-secondary px-0">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown2"
                    aria-controls="navbarNavDropdown2" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse " id="navbarNavDropdown2">
                    <ul class="navbar-nav navbar-liebiao m-auto">
                        <li class="nav-item @yield('actIndex')">
                            <a class="nav-link" href="/">首页 </a>
                        </li>

                        <li class="nav-item @yield('actNews')">
                            <a class="nav-link" href="{{ asset('/news.html') }}">新闻中心</a>
                        </li>
                        <li class="nav-item @yield('actTech')">
                            <a class="nav-link" href="{{ asset('/tech.html') }}">专业技术</a>
                        </li>

                        <li class="nav-item @yield('actDjfp')">
                            <a class="nav-link" href="{{ asset('/djfp.html') }}">党建扶贫</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link @yield('actVideo')" href="{{ asset('/qyyx.html') }}">企业影像</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @yield('actHire')" href="{{ asset('/zhaopin.html') }}">人才招聘</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @yield('actAbout')" href="{{ asset('/about.html') }}">企业概况</a>
                        </li>
                    </ul>

                </div>

            </nav>

        </div>