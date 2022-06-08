@extends('layout.app')

@section('content')

<form method="POST" action="{{route("links.post_link",$id)}}" id="form">
    @csrf
    @include('layout.error')
    <input type="text" name="code" id="code_post"/>
    <button type="submit">提取</button>
</form>

@if (session('id'))
    <table border="0" cellpadding="10">
        <tr>
            <th>文件名</th>
            <th>操作</th>
        </tr>
        
        @foreach (session('origin_name_list') as $file => $origin_file)
            <tr>
                <td>{{$origin_file}}</td>
                <td>
                    <form action="{{route('links.download', ['link_id' => $id, 'file' => explode('/', $file)[1]])}}" method="POST">
                        @csrf
                        <input type="submit" value="下载">
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endif

@endsection
