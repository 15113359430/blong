@extends('admin.layout.layout')
@section('content')
<body>
<div class="panel admin-panel">
  <div class="panel-head"><strong><span class="icon-pencil-square-o"></span> 网站信息</strong></div>
  <div class="body-content">
    <form method="post" class="form-x" action="javascript:;">

       <input type="hidden" class="input" id="id" name="id"   value="{{$sys['id']}}" />
      <div class="form-group">
        <div class="label">
          <label>网站标题：</label>
        </div>
        <div class="field">
          <input type="text" class="input" id="title" name="title"   value="{{$sys['title']}}" />
          <div class="tips"></div>
        </div>
      </div>

      <div class="form-group">
        <div class="label">
          <label>网站关键字：</label>
        </div>
        <div class="field">
          <textarea class="input"  name="keywords" id="keywords" style="height:80px">{{$sys['keywords']}}</textarea>
          <div class="tips"></div>
        </div>
      </div>



      <div class="form-group">
        <div class="label">
          <label>网站描述：</label>
        </div>
        <div class="field">
          <textarea class="input" id="desc" name="desc">{{$sys['desc']}}</textarea>
          <div class="tips"></div>
        </div>
      </div>

      <div class="form-group">
        <div class="label">
          <label>作者：</label>
        </div>
        <div class="field">
          <textarea class="input" id="author"  name="author">{{$sys['author']}}</textarea>
          <div class="tips"></div>
        </div>
      </div>
     
              
      <div class="form-group">
        <div class="label">
          <label>底部信息：</label>
        </div>
        <div class="field">
          <textarea name="footer" id="footer"  class="input" style="height:120px;">{{$sys['footer']}}</textarea>
          <div class="tips"></div>
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label></label>
        </div>
        <div class="field">
          <button id="sub" class="button bg-main icon-check-square-o" type="submit"> 保存</button>
        </div>
      </div>
    </form>
  </div>
</div>
</body>

<script>

$('#sub').click(function(){

  var title = $('#title').val();

  var keywords= $('#keywords').val();

  var desc = $('#desc').val();

  var author = $('#author').val();

  var footer = $('#footer').val();

  var id = $('#id').val();


  var _token = "{{csrf_token()}}";

  $.post("{{url('admin/system/update')}}",{title:title,keywords:keywords,desc:desc,author:author,footer:footer,_token:_token,id:id},function(res){

    if(res.status=='success'){

        window.parent.location.href="{{url('admin/index')}}";
    }else{
        layer.msg(res.msg,{icon:2});
    }


  });

})


</script>

@endsection