@extends('layouts.app')
@section('title', 'Stránku sa nepodarilo nájsť.')

@section('content')

    <div style="text-align:center">
<h1 style="color:blue">ERROR 500</h1>
	<h2>Chyba na našej stránke!</h2>
		<p style="font-size:22px">
                    <img src="{{ asset('images/broken_pc.JPG') }}" style="text-align: left; margin: 10px 40px 20px 10px"/>
                    Na našej stránke alebo našom serveri sa vyskytla chyba.
                </p>
	</div>

@endsection
