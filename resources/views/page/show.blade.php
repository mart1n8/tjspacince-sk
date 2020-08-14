@extends('layouts.app')
@section('title', $page->title)
@section('content')


<article>
    <h1>{{ $page->title }}</h1>
    <div style="text-align:justify">
        {!! $page->text !!}
    </div>   
</article>
@if(Auth::check() && Auth::user()->roles>1)
<hr/>
<div style="float: right;">
   <a href="{{ route('page.edit', ['page_id'=>$page->id]) }}" ><button class="btn btn-sm btn-secondary"> upraviť </button></a>
</div>
@endif

@endsection