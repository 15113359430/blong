@extends('home.layout.layout')
@section('content')
<style type="text/css">
 .page-item{
  display: inline-block;
 }
</style>

<article>
  @include('home.layout.aside')
  

  
  <main class="r_box">
	 
	 @if(!empty($images))
	 <div id="slidr-img" style="display: inline-block">
    @foreach($images as $image)
      <img data-slidr="{{$loop->iteration}}" onclick='location.href="{{$image['url']}}"' src="{{$image['img_url']}}"/>
    @endforeach
	</div>
	 @endif


   @foreach($articles as $article)
	 <li><i><a href="{{url('article/detail/'.$article['id'])}}"><img src="{{$article['img_url']}}"></a></i>
      <h3><a href="{{url('article/detail/'.$article['id'])}}">{{$article['title']}}</a></h3>
      <p>{{$article['desc']}}</p>
    </li>
    @endforeach


  

  </main>

<div style="margin-left:59%">{{$articles->links()}}</div>

</article>

  

@endsection