@extends('layouts.app')
@section('title', 'pridať stránku')
@section('content')

<h1>Vytvorit stránku</h1>

<form action="" method="POST">
    @csrf
    @method('POST')

<div class="row">
    <div class="col-6">
        <div class="form-group">
            <label for="title">Názov stránky:</label>
            <input type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : ''}}" name="title" id="title" placeholder="názov stránky" value="{{ old('title') }}">
            @if ($errors->has('title'))
                <span class="invalid-feedback">
                <strong>{{ $errors->first('title') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label for="description">Popis:</label>
            <input type="text" class="form-control{{ $errors->has('description') ? ' is-invalid' : ''}}" value="{{ old('description') }}" name="description" id="description" placeholder="popis stránky">  
            @if ($errors->has('description'))
                <span class="invalid-feedback">
                <strong>{{ $errors->first('description') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
<div class="row">
    <div class="col-6">
        <div class="form-group">
            <label for="slug">Slug:</label>
            <input type="text" class="form-control{{ $errors->has('slug') ? ' is-invalid' : ''}}" value="{{ old('slug') }}" name="slug" id="slug" placeholder="link stránky">  
            @if ($errors->has('slug'))
                <span class="invalid-feedback">
                <strong>{{ $errors->first('slug') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-6">
    </div>
</div>  
<div class="row">
    <div class="col-12">
        <div class="form-group">
            <label for="text">Text stránky:</label>
            @if ($errors->has('text'))
                <span class="invalid-feedback">
                <strong>{{ $errors->first('text') }}</strong>
                </span>
            @endif
            <textarea name="text" id="text" class="form-control" style="height: 25em" onkeyup="countChar(this)" class="form-control{{ $errors->has('text') ? ' is-invalid' : ''}}">
                {{ old('text') }}
            </textarea> 
            <div id="textNum" style="text-align: right" align="right">0/10000</div>
        </div>
    </div>
</div>
<button name="submit" class="btn btn-primary"> Uložiť </button>
</form>

<script>

    ClassicEditor
        .create( document.querySelector('#text') )
        .catch( error => {
            console.error( error );
        } );

    
function countChar(val) {
        var len = val.value.length;
        if (len >= 10000) {
          val.value = val.value.substring(0, 10000);
        } else { 
          $('#textNum').text(len + "/10000");
        }
   };
</script>

@endsection