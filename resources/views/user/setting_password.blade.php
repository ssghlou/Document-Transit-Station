@extends('layout.app')

@section('content')
<br>
@include('layout.user')
<p>这是修改密码的页面</p>
<form method="POST" action="{{ route('user.setting.password') }}">
    @csrf
    @include('layout.error')
    @include('layout.success')
    原密码: <input type="password" name="old_password"><br>
    新密码: <input type="password" name="password"><br>
    确认密码: <input type="password" name="password_confirmation"><br>
    <input type="submit" value="提交修改">
</form>
@endsection
