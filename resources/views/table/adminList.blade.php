@extends('layouts.app')
@section('title', 'admin-tabuľky')
@section('content')
<div style='float:right'>
    <a href="{{ route('tables.create') }}"><-- pridať tabuľku</a>
</div>
<h1>Tabuľky: <?= $team->name ?></h1>
<form>
    <span style="font-weight: bold" >Tím: </span>
    @foreach($teams as $team_i)
        <span style="margin-left: 10px"><input type="radio" name="sel_team" id="sel_team_{{ $team_i->id }}" value="{{ $team_i->slug }}" <?= $team->id == $team_i->id ? 'checked="checked"' : '' ?>> <label for="sel_team_{{ $team_i->id }}"> {{ $team_i->name }}</label></span>
    @endforeach
</form>
    <table class="table table-sm">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">title:</th>
            <th scope="col">season:</th>
            <th scope="col">edit:</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($tables as $table)
          <tr>
            <th scope="row"><?= $table->id ?></th>
            <td><a href="{{ route('tables.show', ['team_slug'=>$team->slug, 'season_slug'=>$table->seas_slug]) }}">{{ $table->title }}</a></td>
            <td>{{ $table->name }}</td>
            <td><a href="{{ route('tables.edit', ['table_id'=>$table->id]) }}"> upraviť </a></td>
          </tr> 
        @endforeach
        </tbody>
</table>
<?= ($tables->count()==0) ? '<span style="color:red">Zatiaľ nie sú pridané žiadne tabuľky pre '.$team->name.'.</span>' : '' ?>

<script>
    $('form').on('keyup change paste', 'input, select, textarea', function(){
        var team_id = $("input[type=radio][name=sel_team]:checked").val();
        var base_url = <?= json_encode(url('admin/tabulka/adminList')) ?>+ "/" + team_id;
        window.location.href = base_url;
    });
</script>
@endsection
