@extends('layout.app')

@section('content')
<br>
@include('layout.user')
<p>这是修改用户名的页面</p>
<form method="POST" action="{{ route('user.setting.info') }}">
    @csrf
    @include('layout.error')
    @include('layout.success')
    名字: <input type="text" name="new_name" value="{{auth()->user()->name}}"><br>
    邮箱: <input type="email" name="new_email" value="{{auth()->user()->email}}"><br>
    <input type="submit" value="提交修改">
</form>
@endsection