<article>
    <h1>{{ $article->title }}</h1>
    <div>
        @if(strlen($article->text)>$article->num_views && $article->num_views!=-1)
            <?php 
            $article->text = strip_tags($article->text, '<h1><h2><h3><h4>');
        ?>
            <?php $article->num_views = $article->num_views>0 ? $article->num_views : 1000 ?>
            {!! nl2br(substr($article->text, 0, $article->num_views)) !!}...
            <br clear="all">
    <p style="text-align: right; margin: 10px 10px 0px 0px; font-style: italic; font-size:0.85em">
            <a href="{{ route('article.show', ['article_slug'=>$article->slug]) }}" style="font-size: small">...zobrazť celý článok...</a>
                        </p>
        @else
            {!! $article->text !!}
            <br clear="all">
            <p style="text-align: right; margin: 10px 10px 0px 0px; font-style: italic; font-size:0.85em">
                <span><a href="{{ route('article.show', ['article_slug'=>$article->slug]) }}"> ...zobraziť článok...</a></span>
            </p>
        @endif
        <p style="text-align: left; margin: 10px 10px 0px 0px; font-style: italic; font-size:0.85em">
            <img src="{{ asset('images/tag.png') }}" title="tagy" alt="tagy" style="height:1.2em"/>
            {!! $article->getTagsLinks() !!}
        </p>
        <p style="text-align: right; margin: 10px 10px 0px 0px; font-style: italic; font-size:0.8em" class="text-muted">
            <span>vložil: {{ $article->user()->name }}</span>
            <span> | </span>
            <span>publikované: <time>{{ date("d.m.Y", strtotime($article->pubDate())) }}</time></span>
        </p>
    </div>
    </article>