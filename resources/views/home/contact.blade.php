@extends('layouts.app')
@section('title', 'kontaktovať administrátora')

@section('content')
    <h1>Kontakt:</h1>
    <p>Tento formulár slúži na kontaktovanie administrátora stránky, pre kontaktovanie 
        funkcionárov klubu použite kontaktné údaje, ktoré nájdete v časti <a href="{{ route('page.show', ['page_slug'=>'klub'])}}" title="klub">KLUB</a>.</p>
 <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">KONTAKT</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('home.contactAdmin') }}">
                        @csrf
                        @method('POST')
                        <div class="form-group row">
                            <label for="email" class="col-sm-2 col-form-label text-md-right" style="font-weight: bold">E-mail:</label>
                            <div class="col-md-10">
                                <?php
                                    $email = Auth::check() ? Auth::user()->email : "";
                                    $email = !empty(old('email')) ? old('email') : $email;
                                ?>
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="message" class="col-md-2 col-form-label text-md-right" style="font-weight: bold">Text správy:</label>
                            <div class="col-md-10">
                                <textarea name="message" class="form-control{{ $errors->has('message') ? ' is-invalid' : '' }}" required style="min-height: 10em">{{ old('message') }}</textarea>
                                @if ($errors->has('message'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('message') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-2">
                                <div class="form-control{{ $errors->has('g-recaptcha-response') ? ' is-invalid' : '' }}" style="height: 100px; width: 330px">
                                    {!! Captcha::display($attributes = [], $options = ['class'=> $errors->has('g-recaptcha-response') ? ' is-invalid' : '' ]) !!}
                                </div>
                                    @if ($errors->has('g-recaptcha-response'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                        </div><br/>
                                    @endif
                                </div>
                            
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-info btn-lg"> Odoslať </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> 
    
@endsection
