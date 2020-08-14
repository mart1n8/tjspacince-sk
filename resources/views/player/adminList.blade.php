@extends('layouts.app')
@section('title', 'hráči')
@section('content')
<div style="float: right">
    <form>
        <span style="margin-right: 20px">
            <input type="radio" name="ch_active" id="ch_act" <?= $act==1 ? 'checked' : '' ?> value="<?= url('/admin/hraci/active') ?>">
            <label for="ch_act"> aktívny </label>
        </span>
        <span>
            <input type="radio" name="ch_active" id="ch_all" <?= $act==0 ? 'checked' : '' ?> value="<?= url('/admin/hraci/all') ?>">
            <label for="ch_all"> všetci</label>
        </span>
    </form>
</div>
<h1>Hráči: </h1>
    <table class="table table-sm">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">name: </th>
            <th scope="col">ID na fn:</th>
            <th scope="col">aktívny:</th>
            <th scope="col" title="photo">PH</th>
            <th scope="col" title="birth date">BD</th>
            <th scope="col">edit</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($players as $player)
          <tr>
            <th scope="row"><?= $player->id ?></th>
            <td><a href="{{ route('player.show', ['player_id'=>$player->id]) }}"><?= $player->getTurnName() ?></a></td>
            <td><a href="https://futbalnet.sk/member/{{ $player->fn_id }}?#player" target="_blank"><?= $player->fn_id ?></a></td>
            <td>
                <form method="POST" action="{{ route('player.switchactive', ['player_id'=>$player->id]) }}">
                    @csrf
                    @method('put')
                    @if(empty($player->is_active))
                    <button name="activate" class="btn btn-sm btn-secondary"> neaktívny </button>
                    @else
                        <button name="deative" class="btn btn-sm btn-success"> neaktívny </button>
                    @endif
                </form>
            </td>
            <td  title='photo'><img src="<?= !empty($player->photo) ? asset('images/OK.png') : asset('images/NO.png') ?>" style="max-width:15px; max-height: 15px;"></td>
            <td  title='birth date'><img src="<?= !empty($player->birth_date) ? asset('images/OK.png') : asset('images/NO.png') ?>" style="max-width:15px; max-height: 15px;"></td>
            <td><a href="{{ route('player.edit', ['player_id'=>$player->id]) }}"> upraviť </a></td>
          </tr> 
        @endforeach
        </tbody>
</table>
<?= ($players->count()==0) ? '<span style="color:red">Zatiaľ nie sú pridaní žiadny hráči.</span>' : '' ?>
<div class="center-block"><?= $players->links() ?></div>

<script>
    $(function() {
        $("input[name$='ch_active']").change(function() {
            window.location.href = this.value;
        });
    });
</script>

@endsection
