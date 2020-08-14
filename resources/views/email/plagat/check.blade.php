<h3>Víkendové zápasy: kontrola</h3>
<div>
    <table>
        <thead>
            <tr>
                <th>Team: </th>
                <th>Match: </th>
                <th>Date:</th>
                <th>Bus Info:</th>
            </tr>
        </thead>
    @foreach($matchs as $match)
        <tr>
            <td style="padding-right: 25px">{{ $match->team->name }}</td>
            <td style="padding-right: 25px">{{ $match->shortMatch }}</td>
            <td style="padding-right: 25px">{{ $match->matchDateString }}</td>
            <td style="padding-right: 25px"><?= $match->is_bus==1 ? $match->busTime() : '-' ?></td>
        </tr>
    @endforeach
    </table>
    <hr/>
    <div style="font-size: 1.8em; text-align: center"><a href="<?= url('plagat') ?>" target="_blank" >-- PLAGAT --</a></div>
</div>