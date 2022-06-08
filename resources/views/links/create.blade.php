@extends('layout.app')

@section('content')
<p>这是创建链接的页面</p>
<form method="POST"action="{{route("links.store")}}" id="form" enctype="multipart/form-data">
    @csrf
    @include('layout.error')
    <input type="file" name="file[]" id="file-uploader" multiple onchange="callback(this)"/>
    <button type="submit">上传</button>
</form>
<div id="result">
    <p>当前已经选择的文件：</p>
</div>

@endsection

<script src="https://cdn.staticfile.org/jquery/1.10.2/jquery.min.js"></script>
<script>
    callback = function(){
        var files = $('#file-uploader').prop('files');
        $('#result').html("<p>当前已经选择的文件：</p>");
        for(var i=0;i<files.length;i++) {
            $('#result').append(
                "<p>" + files[i].name + "</p>"
            );
        };
    }
</script>