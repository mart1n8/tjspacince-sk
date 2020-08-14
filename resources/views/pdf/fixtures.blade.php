@extends('layouts.app')
@section('title', 'pridať zápas')
@section('content')

<h1>Vytvoriť rozlosovanie:</h1>
<form method="POST" action="">
@method('POST')
@csrf
<div class="row">
    <div class="col-5">
        <h4>Vyber tímy v tabuľkách:</h4>
        <h5>Prvá strana:</h5>
        <table>
            <tr>
                <td style="font-weight: bold">1. tím: </td>
                <td>
                    <select name="team1">
                        @foreach($teams as $team)
                        <option value="{{ $team->id }}" <?= old('team1')== $team->id ? ' selected' : '' ?>>{{ $team->name }}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
                <tr>
                <td style="font-weight: bold">2. tím: </td>
                <td>
                    <select name="team2">
                        @foreach($teams as $team)
                        <option value="{{ $team->id }}" <?= old('team2')== $team->id ? ' selected' : '' ?>>{{ $team->name }}</option>
                        @endforeach
                    </select>
            </td>
            </tr>
        </table>
        <br/>
        <h5>Druhá strana:</h5>
        <table> 
                <tr>
                <td style="font-weight: bold">3. tím: </td>
                <td>
                    <select name="team3">
                        @foreach($teams as $team)
                        <option value="{{ $team->id }}" <?= old('team3')== $team->id ? ' selected' : '' ?>>{{ $team->name }}</option>
                        @endforeach
                    </select>
            </td>
            </tr>
            <tr>
                <td style="font-weight: bold">4. tím: </td>
                <td>
                    <select name="team4">
                        @foreach($teams as $team)
                        <option value="{{ $team->id }}" <?= old('team4')== $team->id ? ' selected' : '' ?>>{{ $team->name }}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
        </table>
    </div>
    <div class="col-5">
        <div class="row">
          <div class="col-12">
              <h4>Časť sezóny {{ $season->name }}:</h4>
              <div class="form-check">
                  <input class="form-check-input"  type="radio" name="season_part" id="season_part_outum" value="1" <?= empty(old('season_part')) ? ' checked="checked"' : '' ?>><label for="season_part_outum" class="form-check-label"> jesenná časť</label>
                  <br/>
                  <input class="form-check-input"  type="radio" name="season_part" id="season_part_spring" value="2"><label for="season_part_spring" class="form-check-label"> jarná časť</label>
              </div>            
          </div
          <hr/>
        </div>
          <div class="row" style="margin-top: 2em">
            <div class="col-12">
              <div style="font-size:1.2em; font-weight:bold">Možnosti:</div>
              <input class="form-check-input"  type="checkbox" name="res_col" id="res_col" value="2"><label for="res_col" class="form-check-label"> zobraziť stĺpec výsledky?</label>
            </div>
          </div>
    </div>
</div>
<div style="text-align: center; margin-top:1.5em">
    <button class="btn btn-primary">Generovať rozlosovanie</button>
</div>
</form>
@endsection
