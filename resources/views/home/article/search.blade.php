@extends('home.layout.layout')
@section('content')
<article>
  @include('home.layout.aside')
  <main class="r_box">
    <style type="text/css">
 .page-item{
  display: inline-block;
 }
</style>
@if(!empty($articles))
@foreach($articles as $article)
   <li><i><a href="{{url('article/detail/'.$article['id'])}}"><img src="/{{$article['img_url']}}"></a></i>
      <h3><a href="{{url('article/detail/'.$article['id'])}}">{{$article['title']}}</a></h3>
      <p>{{$article['desc']}}</p>
    </li>

@endforeach
@else

没有你要搜索的关键词
@endif


  </main>
</article>
@endsection