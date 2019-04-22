@extends('admin.layout.layout')
@section('content')
<body>
<div class="panel admin-panel">
  <div class="panel-head" id="add"><strong><span class="icon-pencil-square-o"></span>增加内容</strong></div>
  <div class="body-content">
    <form method="post" id="form" class="form-x" action="{{url('admin/article')}}">  
      {{csrf_field()}}
      <div class="form-group">
        <div class="label">
          <label>文章标题：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" datatype="s5-30" value="" name="title"  />
          <div class="tips"></div>
        </div>
      </div>
         <div class="clear"></div>
      <div class="form-group">
        <div class="label">
          <label>关键字标题：</label>
        </div>
        <div class="field">
          <input type="text" class="input  w50" datatype="s2-10"  name="keywords" value="" />
        </div>
      </div>



      <div class="form-group">
        <div class="label">
          <label>作者：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" name="author" datatype="s2-10" value=""  />
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

        <div class="tipss">图片尺寸：500*500</div>
        </div>
      </div>





        <div class="form-group">
          <div class="label">
            <label>分类标题：</label>
          </div>
          <div class="field">
            <select name="cat_id" class="input w50">
              <option value="">请选择分类</option>
              @foreach($cats as $cat)
              <option value="{{$cat['id']}}">{{$cat['cat_name']}}</option>
              @endforeach
            </select>
            <div class="tips"></div>
          </div>
        </div>






      <div class="form-group">
        <div class="label">
          <label>描述：</label>
        </div>
        <div class="field">
          <textarea class="input" name="desc" datatype="s10-200" style=" height:90px;"></textarea>
          <div class="tips"></div>
        </div>
      </div>


      <div class="form-group" style="display: none">
        <div class="label">
          <label>内容：</label>
        </div>
        <div class="field">
          <textarea name="content" id="text" class="input" style="height:450px; border:1px solid #ddd;"></textarea>
          <div class="tips"></div>
        </div>
      </div>

<div class="form-group">
      <div class="label">
          <label>内容：</label>
        </div>
</div>
       <div style="margin-left: 145px;width: 85%" id="editor">
        <p></p>
     </div>



     <br><br>


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
    $('#uploader-demo').append('<img  style="position: absolute;margin-left:400px;margin-top:-50px;width: 200px;height: 100px" src=/'+ res.url +'>');

    $('#uploader-demo').append('<input type="hidden" name="img_url" value='+ res.url +'>');
});


var E = window.wangEditor
var editor = new E('#editor')
   
   editor.customConfig.uploadImgServer = "{{url('admin/article/upload')}}";
   editor.customConfig.uploadFileName = 'file';
   editor.customConfig.onchange = function (html) {
            // 监控变化，同步更新到 textarea
            $('#text').val(html)
    }

editor.create()

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