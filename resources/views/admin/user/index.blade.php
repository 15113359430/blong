@extends('admin.layout.layout')
<link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
@section('content')
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

         <th width="240">留言时间</th>
        <th>操作</th>       
      </tr>     


      @foreach($users as $user)
        <tr>
          <td><input type="checkbox" name="id[]" value="" />
            {{$loop->iteration}}</td>
          <td>{{$user->username}}</td>

          <td>{{$user->created_at}}</td>
          <td><div class="button-group"> <a class="button border-red" href="javascript:void(0)" onclick="freezeUser({{$user->id}})">  {{$user->is_freeze?'冻结':'解冻'}} </a> </div></td>
        </tr>
      @endforeach

       
      <tr>
        <td colspan="8">{{$users->links()}}</td>
      </tr>
    </table>
  </div>
</form>
<script type="text/javascript">


function freezeUser(id){


  var _token = "{{csrf_token()}}";


  layer.confirm('你确定要操作此用户吗??',function(){
      $.ajax({
          type:'delete',
          url:'/admin/freeze/'+id,
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