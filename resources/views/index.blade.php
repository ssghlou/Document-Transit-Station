@extends('layout.app')

@section('content')
<a href="{{route('links.create')}}">
    <input type="button" value="创建新的链接" />
</a>
<br><br>
<a href="{{route('links.index')}}">
    <input type="button" value="管理我的链接" />
</a>
@endsection