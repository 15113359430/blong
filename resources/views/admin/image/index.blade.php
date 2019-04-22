@extends('admin.layout.layout')
@section('content')
<body>
<div class="panel admin-panel">
  <div class="panel-head"><strong class="icon-reorder"> 内容列表</strong></div>
  <div class="padding border-bottom">  
  <a type="button" class="button border-yellow" href="{{url('admin/image/create')}}"><span class="icon-plus-square-o"></span> 添加内容</a>
  </div>


@if(!empty($images))

  <table class="table table-hover text-center">
    <tr>
      <th width="10%">ID</th>
      <th width="20%">图片</th>
      <th width="15%">名称</th>
       <th width="15%">url</th>
      <th width="20%">描述</th>
      <th width="10%">排序</th>
      <th width="30%">操作</th>
    </tr>
   

   @foreach($images as $image)
    <tr>
      <td>{{$loop->iteration}}</td>     
      <td><img src="/{{$image['img_url']}}" alt="" width="120" height="50" /></td>     
      <td>{{$image['title']}}</td>
      <td>{{$image['url']}}</td>
      <td>{{$image['desc']}}</td>
      <td>{{$image['sort']}}</td>
      <td><div class="button-group">
      <a class="button border-main" href="{{url('admin/image/'.$image['id'].'/edit')}}"><span class="icon-edit"></span> 修改</a>
      <a class="button border-red" href="javascript:void(0)" onclick="delImage({{$image['id']}})"><span class="icon-trash-o"></span> 删除</a>
      </div></td>
    </tr>
 @endforeach

 @else

 你好没有幻灯片 请先去添加

 @endif


  </table>




</div>
<script type="text/javascript">


function delImage(id){

  var _token = "{{csrf_token()}}";


  layer.confirm('你确定要删除这个幻灯片吗??',function(){
      $.ajax({
          type:'delete',
          url:'/admin/image/'+id,
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