@extends('layouts.app')

@section('content')
<h1>Zápasy: <?= $team->name ?> sezóna <?= $season->name ?></h1>
<form id='redform'>
    <span style="font-weight: bold" >Tím: </span>
    @foreach($teams as $team_i)
    <span style="margin-left: 10px"><input type="radio" name="sel_team" id="sel_team_{{ $team_i->id }}" value="{{ $team_i->slug }}" <?= $team->id == $team_i->id ? 'checked="checked"' : '' ?>><label for="sel_team_{{ $team_i->id }}"> {{ $team_i->name }}</label></span>
    @endforeach
    <span style="font-weight: bold; margin-left: 30px" >Sezóna: </span>
    <select name="sel_season" id="sel_season">
        @foreach($seasons as $season_i)
            <option value="{{ $season_i->slug }}" <?= $season->id==$season_i->id ? 'selected' : '' ?>>{{ $season_i->name }}</option>
        @endforeach
    </select>
</form>
    <table class="table table-sm">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">match:</th>
            <th scope="col">date:</th>
            <th scope="col">result:</th>
            <th scope="col" style="text-align: center">edit @if($team->id==1) | statistic @endif</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($matchs as $match)
          <tr>
            <th scope="row"><?= $match->id ?></th>
            <td><a href="{{ route('matchs.show', ['match'=>$match->slug]) }}"><?= $match->shortMatch ?></a>
            @if(!empty($match->fn_ID))
                <span style="margin-left: 5px"><img src="{{ asset('images/fn_check.png') }}" alt="ID z FutbalNetu: {{ $match->fn_ID }}" title="ID z FutbalNetu: {{ $match->fn_ID }}" style="height:1em"/></span>
            @endif
            @if($match->locked == 1)
                <span style="margin-left: 5px"><img src="{{ asset('images/canceled.png') }}" alt="zápas odložený" title="zápas odložený" style="height:1.2em"/></span>
            @endif
            </td>
            <td>{{ date("d.m.Y H:i", strtotime($match->match_datetime)) }}</a></td>
            <td>
                <form action="{{ route('matchs.setResult', ['match_id'=>$match->id]) }}" method="POST">
                    @csrf
                    @method('put')
                    <input type="text" name="result" value="{{ $match->result }}" maxlength="5" style="width:3em">
                    <button class="btn btn-sm btn-primary">uložiť</button>
                </form>
            </td>
            <td style="text-align: center"><a href="{{ route('matchs.edit', ['match_id'=>$match->id]) }}"> edit </a>
                @if($team->id==1)
                    | <a href="{{ route('admin.playerstatistic', ['match_id'=>$match->id]) }}/active"> statistic </a>
                @endif
            </td>
          </tr> 
        @endforeach
        </tbody>
</table>
{{ ($matchs->count()==0) ? '<span style="color:red">Zatiaľ nie sú pridané žiadne zápasy.</span>' : '' }}
<hr>
<h4>Súhrn:</h4>
<span>Počet zápasov: <strong>{{ $matchs->count() }}</strong></span>


<script type="application/javascript">
    $('form[id=redform]').on('keyup change paste', 'input, select, textarea', function(){
        var team_id = $("input[type=radio][name=sel_team]:checked").val();
        var season_id = $("#sel_season option:selected").val();
        var base_url = <?= json_encode(url('admin/zapas/adminList')) ?>+ "/" + team_id +"/"+season_id;
        window.location.href = base_url;
    });
</script>
@endsection
