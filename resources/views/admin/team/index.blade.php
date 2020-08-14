@extends('layouts.app')
@section('title', 'admin - tímy')
@section('content')

<h1>Tímy</h1>
    <div class="row">
        <div class="col-8">
        <table class="table table-sm">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">name:</th>
                <th scope="col">orderNum:</th>
                <th scope="col">slug:</th>
                <th scope="col">delete:</th>
                <th scope="col">active:</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($teams as $team)
                  <tr>
                    <td scope="row"><?= $team->id ?></td>
                    <td>
                    <form action="{{ route('admin.teams.edit', ['team_id'=>$team->id]) }}" method="POST">
                        @csrf
                        @method('patch')
                            <input name="name" value="{{ $team->name }}" size="14" maxlength="15"/>
                        </td><td>
                            <input name="orderNum" value="{{ $team->orderNum }}" size="1" maxlength="2"/>
                            <button class="btn btn-sm btn-primary"> uložiť </button>
                    </form>
                    </td>
                    <td>{{ $team->slug }}</td>
                    <td>
                        <form action="{{ route('admin.teams.delete', ['team_id'=>$team->id]) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button class="btn btn-sm btn-danger" onclick="if (! confirm('Skutočne schcete vymazať túto sezónu?')) { return false; }"> vymazať </button>
                        </form>
                    </td>
                    <td>
                        <form action="{{ route('admin.teams.activation', ['team_id'=>$team->id]) }}" method="POST">
                            @csrf
                            @method('put')
                            <button class="btn btn-sm <?= $team->is_active==1 ? "btn-success" : "btn-secondary" ?>"><?= $team->is_active==1 ? "aktívna" : "neaktívna" ?></button>
                        </form>
                    </td>
                  </tr> 
                @endforeach
            </tbody>
        </table> 
  
        </div>  
        <div class="col-4">
            <h3>Pridať tím: </h3>
            <form action="" method="POST">
                @csrf
                @method('POST')
            <div class="form-group">
                <label for="name">Názov tímu:</label>
                <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : ''}}" name="name" id="name" placeholder="názov tímu" maxlength="9" value="{{ old('name') }}">
                @if ($errors->has('name'))
                    <span class="invalid-feedback">
                    <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
            <button name="submit" class="btn btn-primary"> Uložiť </button>
            </form>
        </div>
    </div>


@endsection