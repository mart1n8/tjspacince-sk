@extends('layouts.app')
@section('title', 'upraviť klub')
@section('content')

<h1>Upraviť klub</h1>
<form action="{{ route('club.edit', ['club_id'=>$club->id]) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('patch')

    <div class="row">
         <div class="col-2">
               <img src="/uploads/clubs/<?= $club->emblem ?? 'no_logo.png' ?>" class="img-fluid rounded align-middle" style="float: left; margin: 0px 10px 10px 0px;"/>
         </div>
        <div class="col-5">
            <div class="form-group">
                <label for="name" style="font-weight: bold">Názov klubu:</label>
                <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : ''}}" name="name" id="title" placeholder="názov klubu" value="{{ $club->name ?? '' }}">
                @if ($errors->has('name'))
                    <span class="invalid-feedback">
                    <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-5">
            <div class="form-group">
                <label for="short_name">Krátky názov klubu:</label>
                <input type="text" class="form-control{{ $errors->has('short_name') ? ' is-invalid' : ''}}" value="{{ $club->short_name ?? '' }}" name="short_name" id="short_name" placeholder="krátky názov klubu">  
                <small>*pre plagáty a rozlosovanie</small>
                @if ($errors->has('short_name'))
                    <span class="invalid-feedback">
                    <strong>{{ $errors->first('short_name') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="city" style="font-weight: bold">Mesto/Dedina:</label>
                <input type="text" class="form-control{{ $errors->has('city') ? ' is-invalid' : ''}}" name="city" id="city" placeholder="názov dediny alebo mesta" value="{{ $club->city ?? '' }}">
                @if ($errors->has('city'))
                    <span class="invalid-feedback">
                    <strong>{{ $errors->first('city') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="emblem">Znak klubu:</label>
                <input type="file" class="form-control{{ $errors->has('emblem') ? ' is-invalid' : ''}}" name="emblem" id="emblem" accept="image/*">  
                @if ($errors->has('emblem'))
                    <span class="invalid-feedback">
                    <strong>{{ $errors->first('emblem') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>   
<div class="row">
    <div class="col-6">
        <div class="form-group">
            <label for="website">Webstránka:</label>
            <input type="text" class="form-control{{ $errors->has('website') ? ' is-invalid' : ''}}" name="website" id="website" placeholder="webstránka klubu" value="{{ $club->website ?? '' }}">
            @if ($errors->has('website'))
                <span class="invalid-feedback">
                <strong>{{ $errors->first('website') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label for="arena_gps">GPS štadiónu:</label>
            <input type="text" class="form-control{{ $errors->has('arena_gps') ? ' is-invalid' : ''}}" value="{{ $club->arena_gps ?? '' }}" name="arena_gps" id="arena_gps" placeholder="GPS štadiónu">  
            <small>*delené čiarou napr.: 48.4762536,17.6441779</small>
            @if ($errors->has('arena_gps'))
                <span class="invalid-feedback">
                <strong>{{ $errors->first('arena_gps') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
 <div class="row">
    <div class="col-6">
        <div class="form-group">
            <label for="fb_web">Facebook stránka:</label>
            <input type="text" class="form-control{{ $errors->has('fb_web') ? ' is-invalid' : ''}}" name="fb_web" id="fb_web" placeholder="facebook webstránka klubu" value="{{ $club->fb_web ?? '' }}">
            @if ($errors->has('fb_web'))
                <span class="invalid-feedback">
                <strong>{{ $errors->first('fb_web') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label for="about">O klube:</label>
            <textarea class="form-control{{ $errors->has('about') ? ' is-invalid' : ''}}" name="about" id="about" placeholder="o klube" style="height: 8em">{{ $club->about ?? '' }}</textarea>
            @if ($errors->has('about'))
                <span class="invalid-feedback">
                <strong>{{ $errors->first('about') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>   
    <div class="col-md-10 text-center" style='margin-top: 10px'>
         <button class="btn btn-primary">Uložiť</button>
</form>
            <form action="{{ route('club.delete', ['club_id'=>$club->id]) }}" method="POST" style="display: inline">
                @csrf
                @method('delete')
                <button class="btn btn-danger btn-sm"  style="margin-left: 10px" onclick="if (! confirm('Skutočne schcete vymazať tento klub?')) { return false; }">Vymazať</button>
            </form>      
    </div>
</form>
</form>
@endsection