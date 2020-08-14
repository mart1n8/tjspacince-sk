@extends('layouts.app')
@section('title', !empty($tag) ? 'članky: '.$tag : 'članky')
@section('content')
<h1>Články<?= !empty($tag) ? ': '.$tag : '' ?></h1>
@foreach($articles as $article)
    <div style="float: right">
      <div class="fb-share-button" 
        data-href="{{ route('article.show', ['article_slug'=>$article->slug]) }}" 
        data-layout="button_count">
      </div>
    </div>
        @include('article._article', ['article'=>$article])
    <hr/>
@endforeach
@if($articles->count()==0)
    <span style="font-weight:bold; color:blue; font-size: 1.2em">Nenašli sa žiadne články<?= !empty($tag) ? ' s tagom '.$tag : '' ?>.</span>
@endif
<div class="center-block"><?= $articles->links() ?></div>
@endsection