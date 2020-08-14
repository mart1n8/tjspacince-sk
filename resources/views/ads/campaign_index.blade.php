@extends('layouts.app')
@section('title', 'Reklama - kampane')

@section('content')
<h1>Reklamné kampane:</h1>
<table class="table">
  <thead class="thead-dark">
      <tr>
          <th>názov: </th>
          <th>spoločnosť: </th>
          <th>body: </th>
          <th>možnosti: </th>
      </tr>
  </thead>
  @foreach($adCampaigns as $adCampaignL)
    <tr>
      <td>{{ $adCampaignL->name }}</td>
      <td>{{ $adCampaignL->company }}</td>
      <td>{{ $adCampaignL->PointsStr }}</td>
      <td>
              <a href="{{ route('admin.reklama', ['campaign'=>$adCampaignL->id]) }}" class="btn btn-sm btn-dark mr-2">reklamy</a>
              <a href="{{ route('admin.reklama.kampane.edit', ['campaign'=>$adCampaignL->id]) }}" class="btn btn-sm btn-info mr-2">upraviť</a>
              <form action="{{ route('admin.reklama.kampane.edit', ['campaign'=>$adCampaignL->id]) }}" method="POST" class="d-inline">
                  @csrf
                  @method('delete')
                  <button class="btn btn-sm btn-danger" onclick="if (! confirm('Are you sure?')) { return false; }">vymazať</button>
              </form>
      </td>
    </tr>
  @endforeach
</table>
@if($adCampaigns->count()==0)
  <span class="text-danger font-weight-bold">Zatiaľ neboli pridané žiadne kampane.</span>
@endif
<hr>
<h3>Vytvoriť kampaň:</h3>
<form action="{{ route('admin.reklama.kampane') }}" method="POST">
  @csrf
  @include('ads._form_campaign')
</form>
@endsection
