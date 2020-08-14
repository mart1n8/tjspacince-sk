@extends('layouts.app')
@section('title', 'pridať hráča')
@section('content')

<h1>Pridať hráča</h1>
<form action="" method="POST">
    @csrf
    @method('POST')
<div class="row">
    <div class="col-6">
        <div class="form-group">
            <label for="firstname" style="font-weight: bold;">Meno:</label>
            <input type="text" class="form-control{{ $errors->has('firstname') ? ' is-invalid' : ''}}" name="firstname" id="firstname" placeholder="meno hráča" value="{{ old('firstname') }}">
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
            <input type="text" class="form-control{{ $errors->has('lastname') ? ' is-invalid' : ''}}" value="{{ old('lastname') }}" name="lastname" id="lastname" placeholder="priezvisko">
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
            <input type="text" class="form-control{{ $errors->has('fn_id') ? ' is-invalid' : ''}}" name="fn_id" id="fn_id" placeholder="ID na futbalnet.sk" maxlength="7" value="{{ old('fn_id') }}">
            @if ($errors->has('fn_id'))
                <span class="invalid-feedback">
                <strong>{{ $errors->first('fn_id') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <br/><br/><input type="checkbox" class="{{ $errors->has('is_active') ? ' is-invalid' : ''}}" <?= (empty(old()) or !empty(old('is_active'))) ? 'checked="checked"' : '' ?> name="is_active" id="is_active">
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
            <input type="date" class="form-control{{ $errors->has('birth_date') ? ' is-invalid' : ''}}" value="{{ old('birth_date') }}" name="birth_date" id="birth_date">
            @if ($errors->has('birth_date'))
                <span class="invalid-feedback">
                <strong>{{ $errors->first('birth_date') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
<button name="submit" class="btn btn-primary"> Uložiť </button>
</form>


@endsection