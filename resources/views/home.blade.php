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
                    <span style="font-size: 22px; font-weight: bold">{{ $team->lastMatch()->getShortMatch() }}</span><br/>
                    <span style="font-size: 40px; font-weight: bold">
                      @if($team->lastMatch()->result=="odl.p")
                          <span style="font-size: 14px;">zápas odložený pre nepriaznivé počasie</span>
                      @elseif($team->lastMatch()->result=="odl.d")
                          <span style="font-size: 14px;">zápas odložený po dohode klubov</span>
                      @else
                          {{ $team->lastMatch()->result }}  
                      @endif
                    </span>
                    @if(($team->id==1)  && !empty($team->lastMatch()->statistics()))
                    <br/>
                        <a href="{{ route('matchs.show', ['match_slug'=>$team->lastMatch()->slug]) }}">
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
                        <span style="font-size: 22px; font-weight: bold">{{ $team->nextMatch()->getShortMatch() }}</span><br/>
                        <span style="font-size: 20px; font-style: italic;">
                            <?php
                                $match_datetime = date("Y-m-d", strtotime($team->nextMatch()->match_datetime));
                                if($match_datetime==Date("Y-m-d")){
                                    echo 'dnes o '.date("H:i", strtotime($team->nextMatch()->match_datetime)).' hod.';
                                }else{
                                    echo $team->nextMatch()->getMatchDateString();
                                }
                            ?>
                        </span>
                        @if($team->nextMatch()->is_bus==1)
                            <br/>
                            <span style="font-size: 18px; font-style: italic;">odchod autobusu o {{ $team->nextMatch()->busTime() }} hod.</span>
                        @endif
                        @if(!empty($team->nextMatch()->short_info))
                            <br/>
                            <span style="font-size: 14px; font-style: italic;">{{ $team->nextMatch()->short_info }}</span>
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
    <article>
        <h1>{{ $article->title }}</h1>
        <div>
            @if(strlen($article->text)>$article->num_views && $article->num_views!=-1)
                <?php 
                $article->text = strip_tags($article->text);
            ?>
                {{ substr($article->text, 0, $article->num_views) }}...
                <a href="{{ route('article.show', ['article_slug'=>$article->slug]) }}" style="font-size: small"> zobrazť celý článok</a>
            @else
                {!! $article->text !!}
                <p style="text-align: right; margin: 10px 10px 0px 0px; font-style: italic">
                    <span><a href="{{ route('article.show', ['article_slug'=>$article->slug]) }}"> ...zobraziť...</a></span>
                </p>
            @endif
            <p style="text-align: left; margin: 10px 10px 0px 0px; font-style: italic">
                <img src="{{ asset('images/tag.png') }}" title="tagy" alt="tagy" style="height:1.2em"/>{!! $article->getTagsLinks() !!}                
            </p>
            <p style="text-align: right; margin: 10px 10px 0px 0px; font-style: italic">
                <span>vložil: {{ $article->user()->name }}</span>
                <span> | </span>
                <span>publikované: {{ date("d.m.Y", strtotime($article->pubDate())) }}</span>
            </p>
        </div>
    </article>
   @else
    <p style="font-size: 1.5em; color:blue; text-align: center">Zatiaľ sme nepublikovali žiadny článok ani iný príspevok.</p>
   @endif
</div>
@endsection
