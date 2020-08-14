@extends('layouts.app')
@section('title', 'správy pre administrátora')
@section('content')
<a href="{{ route('admin.kontakt-admin') }}"><<--- správy</a>
<h1>Správa:</h1>
    <div class="row">
        <div class="col-12">
            <table>
                <tr><td></td><td style="font-weight: bold">#{{ $message->id }}</td></tr>
                <tr><td style="font-weight: bold">Email: </td><td>{{ $message->email }}</td></tr>
                <tr><td style="font-weight: bold;margin-top:5px">Užívateľ: </td><td>
                        @if($user!=NULL)
                            <span>ID: {{$user->id }}</span> | 
                            <span>username: {{$user->name }}</span> | 
                            <span>email: {{$user->email }}</span>
                        @endif
                    </td>
                </tr>
                <tr><td style="font-weight: bold; vertical-align: top">Správa: </td><td>{{ $message->message }}</td></tr>
            </table>
            <form action="{{ route('admin.kontakt-admin.contactsReadSwitch', ['msgID'=>$message->id]) }}" method="POST">
                @method('POST')
                @csrf
                <br/>
                <button class="btn <?= $message->read==0 ? 'btn-success' : 'btn-info' ?>"><?= $message->read==0 ? 'označiť ako prečítané' : 'označiť ako neprečítané' ?></button>
            </form>
             <form action="{{ route('admin.kontakt-admin.contactsReadDel', ['msgID'=>$message->id]) }}"  method="POST">
                @method('delete')
                @csrf
                <br/>
                <button class="btn btn-danger" onclick="if (! confirm('Skutočne schcete vymazať túto správu?')) { return false; }">vymazať správu</button>
            </form>
        </div>
    </div>
@endsection
