@extends('layouts.app')
@section('title', 'Reklamy: '.$ad->title)

@section('content')
<h3>Upraviť reklamu:</h3>
<form action="{{ route('admin.reklama.edit', ['ad'=>$ad->id]) }}" method="POST" enctype="multipart/form-data">
  @csrf
  @method('PATCH')
  @include('ads._form_ad')
</form>
@endsection
