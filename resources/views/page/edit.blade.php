@extends('layouts.app')
@section('title', 'upraviť článok')
@section('content')

<div style="position: relative; float: right">
    <a href="{{ route('page.show', ['page_slug'=>$page->slug]) }}" target="_blank">zobraziť</a>
</div>

<h1>Upraviť stránku</h1>
<form action="{{ route('page.edit', ['page_id'=>$page->id]) }}" method="POST">
    @csrf
    @method('PATCH')

<div class="row">
    <div class="col-6">
        <div class="form-group">
            <label for="title">Názov stránky:</label>
            <input type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : ''}}" name="title" id="title" placeholder="názov stránky" value="{{ $page->title ?? '' }}">
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
            <input type="text" class="form-control{{ $errors->has('description') ? ' is-invalid' : ''}}" value="{{ $page->description ?? '' }}" name="description" id="description" placeholder="popis stránky">  
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
            <input type="text" class="form-control{{ $errors->has('slug') ? ' is-invalid' : ''}}" value="{{  $page->slug ?? '' }}" name="slug" id="slug" placeholder="link stránky">  
            @if($errors->has('slug'))
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
                 {{  $page->text ?? '' }}
            </textarea> 
            <div id="textNum" style="text-align: right" align="right">0/10000</div>
        </div>
    </div>
</div>
<div class="col-md-10 text-center" style="margin-top: 10px">
         <button class="btn btn-primary">Uložiť</button>
</form>
            <form action="{{ route('page.delete', ['page_id'=>$page->id]) }}" method="POST" style="display: inline">
                @csrf
                @method('delete')
                <button class="btn btn-danger btn-sm"  style="margin-left: 10px" onclick="if (! confirm('Skutočne schcete vymazať túto stránku?')) { return false; }">Vymazať</button>
            </form>      
    </div>
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