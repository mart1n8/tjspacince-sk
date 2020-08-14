@extends('layouts.app')
@section('title', 'Stránku sa nepodarilo nájsť.')

@section('content')

    <div style="text-align:center">
<h1 style="color:blue">ERROR 404</h1>
	<h2>Stránka nenájdená!</h2>
		<span style="font-size:22px">Ľutujeme, ale požadovanú stránku sa nepodarilo nájsť.<br/>
		Podobne ako loptu z videa nižšie ju asi nikdy nenájdete.
		</span>
		<br/><br/>
		<iframe width="420" height="315" src="https://www.youtube.com/embed/Eevuxr0MxEU" frameborder="0" allowfullscreen></iframe>
		<br/><br/>
	</div>

@endsection
