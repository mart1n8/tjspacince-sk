@extends('layouts.app')
@section('title', $article->title)
@section('content')

<div style="float: right">
  <div class="fb-share-button" 
    data-href="{{ route('article.show', ['article_slug'=>$article->slug]) }}" 
    data-layout="button_count">
  </div>
</div>
<article>
<h1>{{ $article->title }}</h1>
    {!! $article->text !!}
    <br clear="all">
    <p style="text-align: right; margin: 20px 10px 0px 0px; font-style: italic">
        <span>vložil: {{ $article->user()->name }}</span>
        <span> | </span>
        <span>publikované: {{ date("d.m.Y", strtotime($article->pubDate())) }}</span>
    </p>
</article>
<hr/>
<h2>Komentáre: </h2>
<div class="fb-comments" data-href="{{ route('article.show', ['article_slug'=>$article->slug]) }}" data-width="650" data-order-by="time" data-numposts="5"></div>
@if(Auth::check() && Auth::user()->roles>1)
    <hr/>
    <div style="float: right;">
       <a href="{{ route('article.edit', ['article_id'=>$article->id]) }}" ><button class="btn btn-sm btn-secondary"> upraviť </button></a>
    </div>
@endif
@endsection
