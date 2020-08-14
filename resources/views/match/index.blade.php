@extends('layouts.app')

@section('title', 'zápasy '.$team->name)
@section('content')
<h1>Zápasy: <?= $team->name ?> sezóna <span id="season_name"></span></h1>
<form>
    <div class="form-inline">
        <div class="form-group">
            <label style="font-weight: bold; margin-left: 30px; margin-right: 15px" >Sezóna: </label>
            <select name="sel_season" id="sel_season" class="form-control">
                @foreach($seasons as $season_i)
                    <option value="{{ $season_i->slug }}" <?= $season_i->is_current==1 ? 'selected' : '' ?>>{{ $season_i->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
</form>
    <table class="table table-sm table-striped mt-2">
        <thead class="thead-dark">
          <tr>
            <th scope="col">kedy:</th>
            <th scope="col">zápas:</th>
            <th scope="col" style="text-align: center">výsledok:</th>
          </tr>
        </thead>
        <tbody id="body_table">

        </tbody>
</table>

<script type="application/javascript">
    window.onload = showMatchs;
    $('form').on('keyup change paste', 'input, select, textarea', showMatchs);

    function showMatchs(){
        var team_id = <?= $team->id  ?>;
        var season_id = document.getElementById('sel_season').value;
        var url = '/zapasy/'+ team_id +'/'+ season_id +'/json';
      console.log(url);
        var body = document.getElementById('body_table');
        $("#body_table").empty()
        $.ajax({
            type: 'GET',
            url: url, 
            dataType: 'json', // ** ensure you add this line **
            success: function(data) {
                $.each(data["matchs"], function(index, match) {
                    $('#season_name').html(data["season_name"])
                    $(addRow(match)).appendTo('#body_table');
                    $('#rowMatch_'+match.id).slideUp( 300 ).delay(800).fadeIn(400)
                });

            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                alert("some error");
            }
        });
    }

    function addRow(match="") {
        var content = '<tr id="rowMatch_'+match.id+'" style="display:none">';
        if(match.locked==1){
            content += '<td class="text-secondary" title="zápas odložený"><s>'+ match.matchDateString +'<s></td>';
        }else{
            content += '<td>'+ match.matchDateString +'</td>';
        }
        
      
      
        if(match.team_id==1 && match.result!=""){
            content += '<td><a href="/zapas/'+ match.slug +'" title="">'+ match.shortMatch +'</a></td>';
        }else{
            content += '<td>'+ match.shortMatch +'</td>';
        }
        content += '<td style="text-align:center" class="'+match.resultColor+'">'+ match.result +'</td>';
        content += '</tr>';
        return content
    }



</script>
@endsection
