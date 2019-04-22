@extends('admin.layout.layout')
@section('content')
<body>
<div class="panel admin-panel">
  <div class="panel-head"><strong class="icon-reorder"> 内容列表</strong></div>
  <div class="padding border-bottom">  
  <a type="button" class="button border-yellow" href="{{url('admin/link/create')}}"><span class="icon-plus-square-o"></span> 添加内容</a>
  </div>


@if(!empty($links))

  <table class="table table-hover text-center">
    <tr>
      <th width="10%">ID</th>

      <th width="15%">名称</th>
       <th width="15%">url</th>

      <th width="10%">排序</th>
      <th width="30%">操作</th>
    </tr>
   

   @foreach($links as $link)
    <tr>
      <td>{{$loop->iteration}}</td>     
      <td>{{$link['title']}}</td>
      <td>{{$link['url']}}</td>
      <td>{{$link['sort']}}</td>
      <td><div class="button-group">
      <a class="button border-main" href="{{url('admin/link/'.$link['id'].'/edit')}}"><span class="icon-edit"></span> 修改</a>
      <a class="button border-red" href="javascript:void(0)" onclick="delImage({{$link['id']}})"><span class="icon-trash-o"></span> 删除</a>
      </div></td>
    </tr>
 @endforeach

 @else

 你好没有友情连接 请先去添加

 @endif


  </table>




</div>
<script type="text/javascript">


function delImage(id){

  var _token = "{{csrf_token()}}";


  layer.confirm('你确定要删除这个连接吗??',function(){
      $.ajax({
          type:'delete',
          url:'/admin/link/'+id,
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