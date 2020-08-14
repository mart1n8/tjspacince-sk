@extends('layouts.app')

@section('content')
<h1>Kluby: </h1>
    <table class="table table-sm">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">name:</th>
            <th scope="col">city:</th>
            <th scope="col" title='short name'>SN:</th>
            <th scope="col" title='website'>WS:</th>
            <th scope="col" title='facebook site'>FS:</th>
            <th scope="col" title='logo'>L:</th>
            <th scope="col" title='gps of arena'>GPS:</th>
            <th scope="col">edit:</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($clubs as $club)
          <tr>
            <th scope="row">{{ $club->id }}</th>
            @if(!empty($club->slug))
                <td><a href="{{ route('club.show', ['club'=>$club->slug]) }}">{{ $club->name }}</a></td>
            @else
              {{ $club->name }}
            @endif
            <td>{{ $club->city }}</td>
            <td  title='short name'><img src="<?= !empty($club->short_name) ? asset('images/OK.png') : asset('images/NO.png') ?>" style="max-width:15px; max-height: 15px;"></td>
            <td title='website'><img src="<?= !empty($club->website) ? asset('images/OK.png') : asset('images/NO.png') ?>" style="max-width:15px; max-height: 15px"></td>
            <td title='facebook site'><img src="<?= !empty($club->fb_web) ? asset('images/OK.png') : asset('images/NO.png') ?>" style="max-width:15px; max-height: 15px"></td>
            <td title='logo'><img src="<?= !empty($club->emblem) ? asset('images/OK.png') : asset('images/NO.png') ?>" style="max-width:15px; max-height: 15px"></td>
            <td title='gps of arena'><img src="<?= !empty($club->arena_gps) ? asset('images/OK.png') : asset('images/NO.png') ?>" style="max-width:15px; max-height: 15px"></td>
            <td><a href="{{ route('club.edit', ['club_id'=>$club->id]) }}"> upraviť </a></td>
          </tr> 
        @endforeach
        </tbody>
</table>
<?= ($clubs->count()==0) ? '<span style="color:red">Zatiaľ nie sú pridané žiadne kluby.</span>' : '' ?>
<div class="text-center"><?= $clubs->links() ?></div>
@endsection
