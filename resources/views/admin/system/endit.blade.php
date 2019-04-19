@extends('admin.layout.layout')

@section('center')
<body>
<div class="panel admin-panel">
  <div class="panel-head"><strong><span class="icon-pencil-square-o"></span> 网站信息</strong></div>
  <div class="body-content">
   <form method="post" class="form-x" action="javascript:;">
    <input type="hidden"  name="id" value="{{$res->id}}" />
      <div class="form-group">
        <div class="label">
          <label>网站标题：</label>
        </div>
        <div class="field">
          <input type="text" class="input" name="stitle" value="{{$res->stitle}}" />
          <div class="tips"></div>
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label>网站关键字：</label>
        </div>
        <div class="field">
          <textarea class="input" name="skeywords" style="height:80px">{{$res->skeywords}}</textarea>
          <div class="tips"></div>
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label>网站描述：</label>
        </div>
        <div class="field">
          <textarea class="input" name="sdescription">{{$res->sdescription}}</textarea>
          <div class="tips"></div>
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label>作者描述：</label>
        </div>
        <div class="field">
          <textarea class="input" name="author_description">{{$res->author_description}}</textarea>
          <div class="tips"></div>
        </div>
      </div>
    
      <div class="form-group">
        <div class="label">
          <label>底部信息：</label>
        </div>
        <div class="field">
          <textarea name="scopyright" class="input" style="height:120px;">{{$res->scopyright}}</textarea>
          <div class="tips"></div>
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label></label>
        </div>
        <div class="field">
          <button id="tijiao" class="button bg-main icon-check-square-o" > 提交</button>
        </div>
      </div>
    </form>
  </div>
</div>
<script>
$('#tijiao').click(function(){
  var id=$('input[name="id"]').val();
  var stitle=$('input[name="stitle"]').val();
  var skeywords=$('textarea[name="skeywords"]').val();
  var sdescription=$('textarea[name="sdescription"]').val();
  var author_description=$('textarea[name="author_description"]').val();
  var scopyright=$('textarea[name="scopyright"]').val();
  var _token = "{{csrf_token()}}";
  
  $.post("{{url('admin/system/update')}}",{id,stitle,skeywords,sdescription,author_description,scopyright,_token},function(res){
       if(res.status == 'success'){ 
           window.parent.location.href="{{url('/admin/index')}}";
        }else{
            layer.msg(res.msg,{icon:2});
        }
  })
})

</script>
</body>
@endsection