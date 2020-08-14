@extends('layouts.app')
@section('title', 'Reklamy: '.$campaign->title)

@section('content')
<h1>Reklamy {{ $campaign->title }}:</h1>
<table class="table">
  <thead class="thead-dark">
      <tr>
          <th style="width:35%">title: </th>
          <th style="width:10%">size: </th>
          <th style="width:10%">views: </th>
          <th style="width:10%">clicks: </th>
          <th style="width:35%">options: </th>
      </tr>
  </thead>
  @foreach($campaign->ads as $adItem)
    <tr>
      <td><a href="{{ $adItem->url  }}" alt="{{ $adItem->url  }}" title="{{ $adItem->url  }}">{{ $adItem->title }}</a></td>
      <td>{{ $adItem->banner_size }}</td>
      <td>{{ $adItem->views }}({{ $adItem->views_unq }})</td>
      <td>{{ $adItem->clicks }}({{ $adItem->clicks_unq }})</td>
      <td>
          <a href="{{ route('admin.reklama.edit', ['ad'=>$adItem->id]) }}" class="btn btn-sm btn-info mr-2">upraviť</a>
          <form action="{{ route('admin.reklama.edit', ['ad'=>$adItem->id])}}" method="POST" class="d-inline">
              @csrf
              @method('delete')
              <button class="btn btn-sm btn-danger" onclick="if (! confirm('Are you sure?')) { return false; }">vymazať</button>
          </form>
      </td>
    </tr>
  @endforeach
</table>
@if($campaign->ads->count()==0)
  <span class="text-danger font-weight-bold">Zatiaľ neboli pridané žiadne kampane.</span>
@endif
<hr>
<h3>Vytvoriť reklamu:</h3>
<form action="{{ route('admin.reklama', ['campaign'=>$campaign->id]) }}" method="POST" enctype="multipart/form-data">
  @csrf
  @include('ads._form_ad')
</form>
@endsection
