@extends('admin.layout.layout')

@section('center')
<body>
<div class="panel admin-panel">
  <div class="panel-head"><strong><span class="icon-pencil-square-o"></span> 网站信息</strong></div>
  <div class="body-content">
    <form method="post" class="form-x" action="javascript:;">
      <div class="form-group">
        <div class="label">
          <label>网站标题：</label>
        </div>
        <div class="field">
          <input type="text" class="input" disabled name="stitle" value="{{$res->stitle}}" />
          <div class="tips"></div>
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label>网站关键字：</label>
        </div>
        <div class="field">
          <textarea class="input" name="skeywords" disabled style="height:80px">{{$res->stitle}}</textarea>
          <div class="tips"></div>
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label>网站描述：</label>
        </div>
        <div class="field">
          <textarea class="input" disabled name="sdescription">{{$res->stitle}}</textarea>
          <div class="tips"></div>
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label>作者描述：</label>
        </div>
        <div class="field">
          <textarea class="input" disabled name="author_description">{{$res->stitle}}</textarea>
          <div class="tips"></div>
        </div>
      </div>
    
      <div class="form-group">
        <div class="label">
          <label>底部信息：</label>
        </div>
        <div class="field">
          <textarea name="scopyright" disabled class="input" style="height:120px;">{{$res->stitle}}</textarea>
          <div class="tips"></div>
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label></label>
        </div>
        <div class="field">
          <a class="button bg-main icon-check-square-o" href="{{url('admin/system/edit')}}"> 修改</a>
        </div>
      </div>
    </form>
  </div>
</div>
</body>
@endsection