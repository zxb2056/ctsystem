
@section('head')
这里是头部
@show
@yield('title')
@section('css')
this is css
@show
</head>
<body>
    @section('topnav')
    这是顶端导航
    @show

    @section('sidebar')
    这是侧边栏
    @show
<div id="content">
    @section('content')
    这里是内容
    @show
</div>

    @section('footer')
    this is bottom
    @show
    
    @section('js')
    this js script 
    @show
   
</body>
</html>