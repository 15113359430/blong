@extends('home.layout.layout')
@section('content')
<article>
  @include('home.layout.aside')
  <main>
    <div class="infosbox">
      <div class="newsview">
        <h3 class="news_title">{{$article['title']}}</h3>
        <div class="bloginfo">
          <ul>
            <li class="author">作者：<a href="/">{{$article['author']}}</a></li>
           
            <li class="timer">时间：{{date('Y-m-d H:i:s',$article['created_at'])}}</li>
            <li class="view">{{$article['views']}}人已阅读</li>
          </ul>
        </div>

        <div class="news_about"><strong>简介</strong>
		
{{$article['desc']}}
		</div>
        <div class="news_con"> 
		

		{!!$article['content']!!}
		
      </div>
      <div class="share">
        <p class="diggit"><a href="javascript:;"> 很赞哦！ </a>(<b id="diggnum">{{$article['likes']}}</b>)</p>
      </div>
      <div class="nextinfo">
        @if($preArt)
        <p>上一篇：<a href="{{url('article/detail/'.$preArt->id)}}">{{$preArt->title}}</a></p>
        @endif
        @if($nextArt)
        <p>下一篇：<a href="{{url('article/detail/'.$nextArt->id)}}">{{$nextArt->title}}</a></p>
        @endif
      </div>
      <div class="news_pl">
        <h2>文章评论</h2>
        <div class="gbko"> 
        


          @if(!empty($comments))
            @foreach($comments as $comment)
            <div class="fb">
              <ul>
                <p class="fbtime"><span>{{date('Y-m-d',$comment->created_at)}}</span>{{$comment->username}}</p>
                <p class="fbinfo">{{$comment->content}}</p>
              </ul>
            </div>
            @endforeach
          @endif


 
          
          
         
          <form action="{{url('article/comment')}}" id="form" method="post" >
            {{csrf_field()}}
            <div id="plpost">
              <input type="hidden" name="art_id" value="{{$article['id']}}" />
              <p class="saying"><span><a href="javascript:;">共有{{$num}}条评论</a></span>来说两句吧...</p>

              <p class="yzm"><span>验证码:</span>
                <input name="code" type="text"  datatype="s4-4" class="inputText" size="16">
                <br><br>
                <img src="{{captcha_src()}}" alt=""  class="passcode" style="height:43px;width:200px;cursor:pointer;" onclick="this.src=this.src+'?'">  
              </p>
            
              <textarea name="content" rows="6" datatype="s2-100"  id="saytext"></textarea>
              <input type="submit" value="提交">

            </div>
          </form>
        </div>
      </div>
    </div>
  </main>
</article>
<script type="text/javascript">
  $('.diggit').click(function(){

    $.get("{{url('article/diggit/'.$article['id'])}}",null,function(res){
        if(res.status=='nologin'){
          layer.confirm(res.msg,function(){
            location.href="{{url('login')}}"
          });
        }

        if(res.status=='fail'){
           layer.alert(res.msg);
        }

        if(res.status=='success'){
            layer.alert(res.msg);
            $('#diggnum').text(res.num);
        }

    },'json')

  });


   $('#form').Validform({
        tiptype:4,
        ajaxPost:true,
        callback:function(res){
            if(res.status=='nologin'){
               window.parent.location.href="{{url('login')}}";
            }


            if(res.status=='fail'){
                 layer.msg(res.msg,{icon:2});
            }

            if(res.status=='success'){
               location.href="{{url('article/detail/'.$article['id'])}}";
            }
        }

});

</script>>

@endsection