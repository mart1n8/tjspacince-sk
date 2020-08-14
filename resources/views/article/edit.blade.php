@extends('layouts.app')
@section('title', 'upraviť článok')
@section('content')

<div style="position: relative; float: right">
    <a href="{{ route('article.show', ['article_slug'=>$article->slug]) }}" target="_blank">zobraziť</a>
</div>

<h1>Upraviť článok</h1>
<form action="{{ route('article.edit', ['article_id'=>$article->id]) }}" method="POST">
    @csrf
    @method('patch')

<div class="row">
    <div class="col-6">
        <div class="form-group">
            <label for="title">Názov článku:</label>
            <input type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : ''}}" name="title" id="title" placeholder="názov článku" value="{{ $article->title ?? '' }}">
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
            <input type="text" class="form-control{{ $errors->has('tags') ? ' is-invalid' : ''}}" value="{{ $article->tags ?? '' }}" name="tags" id="tags" placeholder="tagy článku">  
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
            <?php $pubDate = new DateTime($article->public_date); ?>
            <input type="datetime-local" class="form-control{{ $errors->has('public_date') ? ' is-invalid' : ''}}" value="<?= $pubDate->format('Y-m-d\TH:i') ?>" name="public_date" id="name">
            @if ($errors->has('public_date'))
                <span class="invalid-feedback">
                <strong>{{ $errors->first('public_date') }}</strong>
                </span>
            @endif
            <input type="checkbox" aria-label="zverejniť článok" name="is_publised" id="is_publised" <?= !empty($article->is_publised) ? 'checked="checked"' : '' ?>><label for="is_publised"> zverejniť článok ihneď</label>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group" style="vertical-align: bottom">
            <label for="is_publised">Zobrazenie na domovskej stránke:</label><br/>
            <input type="num_views" class="form-control{{ $errors->has('num_views') ? ' is-invalid' : ''}}" value="{{ $article->num_views }}" name="num_views" id="num_views"/>
            <small>0 - default(1000 znakov) | -1 - všetky znaky</small>
            <br/>
            <input type="checkbox" aria-label="zverejniť článok na domovskej stránke" name="show_on_homepage" id="show_on_homepage" <?= !empty($article->show_on_homepage) && $article->show_on_homepage!=0 ? 'checked="checked"' : '' ?>> <label for="show_on_homepage"> zverejniť článok na domovskej stránke</label>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-6">
        <div class="form-group">
            <label for="fb_share_img">Share image:</label>
            <select name="fb_share_img">
                <option value="" <?= empty($article->fb_share_img) ? 'selected' : '' ?>> --- zvoľ obrázok ---</option>
                @foreach($fbShareImgs as $fbShareImg)
			<option value="{{ $fbShareImg }}" <?= $article->fb_share_img==$fbShareImg ? 'selected' : '' ?>>{{ $fbShareImg }}</option>
		@endforeach
            </select><br/>
        </div>
    </div>
    <div class="col-6">

    </div>
</div> 
<div class="row">
    <div class="col-12">
        <div class="form-group">
            <label for="text">Text článku:</label>
            <textarea name="text" id="text" class="form-control" style="height: 25em" onkeyup="countChar(this)" class="form-control{{ $errors->has('text') ? ' is-invalid' : ''}}">
                {{ $article->text ?? '' }}
            </textarea> 
            <div id="textNum" style="text-align: right" align="right">
                @if ($errors->has('text'))
                    <span class="invalid-feedback">
                    <strong>{{ $errors->first('text') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
</div>
    <div class="col-md-10 text-center" style='margin-top: 10px'>
         <button class="btn btn-primary">Uložiť</button>
</form>
            <form action="{{ route('article.delete', ['article_id'=>$article->id]) }}" method="POST" style="display: inline">
                @csrf
                @method('delete')
                <button class="btn btn-danger btn-sm"  style="margin-left: 10px" onclick="if (! confirm('Skutočne schcete vymazať tento článok?')) { return false; }">Vymazať</button>
            </form>      
    </div>
</form>

<script>
    CKEDITOR.replace( 'text' );
</script> 

@endsection