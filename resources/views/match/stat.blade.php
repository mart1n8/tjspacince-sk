@extends('layouts.app')
@section('title', 'hráči')
@section('content')
<div style='text-align: right'>
    <a href="{{ route('matchs.show', ['slug'=>$match->slug]) }}">
        <img src="{{ asset('images/eye.png') }}" class="img-responsive" style="height: 32px;" title="góly">zobraziť zápas </a>
</div>
<div style="float: right">
    <form>
        <span style="margin-right: 20px">
            <input type="radio" name="ch_active" id="ch_act" <?= $act==1 ? 'checked' : '' ?> value="<?= url('/admin/statistikazapasu/'.$match->id.'/active') ?>">
            <label for="ch_act"> aktívny </label>
        </span>
        <span>
            <input type="radio" name="ch_active" id="ch_all" <?= $act==0 ? 'checked' : '' ?> value="<?= url('/admin/statistikazapasu/'.$match->id.'/all') ?>">
            <label for="ch_all"> všetci</label>
        </span>
    </form>
</div>
<h1>Hráči: </h1>
<form action="#" method="POST">
    @csrf
    @method('patch')
    <table class="table table-sm">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Player: </th>
            <th scope="col" style="text-align: center"><img src="{{ asset('images/yellow_small.gif') }}" class="img-responsive" style="height: 28px;" title="žlté karty"></th>
            <th scope="col" style="text-align: center"><img src="{{ asset('images/red_small.gif') }}" class="img-responsive" style="height: 28px;" title="červené karty"></th>
            <th scope="col" style="text-align: center"><img src="{{ asset('images/ball_small.png') }}" class="img-responsive" style="height: 28px;" title="góly"></th>
            <th scope="col" style="text-align: center"><img src="{{ asset('images/shirt.png') }}" class="img-responsive" style="height: 28px;" title="číslo dresu"></th>
            <th scope="col" style="text-align: center"><img src="{{ asset('images/field.png') }}" class="img-responsive" style="height: 28px;" title="bol v základnej zostave?"></th>
            <th scope="col" style="text-align: center"><img src="{{ asset('images/arrow_up.png') }}" class="img-responsive" style="height: 28px;" title="kedy išiel hrať"></th>
            <th scope="col" style="text-align: center"><img src="{{ asset('images/arrow_down.png') }}" class="img-responsive" style="height: 28px;" title="kedy išiel dole"></th>
          </tr>
        </thead>
        <tbody>
        @foreach ($players as $player)
          <?php
            $is_player=0;
            foreach ($match_stats as $match_stat){
                if ($match_stat->player_id==$player->id) {
                    $is_player = 1; 
                    $yellowCard = $match_stat->yellowCard;
                    $redCard = $match_stat->redCard;
                    $goal = $match_stat->goal;
                    $basicSquad = $match_stat->basicSquad;
                    $shirtNum = $match_stat->shirtNum;
                    $min_start = $match_stat->min_start;
                    $min_endup = $match_stat->min_endup;
                }
            }
          ?>
          <tr>
              <td scope="row"><?= $player->id ?></td>
              <td><input type="checkbox" name="is_player_{{$player->id}}" id="is_player_{{$player->id}}" <?= $is_player ? "checked='checked'" : "" ?>> <label for="is_player_{{$player->id}}"> {{ $player->getTurnName() }}</label></td>
              <td style="text-align: center"><input type="checkbox" name="yellowCard_{{$player->id}}" id="yellowCard_{{$player->id}}" <?= !empty($yellowCard) ? 'checked="checked"' :'' ?>/></td>
              <td style="text-align: center"><input type="checkbox" name="redCard_{{$player->id}}" id="redCard_{{$player->id}}" <?= !empty($redCard) ? 'checked="checked"' :'' ?>/></td>
              <td style="text-align: center"><input type="number" name="goal_{{$player->id}}" id="goal_{{$player->id}}" value="{{ $goal ?? 0}}" style="width:40px" maxlength="1"/></td>
              <td style="text-align: center"><input type="number" name="shirtNum_{{$player->id}}" id="shshirtNum_{{$player->id}}irtNum" value="{{ $shirtNum ?? 0}}" style="width:40px" maxlength="2"/></td>
              <td style="text-align: center"><input type="checkbox" name="basicSquad_{{$player->id}}" id="basicSquad_{{$player->id}}" <?= !empty($basicSquad) ? 'checked="checked"' :'' ?>/></td>
              <td style="text-align: center"><input type="number" name="min_start_{{$player->id}}" id="min_start_{{$player->id}}" value="{{ $min_start ?? 0}}" style="width:40px" maxlength="2"/></td>
              <td style="text-align: center"><input type="number" name="min_endup_{{$player->id}}" id="min_endup_{{$player->id}}" value="{{ $min_endup ?? 0}}" style="width:40px" maxlength="2"/></td>
           </tr>
            <?php unset($is_player, $yellowCard, $redCard, $goal, $basicSquad, $shirtNum, $min_start, $min_endup); ?>
        @endforeach
        </tbody>       
</table>
<button type="submit" class="btn btn-primary"> ULOŽIŤ </button>
</form>
        
<?= ($players->count()==0) ? '<span style="color:red">Zatiaľ nie sú pridaní žiadny hráči.</span>' : '' ?>
<script type="application/javascript">
    $(function() {
        $("input[name$='ch_active']").change(function() {
            window.location.href = this.value;
        });
    });
</script>

@endsection
