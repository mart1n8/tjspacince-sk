@extends('layouts.app')
@section('title', 'administracia')
@section('content')
<h3>Administracia</h3>
<div class="row">
    <div class="col-4">
        <h4>OBSAH:</h4>
        <ul><span style="font-weight: bold">Články:</span>
            <li><a href="{{ route('article.adminList') }}">zoznam</a></li>
            <li><a href="{{ route('article.create') }}">pridať článok</a></li>
        </ul>
        <ul><span style="font-weight: bold">Stránky:</span>
            <li><a href="{{ route('page.adminList') }}">zoznam</a></li>
            <li><a href="{{ route('page.create') }}">pridať stránku</a></li>
        </ul>
        <hr/>
    </div>
    <div class="col-4">
        <h4>KLUB:</h4>
        <ul><span style="font-weight: bold">Hráči:</span>
            <li><a href="{{ route('player.adminList') }}">zoznam</a></li>
            <li><a href="{{ route('player.create') }}">pridať hráča</a></li>
        </ul>
        <ul><span style="font-weight: bold">Zápasy:</span>
            <li><a href="{{ route('admin.matchs.adminList') }}">zoznam</a></li>
            <li><a href="{{ route('matchs.create') }}">pridať zápas</a></li>
        </ul>
        <ul><span style="font-weight: bold">Tabuľky:</span>
            <li><a href="{{ route('admin.tables.adminList') }}">zoznam</a></li>
            <li><a href="{{ route('tables.create') }}">pridať tabuľku</a></li>
        </ul>
        <ul><span style="font-weight: bold">Kluby:</span>
            <li><a href="{{ route('club.adminList') }}">zoznam</a></li>
            <li><a href="{{ route('club.create') }}">pridať klub</a></li>
        </ul>
        <ul><span style="font-weight: bold">Ostatné:</span>
            <li><a href="{{ route('admin.teams.index') }}">tímy</a></li>
            <li><a href="{{ route('admin.seasons.index') }}">sezóny</a></li>
        </ul>
    </div>
    <div class="col-4">
        <h4>SPRÁVA WEBU:</h4>
        <ul><span style="font-weight: bold">Užívatelia:</span>
            <li><a href="{{ route('admin.user.index') }}">zoznam užívateľov</a></li>
        </ul>
        <ul><span style="font-weight: bold">Ostatné:</span>
            <li><a href="{{ route('admin.kontakt-admin') }}">správy ({{$noReadMsg}})</a></li>
        </ul>
        <hr/>
        <h4>Reklama:</h4>
        <ul>
            <li><a href="{{ route('admin.reklama.kampane') }}">reklamné kampane</a></li>
        </ul>
        <ul><span style="font-weight: bold">Ostatné:</span>
            <li><a href="{{ route('admin.kontakt-admin') }}">správy ({{$noReadMsg}})</a></li>
        </ul>
    </div>
</div>



@endsection
