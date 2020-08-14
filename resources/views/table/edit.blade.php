@extends('layouts.app')
@section('title', 'upraviť tabuľku')
@section('content')
<div style='float:right'>
    <a href="{{ route('admin.tables.adminList') }}"><-- tabuľky</a>
</div>
<h1>Upraviť tabuľku</h1>
<form action="{{ route('tables.edit', ['table_id'=>$table->id]) }}" method="POST">
    @csrf
    @method('patch')
<div class="row">
    <div class="col-12">
        <div class="form-group">
            <label for="title" style="font-weight: bold">Title:</label>
            <input type="text" name="title" id="title" value="{{ $table->title }}" class="form-control{{ $errors->has('title') ? ' is-invalid' : ''}}"/>
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
                @foreach($teams as $team)
                <option value="{{ $team->id }}" <?= $team->id==$table->team_id ? 'selected' : '' ?>>{{ $team->name }}</option>
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
                <option value="{{ $season->id }}" <?= $season->id==$table->season_id ? 'selected' : '' ?>>{{ $season->name }}</option>
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
            <textarea name="table_text" id="table_text" style="height: 50em; border: 1px black solid;" class="form-control{{ $errors->has('table_text') ? ' is-invalid' : ''}}">
                {{$table->table_text}}
            </textarea>
            @if ($errors->has('table_text'))
                <span class="invalid-feedback"><strong>{{ $errors->first('table_text') }}</strong></span>
            @endif
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-10 text-center" style="margin-top: 10px">
        <button class="btn btn-primary">Uložiť</button>
        </form>
        <form action="{{ route('admin.tables.delete', ['table_id'=>$table->id]) }}" method="POST" style="display: inline">
            @csrf
            @method('delete')
            <button class="btn btn-danger btn-sm"  style="margin-left: 10px" onclick="if (! confirm('Skutočne schcete vymazať túto tabuľku?')) { return false; }">Vymazať</button>
        </form>      
    </div>
    </form>
</div>
<script>
    CKEDITOR.replace( 'table_text' );
</script> 
@endsection