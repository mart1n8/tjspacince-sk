@extends('layouts.app')
@section('title', 'správy pre administrátora')
@section('content')

<h1>Správy pre administrátora:</h1>
    <div class="row">
        <div class="col-12">
        <table class="table table-separed">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">date:</th>
                    <th scope="col">email:</th>
                    <th scope="col">správa:</th>
                    <th scope="col"><img src="{{ asset('images/eye.png') }}" class="img-responsive" style="height: 1em;" title="správa zobrazená"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($messages as $message)
                  <tr>
                    <td scope="row">{{ $message->id }}</td>
                    <td scope="row">{{ date("d.m.Y", strtotime($message->created_at)) }}</td>
                    <td scope="row">{{ $message->email }}</td>
                    <td scope="row">
                        <a href="{{ route('admin.kontakt-admin.showDetail', ['msgID'=>$message->id]) }}">
                            {{ substr($message->message, 0, 50) }}...
                        </a>
                    </td>
                    <td scope="row"><img src="<?= $message->read==0 ? asset('images/NO.png') : asset('images/OK.png') ?>" class="img-responsive" style="height: 1em;" title="<?= $message->read==0 ? 'správa nezobrazená' : 'správa zobrazená' ?>"></td>
                  </tr> 
                @endforeach
            </tbody>
        </table> 
            
        <div class="center-block"><?= $messages->links() ?></div>
        </div>
    </div>
@endsection