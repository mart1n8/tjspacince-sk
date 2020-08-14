@extends('layouts.app')
@section('title', 'pridať tabuľku')
@section('content')
<div style='float:right'>
    <a href="{{ route('admin.tables.adminList') }}"><-- tabuľky</a>
</div>
<h1>Pridať tabuľku</h1>
<form action="{{ route('tables.create') }}" method="POST">
    @csrf
    @method('POST')
<div class="row">
    <div class="col-12">
        <div class="form-group">
            <label for="title" style="font-weight: bold">Title:</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}" class="form-control{{ $errors->has('title') ? ' is-invalid' : ''}}"/>
            @if ($errors->has('title'))
                <span class="invalid-feedback"><strong>{{ $errors->first('title') }}</strong></span>
            @endif
        </div>
    </div>
</div>
<div class="row">
    <div class="col-3">
        <div class="form-group">
            <label for="team_id" style="font-weight: bold">Team:</label>
            <select name="team_id" class="form-control{{ $errors->has('team_id') ? ' is-invalid' : ''}}">
                <option value="">--- tím --</option>
                @foreach($teams as $team)
                <option value="{{ $team->id }}" <?= $team->id==old('team_id') ? 'selected' : '' ?>>{{ $team->name }}</option>
                @endforeach
            </select>
            @if ($errors->has('team_id'))
                <span class="invalid-feedback"><strong>{{ $errors->first('team_id') }}</strong></span>
            @endif
        </div>
    </div>
    <div class="col-3">
        <div class="form-group">
            <label for="season_id" style="font-weight: bold">Season:</label>
            <select name="season_id" class="form-control{{ $errors->has('season_id') ? ' is-invalid' : ''}}">
                <option value="">--- sezóna --</option>
                @foreach($seasons as $season)
                <option value="{{ $season->id }}" <?= $season->id==old('season_id') ? 'selected' : '' ?>>{{ $season->name }}</option>
                @endforeach
            </select>
            @if ($errors->has('season_id'))
                <span class="invalid-feedback"><strong>{{ $errors->first('season_id') }}</strong></span>
            @endif
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="form-group">
            <label for="table_text">Tabuľka:</label>
            <textarea name="table_text" id="table_text" style="height: 20em" class="form-control{{ $errors->has('table_text') ? ' is-invalid' : ''}}">{{ old('table_text') }}</textarea>
            @if ($errors->has('table_text'))
                <span class="invalid-feedback"><strong>{{ $errors->first('table_text') }}</strong></span>
            @endif
        </div>
    </div>
</div>
<button name="submit" class="btn btn-primary"> Uložiť </button>
</form>
<script>
    CKEDITOR.replace( 'table_text' );
</script>
@endsection