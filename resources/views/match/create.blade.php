@extends('layouts.app')
@section('title', 'pridať zápas')
@section('content')

<h1>Pridať zápas</h1>
<form action="" method="POST">
    @csrf
    @method('POST')
<div class="row">
    <div class="col-6">
        <div class="form-group">
            <label for="club" style="font-weight: bold">Klub:</label>
            <input type="text" name="club" id="club" value='{{ old("club") }}' class="form-control{{ $errors->has('club_id') ? ' is-invalid' : '' }}">
            @if ($errors->has('club_id'))
                <span class="invalid-feedback"><strong>{{ $errors->first('club_id') }}</strong></span>
            @endif
            <input type="hidden" name="club_id" id="club_id" value="{{ old('club_id') }}">
            <small id="check" class="form-text text-muted">-</small>
            <hr/>
            <span style="font-weight: bold" class="form-control{{ $errors->has('home_away') ? ' is-invalid' : '' }}">Miesto zápasu: </span>
            @if ($errors->has('home_away'))
                <span class="invalid-feedback"><strong>{{ $errors->first('home_away') }}</strong></span>
            @endif
            <span style="margin-left: 10px"><input type="radio" name="home_away" id="home_away_0" value="0" <?= old('home_away')==0 ? 'checked="checked"' : '' ?>><label for="home_away_0"> doma</label></span>
            <span style="margin-left: 15px"><input type="radio" name="home_away" id="home_away_1" value="1" <?= !empty(old('home_away') && old('home_away')==1) ? 'checked="checked"' : '' ?>><label for="home_away_1"> vonku</label></span>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label for="team" style="font-weight: bold">Tím:</label>
            <ul style="list-style-type: none;">
                @foreach($teams as $team)
                <li><input type="radio" name="team_id" id="team{{$team->id}}" value="{{ $team->id }}" <?= !empty(old('team_id') && old('team_id')==$team->id) ? 'checked="checked"' : '' ?>> <label for="team{{$team->id}}">{{$team->name}}</label></li>
                @endforeach
            </ul>
                
            @if ($errors->has('team_id'))
                <span class="invalid-feedback">
                <strong>{{ $errors->first('team_id') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
    <br/>
<div class="row">
    <div class="col-6">
        <div class="form-group">
            <label for="season_id" style="font-weight: bold">Sezóna:</label>
            <select class="form-control{{ $errors->has('season_id') ? ' is-invalid' : ''}}" name="season_id" id="season_id">
            @foreach($seasons as $season)
                <option value="{{ $season->id }}" <?= $season->is_current==1 ? 'selected'  :'' ?>>{{$season->name}}</option>
            @endforeach
            </select>
            @if ($errors->has('season_id'))
                <span class="invalid-feedback"><strong>{{ $errors->first('season_id') }}</strong></span>
            @endif
        </div>
        <div class="form-group">
            <label for="match_datetime" style="font-weight: bold">Dátum zápasu:</label>
            <div class='input-group date' id='datetimepicker3'>
				<input type="datetime-local" class="form-control{{ $errors->has('match_datetime') ? ' is-invalid' : ''}}" value="{{ old('match_datetime') }}" name="match_datetime" id="match_datetime">
				<span class="input-group-addon">
				  <span class="glyphicon glyphicon-time"></span>
			  </span>
			</div>
            @if ($errors->has('match_datetime'))
                <span class="invalid-feedback"><strong>{{ $errors->first('match_datetime') }}</strong></span>
            @endif
        </div>
    </div>
    <div class="col-6">
        <div class="form-group" style="vertical-align: bottom">
            <label for="autobus" style="font-weight: bold">Autobus:</label><br/>
            <input type="checkbox" aria-label="ide autobus" name="is_bus" id="is_bus" <?= !empty(old('is_bus')) ? 'checked="checked"' : '' ?>> <label for="is_bus"> na zápas ide autobus</label>
            <br/><br/>
            <label for="autobus">Odchod autobusu:</label>
            <input type="time" class="form-control{{ $errors->has('bus_time') ? ' is-invalid' : ''}}" value="{{ old('bus_time') }}" name="bus_time" id="bus_time">
            @if ($errors->has('bus_time'))
                <span class="invalid-feedback">
                <strong>{{ $errors->first('bus_time') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
<div class="row">
    <div class="col-6">
        <div class="form-group">
            <label for="fn_ID" style="font-weight: bold">FutbalNET ID:</label>
            <div class='input-group date' id='datetimepicker3'>
		<input type="text" class="form-control{{ $errors->has('fn_ID') ? ' is-invalid' : ''}}" value="{{ old('fn_ID') }}" name="fn_ID" id="fn_ID">
            </div>
            @if ($errors->has('fn_ID'))
                <span class="invalid-feedback"><strong>{{ $errors->first('fn_ID') }}</strong></span>
            @endif
        </div>
    </div>
    <div class="col-6">
    </div>
</div>  
<div class="row">
    <div class="col-12">
        <div class="form-group">
            <label for="short_info">Informácie k zápasu:</label>
            @if ($errors->has('short_info'))
                <span class="invalid-feedback">
                <strong>{{ $errors->first('short_info') }}</strong>
                </span>
            @endif
            <textarea name="short_info" id="short_info" class="form-control" style="height: 4em" onkeyup="countChar(this)" class="form-control{{ $errors->has('short_info') ? ' is-invalid' : ''}}">{{ old('short_info') }}</textarea> 
            <div id="textNum" style="text-align: right" align="right">0/200</div>
        </div>
    </div>
</div>
<button name="submit" class="btn btn-primary"> Uložiť </button>
</form>

<script type="application/javascript">

       //* AUTOCOMPLETE CLUB
    var options = {
    	url: "/autocomplete_club",
    	getValue: "name",
    	list: {
            maxNumberOfElements: 5,
            match: {
                enabled: true
            },
            onSelectItemEvent: function() {
              var club_id = $("#club").getSelectedItemData().id;
              $("#club_id").val(club_id).trigger("change");
            },
            onClickEvent: function() {
                $("#check").html('<span style="color:green">OK</span>');
            },
            onShowListEvent: function() {
                $("#check").html('<span style="color:red">neplatný tím!</span>');
            },
            showAnimation: {
                type: "fade", //normal|slide|fade
                time: 400,
                callback: function() {}
            },
            sort: {
                enabled: true
            }
        }
    };
    $("#club").easyAutocomplete(options);
</script>

@endsection
