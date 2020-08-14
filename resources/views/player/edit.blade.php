@extends('layouts.app')
@section('title', 'upraviť hráča')
@section('content')

<h1>Upraviť hráča</h1>
<form action="{{ route('player.edit', ['player_id'=>$player->id]) }}" method="POST">
    @csrf
    @method('patch')
<div class="row">
    <div class="col-6">
        <div class="form-group">
            <label for="firstname" style="font-weight: bold;">Meno:</label>
            <input type="text" class="form-control{{ $errors->has('firstname') ? ' is-invalid' : ''}}" name="firstname" id="firstname" placeholder="meno hráča" value="{{ $player->firstname }}">
            @if ($errors->has('firstname'))
                <span class="invalid-feedback">
                <strong>{{ $errors->first('firstname') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label for="lastname" style="font-weight: bold;">Priezvisko:</label>
            <input type="text" class="form-control{{ $errors->has('lastname') ? ' is-invalid' : ''}}" value="{{ $player->lastname }}" name="lastname" id="lastname" placeholder="priezvisko">
            @if ($errors->has('lastname'))
                <span class="invalid-feedback">
                <strong>{{ $errors->first('lastname') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
<div class="row">
    <div class="col-6">
        <div class="form-group">
            <label for="fn_id" style="font-weight: bold;">ID na FutbalNet:</label>
            <input type="text" class="form-control{{ $errors->has('fn_id') ? ' is-invalid' : ''}}" name="fn_id" id="fn_id" placeholder="ID na futbalnet.sk" maxlength="7" value="{{ $player->fn_id }}">
            @if ($errors->has('fn_id'))
                <span class="invalid-feedback">
                <strong>{{ $errors->first('fn_id') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <br/><br/><input type="checkbox" class="{{ $errors->has('is_active') ? ' is-invalid' : ''}}" <?= (!empty($player->is_active) && ($player->is_active==1)) ? 'checked="checked"' : '' ?> name="is_active" id="is_active">
            <label for="is_active" style="font-weight: bold;"> hráč je momentálne aktívny</label>
            @if ($errors->has('lastname'))
                <span class="invalid-feedback">
                <strong>{{ $errors->first('lastname') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
<hr/>
<div class="row">
    <div class="col-6">
        <div class="form-group">
            <label for="photo">Fotka:</label>
            <input type="file" class="form-control{{ $errors->has('photo') ? ' is-invalid' : ''}}" name="photo" id="photo" accept="image/*">
            @if ($errors->has('photo'))
                <span class="invalid-feedback">
                <strong>{{ $errors->first('photo') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label for="birth_date">Dátum narodenia:</label>
            <input type="date" class="form-control{{ $errors->has('birth_date') ? ' is-invalid' : ''}}" value="{{ $player->birth_date }}" name="birth_date" id="birth_date">
            @if ($errors->has('birth_date'))
                <span class="invalid-feedback">
                <strong>{{ $errors->first('birth_date') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
<div class="col-md-10 text-center" style="margin-top: 10px">
         <button class="btn btn-primary">Uložiť</button>
</form>
            <form action="{{ route('player.delete', ['player_id'=>$player->id]) }}" method="POST" style="display: inline">
                @csrf
                @method('delete')
                <button class="btn btn-danger btn-sm"  style="margin-left: 10px" onclick="if (! confirm('Skutočne schcete vymazať hráča <?= $player->getName() ?>?')) { return false; }">Vymazať</button>
            </form>      
    </div>
</form>


@endsection