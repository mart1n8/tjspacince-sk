@extends('layouts.app')
@section('title', 'hráči')
@section('content')


<div class="row">
    <div class="col-7">
        <h1>Súpiska: </h1>
        <table style="margin-top: 15px">
            <thead>
                <tr style="text-decoration: underline">
                    <th scope="col" style="padding-right: 40px">hráč: </td>
                    <th scope="col" style="text-align: center; width: 50px"><img src="{{ asset('images/player.png') }}" class="img-responsive" style="height: 1.7em;" title="počet odohraných zápasov"></th>
                    <th scope="col" style="text-align: center; width: 50px"><img src="{{ asset('images/ball_small.png') }}" class="img-responsive" style="height: 1.7em;" title="počet strelených gólov"></th>
                    <th scope="col" style="text-align: center; width: 50px"><img src="{{ asset('images/yellow_small.gif') }}" class="img-responsive" style="height: 1.7em;" title="počet žltých kariet"></th>
                    <th scope="col" style="text-align: center; width: 50px"><img src="{{ asset('images/red_small.gif') }}" class="img-responsive" style="height: 1.7em;" title="počet červených kariet"></th>
                </tr>
            </thead>
                    <?php
                    $numGoals = 0;
                    $numYellows = 0;
                    $numRed = 0;
                    foreach($playerStats as $playerStat){
                        $numGoals = $numGoals + $playerStat->goals;
                        $numYellows = $numYellows + $playerStat->yellowCards;
                        $numRed = $numRed + $playerStat->redCards;
                    ?>
                    <tbody>
                      <tr>
                          <td style="padding-right: 40px" title="{{ $playerStat->player->getName() }}">{{ $playerStat->player->getName() }}</td>
                          <td style="text-align: center; width: 50px" title="{{ $playerStat->player->getName() }} sa zúčastnil {{ $playerStat->numMatchs }} zápasov">{{ $playerStat->numMatchs }}</td>
                          <td style="text-align: center; width: 50px" title="{{ $playerStat->player->getName() }} dal {{ $playerStat->goals }} gólov">{{ $playerStat->goals }}</td>
                          <td style="text-align: center; width: 50px" title="{{ $playerStat->player->getName() }} dostal {{ $playerStat->yellowCards }} žltých kariet">{{ $playerStat->yellowCards }}</td>
                          <td style="text-align: center; width: 50px" title="{{ $playerStat->player->getName() }} dostal {{ $playerStat->redCards }} červených kariet">{{ $playerStat->redCards }}</td>
                      </tr>
                    </tbody>
                    <?php
                    }
                    ?>
        </table>
    </div>
    <div class="col-5">
        <form>
            <div class="form-inline" style="float: right; margin-right: 10%">
                <div class="form-group">
                    <label style="font-weight: bold; margin-left: 30px; margin-right: 15px" >sezóna: </label>
                    <select name="sel_season" id="sel_season" class="form-control">
                        @foreach($seasons as $season_i)
                            <option value="{{ $season_i->slug }}" <?= $season->id==$season_i->id ? 'selected' : '' ?>>{{ $season_i->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </form>
        <h3>zhrnutie:</h3>
        <table>
            <tr><td>v sezóne {{ $season->name }} nastúpilo: <span style="font-weight: bold">{{ $playerStats->count() }} hráčov</span></td></tr>
            <tr><td>dali sme: <span style="font-weight: bold">{{ $numGoals }} gólov</span></td></tr>
            <tr><td>dostali sme: <span style="font-weight: bold">{{ $numYellows }} žltých kariet</span></td></tr>
            <tr><td>a dostali sme: <span style="font-weight: bold">{{ $numRed }} červených kariet</span></td></tr>
        </table>
    </div>
</div>

<script type="application/javascript">
    $('form').on('keyup change paste', 'input, select, textarea', function(){
        var season_id = $("#sel_season option:selected").val();
        var base_url = <?= json_encode(url('/hraci/')) ?> + "/"+season_id;
        window.location.href = base_url;
    });
</script>
@endsection
