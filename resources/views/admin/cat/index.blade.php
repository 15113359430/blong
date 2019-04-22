@extends('admin.layout.layout')
@section('content')
<body>
<div class="panel admin-panel">
  <div class="panel-head"><strong class="icon-reorder"> 内容列表</strong></div>
  <div class="padding border-bottom">  
  <a type="button" class="button border-yellow" href="{{url('admin/cat/create')}}"><span class="icon-plus-square-o"></span> 添加内容</a>
  </div>


@if(!empty($cats))

  <table class="table table-hover text-center">
    <tr>
      <th width="10%">ID</th>

      <th width="15%">分类名称</th>
       <th width="15%">分类描述</th>

      <th width="30%">操作</th>
    </tr>
   

   @foreach($cats as $cat)
    <tr>
      <td>{{$loop->iteration}}</td>     
      <td>{{$cat['cat_name']}}</td>
      <td>{{$cat['desc']}}</td>

      <td><div class="button-group">
      <a class="button border-main" href="{{url('admin/cat/'.$cat['id'].'/edit')}}"><span class="icon-edit"></span> 修改</a>
      <a class="button border-red" href="javascript:void(0)" onclick="delCat({{$cat['id']}})"><span class="icon-trash-o"></span> 删除</a>
      </div></td>
    </tr>
 @endforeach

 @else

 你好没有友情连接 请先去添加

 @endif


  </table>




</div>
<script type="text/javascript">


function delCat(id){

  var _token = "{{csrf_token()}}";


  layer.confirm('你确定要删除这个连接吗??',function(){
      $.ajax({
          type:'delete',
          url:'/admin/cat/'+id,
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