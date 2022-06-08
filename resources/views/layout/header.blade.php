<header>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <a href="{{route('index')}}">文件中转站</a>
    @auth
        <a href="{{route('user.home')}}">{{auth()->user()->name}}</a>

        <form method="POST" action="{{route('logout')}}" id="logout">
            @csrf
            <a href="javascript:void(0)" onclick="document.getElementById('logout').submit()">退出</a>
        </form>
    @else
    <a href="{{route('login')}}">
        <input type="button" value="登录" />
    </a>
    <a href="{{route('register')}}">
        <input type="button" value="注册" />
    </a>
    @endauth
</header>