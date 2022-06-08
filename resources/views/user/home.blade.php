@extends('layout.app')

@section('content')
<br>
@include('layout.user')

<p>这是用户中心首页</p>
<p>你好，{{auth()->user()->name}}</p>
<p>已使用链接数量：{{$num}}</p>

<a href="{{route('links.index')}}">
    <input type="button" value="管理我的链接" />
</a>    

@endsection