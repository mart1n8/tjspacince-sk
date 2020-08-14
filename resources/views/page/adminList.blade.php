@extends('layouts.app')

@section('content')
<div style="float:right; margin-right: 20px">
    <a href="{{ route('page.create') }}"> <- pridať stránku</a>
</div>
<h1>Stránky: </h1>
    <table class="table table-sm">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">title</th>
            <th scope="col">slug:</th>
            <th scope="col">description:</th>
            <th scope="col">edit</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($pages as $page)
          <tr>
            <th scope="row"><?= $page->id ?></th>
            <td><a href="{{ route('page.show', ['page_slug'=>$page->slug]) }}"><?= $page->title ?></a></td>
            <td><?= $page->slug ?></td>
            <td><?= $page->description ?></td>
            <td><a href='/stranka/<?= $page->id ?>/upravit'> upraviť </a></td>
          </tr> 
        @endforeach
        </tbody>
</table>
<?= ($pages->count()==0) ? '<span style="color:red">Zatiaľ nie sú pridané žiadne stránky.</span>' : '' ?>
<div class="center-block"><?= $pages->links() ?></div>
@endsection
