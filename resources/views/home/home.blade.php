@extends('layouts.app')

@section('content')
<div style="text-align: center">
    @foreach($teams as $team)
        <div class="row table table-dark">
            <div class="col-12" style="font-weight: bold; text-transform: capitalize;">{{ $team->name }}</div>
        </div>
        <div class="row table table-light" style="vertical-align: top">
            <div class="col-6">
                @if($team->lastMatch())
                <div style="text-align: center;">
                    <span style="font-size: 1.5em; font-weight: bold">{{ $team->lastMatch()->shortMatch }}</span><br/>
                      @if($team->lastMatch()->result=="odl.p")
                          <span style="font-size: 1.4em;;">zápas odložený pre nepriaznivé počasie</span>
                      @elseif($team->lastMatch()->result=="odl.d")
                          <span style="font-size: 1.4em;">zápas odložený po dohode klubov</span>
                      @else
                           <span class="{{ $team->lastMatch()->resultColor }} font-weight-bold" style="font-size: 2.5em; ">{{ $team->lastMatch()->result }}</span>
                      @endif
                    @if(($team->id==1)  && !empty($team->lastMatch()->statistics()))
                    <br/>
                        <a href="{{ route('matchs.show', ['match'=>$team->lastMatch()->slug]) }}">
                            <img src="{{ asset('images/eye.png') }}" class="img-responsive" style="height: 32px;" title="góly"> zobraziť zápas
                        </a>
                    @endif
                </div>

                @else
                    <span>Tím neodohral žiadny zápas.</span>
                @endif
            </div>
            <div class="col-6" style="border-left: 1px solid black">
                 @if($team->nextMatch())
                    <div style="text-align: center;">
                        <span style="font-size: 1.5em; font-weight: bold">{{ $team->nextMatch()->shortMatch }}</span><br/>
                        <span style="font-size: 1.3em; font-style: italic;">
														<?= $team->nextMatch()->locked==1 ? '<s>' : '' ?>
                            <?php
                                $match_datetime = date("Y-m-d", strtotime($team->nextMatch()->match_datetime));
                                if($match_datetime==Date("Y-m-d")){
                                    echo 'dnes o '.date("H:i", strtotime($team->nextMatch()->match_datetime)).' hod.';
                                }else{
                                    echo $team->nextMatch()->matchDateString;
                                }
                            ?>
													<?= $team->nextMatch()->locked==1 ? '</s>' : '' ?>
                        </span>
                        @if($team->nextMatch()->is_bus==1 && $team->nextMatch()->home_away==1 && !$team->nextMatch()->locked==1)
                            <br/>
                            <span style="font-size: 1.3em; font-style: italic;">odchod autobusu o {{ $team->nextMatch()->busTime() }} hod.</span>
                        @endif
                        @if(!empty($team->nextMatch()->short_info))
                            <br/>
                            <span style="font-size: 1.25em; font-style: italic;">{{ $team->nextMatch()->short_info }}</span>
                        @endif
						@if($team->nextMatch()->locked==1)
								<br/>
								<span class="text-danger font-weight-bold">
									zápas odložený{{ !empty($team->nextMatch()->locked_reason) ? ':'.$team->nextMatch()->locked_reason : '' }}
								</span>
						@endif
				</div>
                @else
                    <span>Tím nemá naplánovaný žiadny zápas.</span>
                @endif
            </div>
        </div>
    @endforeach
</div>
<hr/>
<div>
   @if($article)
			@include('article._article', ['article'=>$article])
   @else
    <p style="font-size: 1.5em; font-style:italic; text-align: center">
			Zatiaľ sme nepublikovali žiadny článok ani iný príspevok.
		</p>
	  <p style="font-size: 1em; font-style:italic; text-align: center">
			(alebo admin vymazal databázu)<br>
			<img src="{{ asset('images/smajlik.png') }}" style="height:5em")>
		</p>
   @endif
</div>
@endsection
