<!DOCTYPE html>
<html lang="zh-CN">
<html>
    <head>
        @section('head')
        这里是头部信息
        @show
    </head>
    <body>
<header class="bg-light py-1 mb-2">

        @section('header')
            这里是顶部导航
        @show
</header>

        <section>
            @yield('content')
</section>
<!-- 以下footer部分 -->
@yield('footer')
<script data-main="/js/main.js" src="/js/require.js"></script>
@section('js')
this is extra js
@show
</body>
</html>