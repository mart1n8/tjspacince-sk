@extends('layouts.app')

@section('content')
<h1>Články: </h1>
    <table class="table table-sm">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">title</th>
            <th scope="col">tags:</th>
            <th scope="col">edit</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($articles as $article)
          <tr>
            <th scope="row"><?= $article->id ?></th>
            <td><a href="{{ route('article.show', ['article_slug'=>$article->slug]) }}"><?= $article->title ?></a></td>
            <td><?= $article->tags ?></td>
            <td><a href='/clanok/<?= $article->id ?>/upravit'> upraviť </a></td>
          </tr> 
        @endforeach
        </tbody>
</table>
<?= ($articles->count()==0) ? '<span style="color:red">Zatiaľ nie sú pridané žiadne články.</span>' : '' ?>
<div class="center-block"><?= $articles->links() ?></div>
@endsection
