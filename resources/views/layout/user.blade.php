{{-- 用于用户中心的左侧导航 --}}
<a href="{{route('user.home')}}">
    <input type="button" value="用户首页" />
</a>
<a href="{{route('user.setting.info')}}">
    <input type="button" value="修改信息" />
</a>
<a href="{{route('user.setting.password')}}">
    <input type="button" value="修改密码" />
</a>