@extends('admin.layout.layout')
@section('content')
<body>

<div class="panel admin-panel margin-top" id="add">
  <div class="panel-head"><strong><span class="icon-pencil-square-o"></span> 增加内容</strong></div>
  <div class="body-content">
    <form method="post" id="form" class="form-x" action="{{url('admin/image')}}">    
      {{csrf_field()}}
      <div class="form-group">
        <div class="label">
          <label>标题：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" value="" name="title" datatype="s6-100" />
          <div class="tips"></div>
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label>URL：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" name="url"  datatype="url" value=""  />
          <div class="tips"></div>
        </div>
      </div>




      <div class="form-group">
        <div class="label">
          <label>图片：</label>
        </div>
        <div class="field">


         
            <div id="uploader-demo">
          <!--用来存放item-->
              <div id="fileList" class="uploader-list"></div>
              <div id="filePicker">选择图片</div>
              
          </div>


        </div>
      </div>



      <div class="form-group">
        <div class="label">
          <label>描述：</label>
        </div>
        <div class="field">
          <textarea type="text" class="input" name="desc" datatype="s6-100" style="height:120px;" value=""></textarea>
          <div class="tips"></div>
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label>排序：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" name="sort" value="0"  datatype="n" />
          <div class="tips"></div>
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label></label>
        </div>
        <div class="field">
          <button class="button bg-main icon-check-square-o" type="submit"> 提交</button>
        </div>
      </div>
    </form>
  </div>
</div>
</body>

<script type="text/javascript">
  // 初始化Web Uploader
var uploader = WebUploader.create({

    // 选完文件后，是否自动上传。
    auto: true,

    // swf文件路径
    swf: "{{ asset('lib/webuploader-0.1.5/Uploader.swf')}}",

    // 文件接收服务端。
    server: "{{url('admin/upload')}}",

    // 选择文件的按钮。可选。
    // 内部根据当前运行是创建，可能是input元素，也可能是flash.
    pick: '#filePicker',

    fileSingleSizeLimit: 1024*1024,

    // 只允许选择图片文件。
    accept: {
        title: 'Images',
        extensions: 'gif,jpg,jpeg,bmp,png',
        mimeTypes: 'image/*'
    }
});

uploader.on( 'uploadSuccess', function( file,res ) {
    $('#uploader-demo').append('<img  style="position: absolute;margin-left:400px;margin-top:-100px;width: 200px;height: 100px" src=/'+ res.url +'>');

    $('#uploader-demo').append('<input type="hidden" name="img_url" value='+ res.url +'>');
});

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