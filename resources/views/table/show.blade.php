@extends('layouts.app')
@section('title', 'tabuľky '.$team->name)
@section('content')
<h3>Tabuľka <span id="team_name">{{ $team->name }}</span> sezóna <span id="season_name"></span></h3>
<form>
    <div class="form-inline">
        <div class="form-group">
            <label style="font-weight: bold; margin-left: 30px; margin-right: 15px" >Sezóna: </label>
            <select name="sel_season" id="sel_season" class="form-control">
                @foreach($seasons as $season_i)
                    <option value="{{ $season_i->slug }}" <?= $season_i->is_current==1 ? 'selected' : '' ?>>{{ $season_i->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
</form>
<div style="text-align: center; margin-top: 2em" id="table">
    
</div>
@if(Auth::check() && Auth::user()->roles>=3)
<div style="float: right">
    <a href=""></a>
</div>
@endif

<script type="application/javascript">
    window.onload = showTbl;
    $('form').on('keyup change paste', 'input, select, textarea', showTbl);

    function showTbl(str) {
        var team = <?= $team->id ?> 
        var season = document.getElementById("sel_season").value
        var url = '/tabulka/' + team +'/' +season+'/json';
        var xmlhttp = new XMLHttpRequest();

        var team_name= document.getElementById("team_name")
        var season_name = document.getElementById("season_name")
        var table = document.getElementById("table")

        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
               data = JSON.parse(this.responseText);
               team_name.innerHTML = data.team_name;
               season_name.innerHTML = data.season_name;
               table.innerHTML = data.table;
            }
        };
            xmlhttp.open("GET", url, true);
            xmlhttp.send();
    }
    
</script>

@endsection
