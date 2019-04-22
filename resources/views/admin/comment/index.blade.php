@extends('admin.layout.layout')
@section('content')
<link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
<body>
<form method="post" action="">
  <div class="panel admin-panel">
    <div class="panel-head"><strong class="icon-reorder"> 留言管理</strong></div>
    <div class="padding border-bottom">
      <ul class="search">
        <li>
          <button type="button"  class="button border-green" id="checkall"><span class="icon-check"></span> 全选</button>
          <button type="submit" class="button border-red"><span class="icon-trash-o"></span> 批量删除</button>
        </li>
      </ul>
    </div>
    <table class="table table-hover text-center">
      <tr>
        <th width="120">ID</th>
        <th>姓名</th>       

        <th>文章标题</th>

        <th width="25%">内容</th>
         <th width="240">留言时间</th>
        <th>操作</th>       
      </tr>   

      @foreach($comments as $comment)
        <tr>
          <td><input type="checkbox" name="id[]" value="1" />
            {{$loop->iteration}}</td>
          <td>{{$comment->username}}</td>

          <td>{{$comment->title}}</td>  
        
          <td>{{$comment->content}}</td>
          <td>{{date('Y-m-d H:i:s',$comment->created_at)}}</td>
          <td><div class="button-group"> <a class="button border-red" href="javascript:void(0)" onclick="delCom({{$comment->id}})">删除</a> </div></td>
        </tr>
        @endforeach

       
      <tr>
        <td colspan="8">{{$comments->links()}}</td>
      </tr>
    </table>
  </div>
</form>
<script type="text/javascript">
function delCom(id){


  var _token = "{{csrf_token()}}";


  layer.confirm('你确定要删除此评论??',function(){
      $.ajax({
          type:'delete',
          url:'/admin/delCom/'+id,
          datatype:'json',
          data:{_token:_token},
          success:function(res){
            if(res.status=='success'){
               window.parent.location.href="{{url('admin/index')}}";
            }else{
                 layer.msg(res.msg,{icon:2});
            }
          }


      })


  })
}

</script>
</body>
@endsection