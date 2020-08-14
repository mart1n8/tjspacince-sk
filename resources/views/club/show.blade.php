@extends('layouts.app') @section('title', $club->name) @section('content')
<h1>{{ $club->name }}</h1>

<div class="row">
  <div class="col-2">
    <?php $logo = !empty($club->emblem) ?  $club->emblem : 'no_logo.png' ?>
    <img src="{{ asset('/uploads/clubs/'.$logo) }}" class="img-fluid rounded align-middle" style="float: left; margin: 0px 10px 10px 0px;" />
  </div>
  <div class="col-10">
    <span style="font-weight: bold">Dedina/Mesto:</span>
    <span>{{ $club->city }}</span><br/>
    @if(!empty($club->website) or !empty($club->fb_web))
        <span style="font-weight: bold">Linky:</span>
        @if(!empty($club->website))
           <span style="font-weight: bold">
              <a href="{{ $club->website }}" target="_blank"><img src="{{ asset('images/web.png') }}" alt="website {{ $club->name }}" title="website {{ $club->name }}" style="width: 15px">
                {{ $club->short_name }}
             </a>
           </span><br/>
        @endif
        @if(!empty($club->fb_web))
          <span>
             <a href="https://www.facebook.com/{{ $club->fb_web }}" target="_blank"><img src="{{ asset('iamges/facebook.png') }}" alt="website {{ $club->name }}" title="website {{ $club->name }}"></a>
          </span><br/>
        @endif
    @endif
    <hr/> @if($club->matchs->count()>0)
        <h4>Zápasy: </h4>
        @foreach($teams as $team) @if($team->matchsWithClub($club->id)->count()==0) @continue @endif
          <h5>{{ $team->name }}</h5>
          <div style="mb-2">
            @foreach($team->matchsWithClub($club->id) as $match)
              <div style="display: inline; padding-right: 20px">{{ $match->shortDate }}</div>
              <div style="display: inline; padding-right: 20px">{{ $match->shortMatch }}</div>
              <div style="display: inline;">{{ $match->result }}</div>
              <br/>
            @endforeach          
          </div>
       @endforeach
    @endif

  </div>
</div>

@if(!empty($club->arena_gps))
<br/><br/>
<div class="row">
  <?php $coordinates = explode(",", $club->arena_gps) ?> @if(!empty($club->arena_gps) && !empty($coordinates[1]))
  <div class="col-6">
    <h3>Štadión:</h3>
      <div id="map" style="width:350px; height:350px;"></div>
  </div>
  <script>
    function initMap() {
      var uluru = {
        lat: <?= $coordinates[0] ?>,
        lng: <?= $coordinates[1] ?>
      };
      var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 15,
        center: uluru
      });
      var marker = new google.maps.Marker({
        position: uluru,
        map: map
      });
    }
  </script>
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAOnYlzsZ-1Mtl4ZpKs2iRENf4ZU_bylFY&callback=initMap">
  </script>
  @endif
  @if(!empty($club->about))
  <div class="col-6">
    <h3>O klube:</h3>
    {{ $club->about }}
  </div>
  @endif
</div>
@endif @if(Auth::check() && Auth::user()->roles>1)
<hr/>
<div style="float: right;">
  <a href="{{ route('club.edit', ['club_id'=>$club->id]) }}"><button class="btn btn-sm btn-secondary"> upraviť </button></a>
</div>
@endif @endsection