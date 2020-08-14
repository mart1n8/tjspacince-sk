@extends('layouts.app')
@section('title', 'Reklama - kampane')

@section('content')
<a class="btn btn-sm btn-secondary mb-2" href="{{ route('admin.reklama.kampane') }}"><<< kampane</a>
<h3>Upraviť kampaň: {{ $campaign->name }}</h3>
<form action="{{ route('admin.reklama.kampane.edit', ['campaign'=>$campaign->id]) }}" method="POST">
  @csrf
  @method('PATCH')
  @include('ads._form_campaign')
</form>
@endsection
