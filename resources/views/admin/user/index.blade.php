@extends('layouts.app')
@section('title', 'užívatelia')
@section('content')
<h2>Užívatelia:</h2>
<table>
    <thead>
        <tr>
            <th>#</th>
            <th>name:</th>
            <th>email:</th>
            <th>role:</th>
            <th>delete:</th>
        </tr>
    </thead>
    @foreach($users as $user)
       <tr>
            <td style="padding-right:20px">{{ $user->id }}</td>
            <td style="padding-right:20px">{{ $user->name }}</td>
            <td style="padding-right:20px">{{ $user->email }}</td>
            <td style="padding-right:20px">{{ $user->roles }}</td>
            <td style="padding-right:20px">
                <form action="{{ route('admin.user.delete', ['user_id'=>$user->id]) }}" method="POST">
                    @csrf
                    @method('delete')
                    <button class="btn btn-sm btn-danger"  onclick="if (! confirm('Skutočne schcete vymazať tohto užívateľa?')) { return false; }">vymazať</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>
<div class="center-block"><?= $users->links() ?></div>
@endsection
