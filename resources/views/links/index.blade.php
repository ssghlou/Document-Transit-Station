@extends('layout.app')

@section('content')
<div class="container">
    <p>当前链接的数量：{{$links->total()}}</p>
    <a href="{{route('links.create')}}">
        <input type="button" value="创建新的链接" />
    </a>
    <table border="0" cellpadding="10">
        <tr>
            <th>链接ID</th>
            <th>提取码</th>
            <th>创建时间</th>
            <th>操作</th>
        </tr>
        @foreach ($links as $link)
            <tr>
                <td>{{$link->id}}</td>
                <td>{{$link->code}}</td>
                <td>{{$link->created_at->isoFormat('L')}}</td>
                <td>
                    <a href="#" data-url="{{route('links.destroy', $link)}}" class="del-link">删除</a>
                    <a href="{{route('links.get_link', $link)}}">跳转</a>
                </td>
            </tr>
        @endforeach
    </table>
</div>
{{$links->links()}}
@endsection

<script src="https://cdn.staticfile.org/jquery/1.10.2/jquery.min.js"></script>
<script>
    $(function(){
        $('.del-link').click(function(){
            var that = this;
            //发送ajax删除对应的数据
            $.ajax({
                url: $(this).data('url'),
                type: 'delete',
                // dataType: 'json',
                success: function(res){
                    location.reload()   //刷新页面
                }
            })
        })
    })
</script>