@extends('layouts.app')
@section('title', $match->shortMatch.' '.date("d.m.Y", strtotime($match->match_datetime)))
@section('content')

<div style="text-align: center">
    <h1 style="text-align: center">{{ $match->shortMatch }}</h1>
    <span style="font-size: 50px" class="{{ $match->resultColor }} font-weight-bold">{{ $match->result }}</span>
</div>
<div class="row">
    <div class="col-6">
        <span style="font-weight: bold; font-size: 1.3em">
          <a href="{{ route('club.show', ['club'=>$match->club->slug]) }}">--- o klube {{  $match->club->short_name }} ---</a>
        </span>
        <hr/>
        <h3>Góly: </h3>
            @foreach($match->statistics as $stat)
                @if($stat->goal>0)
                <?= $stat->player->getName()  ?>
                    <?php
                        for($i=1; $i<=$stat->goal; $i++){
                            echo '<img src="'.asset('images/ball_small.png').'" class="img-responsive" style="height: 20px;" title="'.$stat->goal.'x gól">';
                        }
                    $isGoal=1;
                    ?>
                    <br/>
                @endif
            @endforeach
            @if(empty($isGoal))
                <span> --- žiadny gól sme nedali ---</span>
            @endif

        <hr/>
        <h3>Žlté karty: </h3>
            @foreach($match->statistics as $stat)
                @if($stat->yellowCard>0)
                    <?= $stat->player->getName()  ?> <img src="{{ asset('images/yellow_small.gif') }}" class="img-responsive" style="height: 20px;" title="žltá karta">
                    <?php $isYell=1; ?>
                    <br/>
                @endif
            @endforeach
            @if(empty($isYell))
                <span> --- žiadna žltá karta ---</span>
            @endif
        <hr/>
        <h3>Červené karty: </h3>
            @foreach($match->statistics as $stat)
                @if($stat->redCard>0)
                    <?= $stat->player->getName()  ?> <img src="{{ asset('images/red_small.gif') }}" class="img-responsive" style="height: 20px;" title="žltá karta">
                    <?php $isRed=1; ?>
                    <br/>
                @endif
            @endforeach
            @if(empty($isRed))
                <span> --- žiadna červená karta ---</span>
            @endif
    </div>
    <div class="col-6">
        <h3>Zostava: </h3>
        @foreach($match->statistics as $stat)
            <?= $stat->player->getName()  ?>
            @if($stat->yellowCard)
                <img src="{{ asset('images/yellow_small.gif') }}" class="img-responsive" style="height: 20px;" title="žltá karta">
            @endif
            @if($stat->redCard)
                <img src="{{ asset('images/red_small.gif') }}" class="img-responsive" style="height: 20px;" title="červená karta">
            @endif
            @if($stat->goal>0)
                <?php
                    for($i=1; $i<=$stat->goal; $i++){
                        echo '<img src="'.asset('images/ball_small.png').'" class="img-responsive" style="height: 20px;" title="'.$stat->goal.'x gól">';
                    }
                ?>
            @endif
            <br/>
        @endforeach
    </div>
</div>
@if(!empty($match->about))
<hr/><hr/>
    <h3>O zápase:</h3>
    <div class="row">
        <div class="col-12">
            {{ $match->about }}
        </div>
    </div>
@endif
@endsection
