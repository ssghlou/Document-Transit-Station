@if(session('id'))
    <div class="alert alert-success">
        创建成功，链接ID为{{session('id')}}，提取码为{{session('code')}}
    </div>
@endif