@extends('admin.layout.layout')
@section('content')
<body>

<div class="panel admin-panel margin-top" id="add">
  <div class="panel-head"><strong><span class="icon-pencil-square-o"></span> 增加内容</strong></div>
  <div class="body-content">
    <form method="post" id="form" class="form-x" action="{{url('admin/cat/'.$cat['id'])}}">    
      {{csrf_field()}}
      {{method_field('put')}}
      <div class="form-group">
        <div class="label">
          <label>分类名称：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" value="{{$cat['cat_name']}}" name="cat_name" datatype="s2-10" />
          <div class="tips"></div>
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label>分类描述L：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" name="desc"  datatype="s5-20" value="{{$cat['desc']}}"  />
          <div class="tips"></div>
        </div>
      </div>

      <div class="form-group">
        <div class="label">
          <label></label>
        </div>
        <div class="field">
          <button class="button bg-main icon-check-square-o" type="submit"> 修改</button>
        </div>
      </div>
    </form>
  </div>
</div>
</body>

<script type="text/javascript">
 

$('#form').Validform({
        tiptype:4,
        ajaxPost:true,
        callback:function(res){
            if(res.status=='success'){
               window.parent.location.href="{{url('admin/index')}}";
            }else{
                 layer.msg(res.msg,{icon:2});
            }
        }

});


</script>>

@endsection