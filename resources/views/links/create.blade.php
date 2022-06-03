@extends('layout.app')

@section('content')
<p>这是创建链接的页面</p>
<form method="POST"action="{{route("links.store")}}" enctype="multipart/form-data">
    @csrf
    <input type="file" name="file[]" id="file-uploader" multiple />
    <button type="submit">上传</button>
</form>

@endsection