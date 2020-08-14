@extends('layouts.app')
@section('title', 'admin - sezóny')
@section('content')

<h1>Sezóny</h1>
    <div class="row">
        <div class="col-6">
        <table class="table table-sm">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">name:</th>
                <th scope="col">delete:</th>
                <th scope="col">active:</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($seasons as $season)
                  <tr>
                    <td scope="row"><?= $season->id ?></td>
                    <td>
                    <form action="{{ route('admin.seasons.edit', ['season_id'=>$season->id]) }}" method="POST">
                        @csrf
                        @method('patch')
                            <input name="name" value="{{ $season->name }}" size="10" maxlength="9"/>
                            <button class="btn btn-sm btn-primary"> uložiť </button>
                    </form>
                    </td>
                    <td>
                        <form action="{{ route('admin.seasons.delete', ['season_id'=>$season->id]) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button class="btn btn-sm btn-danger" onclick="if (! confirm('Skutočne schcete vymazať túto sezónu?')) { return false; }"> vymazať </button>
                        </form>
                    </td>
                    <td>
                        <form action="{{ route('admin.seasons.activation', ['season_id'=>$season->id]) }}" method="POST">
                            @csrf
                            @method('put')
                            <button class="btn btn-sm <?= $season->is_current==1 ? "btn-success" : "btn-secondary" ?>"><?= $season->is_current==1 ? "aktívna" : "neaktívna" ?></button>
                        </form>
                    </td>
                  </tr> 
                @endforeach
            </tbody>
        </table> 
  
        </div>  
        <div class="col-6">
            <h3>Pridať sezónu: </h3>
            <form action="" method="POST">
                @csrf
                @method('POST')
            <div class="form-group">
                <label for="name">Názov sezóny:</label>
                <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : ''}}" name="name" id="name" placeholder="názov sezóny" maxlength="9" value="{{ old('name') }}">
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