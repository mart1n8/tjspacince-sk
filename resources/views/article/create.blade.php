@extends('layouts.app')
@section('title', 'pridať článok')
@section('content')
<h1>Vytvorit článok</h1>

<form action="" method="POST">
    @csrf
    @method('POST')
<div class="row">
    <div class="col-6">
        <div class="form-group">
            <label for="title">Názov článku:</label>
            <input type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : ''}}" name="title" id="title" placeholder="názov článku" value="{{ old('title') }}">
            @if ($errors->has('title'))
                <span class="invalid-feedback">
                <strong>{{ $errors->first('title') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label for="tags">Tagy:</label>
            <input type="text" class="form-control{{ $errors->has('tags') ? ' is-invalid' : ''}}" value="{{ old('tags') }}" name="tags" id="tags" placeholder="tagy článku">  
            <small>*delené čiarkou napr.: A tím, 2016, </small>
            @if ($errors->has('tags'))
                <span class="invalid-feedback">
                <strong>{{ $errors->first('tags') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
<div class="row">
    <div class="col-6">
        <div class="form-group">
            <label for="public_date">Dátum zverejnenia:</label>
            <input type="datetime-local" class="form-control{{ $errors->has('public_date') ? ' is-invalid' : ''}}" value="{{ old('public_date') }}" name="public_date" id="name">
            @if ($errors->has('public_date'))
                <span class="invalid-feedback">
                <strong>{{ $errors->first('public_date') }}</strong>
                </span>
            @endif
            <input type="checkbox" aria-label="zverejniť článok" name="is_publised" id="is_publised" <?= !empty(old('is_publised')) ? 'checked="checked"' : '' ?>> <label for="is_publised"> zverejniť článok ihneď</label>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group" style="vertical-align: bottom">
            <label for="is_publised">Zobrazenie na domovskej stránke:</label><br/>
            <input type="num_views" class="form-control{{ $errors->has('num_views') ? ' is-invalid' : ''}}" value="{{ old('num_views') ?? '0' }}" name="num_views" id="num_views"/>
            <small>0 - default(1000 znakov) | -1 - všetky znaky</small>
            <br/>
            <input type="checkbox" aria-label="zverejniť článok na domovskej stránke" name="show_on_homepage" id="show_on_homepage" <?= !empty(old('show_on_homepage')) ? 'checked="checked"' : '' ?>> <label for="show_on_homepage"> zverejniť článok na domovskej stránke</label>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-6">
        <div class="form-group">
            <label for="fb_share_img">Share image:</label>
            <select name="fb_share_img">
                <option value="" <?= !old('fb_share_img') ? 'selected' : '' ?>> --- zvoľ obrázok ---</option>
                @foreach($fbShareImgs as $fbShareImg)
									<option value="{{ $fbShareImg }}" <?= old('fb_share_img')==$fbShareImg ? 'selected' : '' ?>>{{ $fbShareImg }}</option>
								@endforeach
            </select>
        </div>
    </div>
    <div class="col-6">

    </div>
</div> 
<div class="row">
    <div class="col-12">
        <div class="form-group">
            <label for="text">Text článku:</label>
            <textarea name="text" id="text" class="form-control" style="min-height: 500px;" class="form-control{{ $errors->has('text') ? ' is-invalid' : ''}}">
                {{ old('text') }}
            </textarea> 
            <div id="textNum" style="text-align: right" align="right">
								@if($errors->has('text'))
									<span class="invalid-feedback">
									<strong>{{ $errors->first('text') }}</strong>
								@endif
            </div>
        </div>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-12 justify-content-center text-center">
        <button name="submit" class="btn btn-primary"> Uložiť </button>
    </div>
</div>
</form>

<script>
    CKEDITOR.replace( 'text' );
</script> 

@endsection