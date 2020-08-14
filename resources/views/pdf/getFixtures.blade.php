<?php
    if(!empty($rozmer) && $rozmer=="velky"){
        $font_size=16;
        $sirka_1=240;
        $sirka_2=105;
        $sirka_3=30;
        $nastrane=2;
    }else{
        $font_size=12;
        $sirka_1=160;
        $sirka_2=95;
        $sirka_3=30;
        $nastrane=3;
    }
	$font_size = $res_col ? $font_size : 13;
?>

<!doctype html>
<html lang="sk" style="margin: 10px 20px 10px 20px; text-align: center; vertical-align: middle">
<head>
  <meta charset="utf-8">
  <title>TJ Družstevník Špačince - rozlosovanie</title>
       <style>
					body {
							font-family: DejaVu Sans, sans-serif;
                font-size: <?=$font_size?>px;
                width: 100%;
                margin: 0 auto;
							}     
        table{
            border-collapse: collapse;
						margin:0;
        }
        td{
            margin: 0;
            padding: 0px 2px 0px 2px;
            border: 1px solid black;
        }
        tr{
            margin: 0px 0px 0px 0px;
            padding: 0px;
        }
        thead{
            font-weight: bold;
        }
        
        .page_break { page-break-before: always; }

    </style>
</head>
<body>
    @for ($i = 0; $i < 3; $i++)
    <table style="text-align: center; margin: 0px auto; border: 2px solid black; position:absolute; top: <?= ($i*33)?>%">
        <tr>
            <td style="vertical-align: top; padding: 0px;">
              <table>
                    <thead>
                        <tr>
                            <td style="width: <?= $sirka_1  ?>px; text-align:center">
                                <div>{{ $teams[0]->name }}</div>
                                <div>{{ $season->name.' - '.$whenString }}</div>
							</td>
                            <td style="width: <?= $sirka_2 ?>px">Kedy:</td>
							@if($res_col)
                            	<td style="width: <?= $sirka_3 ?>px">Výs.:</td>
							@endif
                        </tr>
                    </thead>
                        @foreach($matchs[0] as $match)
                        <tr>
                            <td>
                                {{ $match->shortMatch }}
                            </td>
                            <td>{{ date("d.m.Y H:i", strtotime($match->match_datetime)) }}</td>
								@if($res_col)
                            	    <td style="text-align:center;"><?= $match->result ?? '' ?></td>  
							    @endif
                        </tr>  
                        @endforeach
            </table>  
            </td>
            <td style="vertical-align: top; margin: 0px; padding: 0px;">
              <table>
                    <thead>
                        <tr>
                            <td style="width: <?= $sirka_1 ?>px; text-align:center">
															<div>{{ $teams[1]->name }}</div>
															<div>{{ $season->name.' - '.$whenString }}</div>
														</td>
                            <td style="width: <?= $sirka_2 ?>px">Kedy:</td>
                                @if($res_col)
                                    <td style="width: <?= $sirka_3 ?>px">Výs.:</td>  
                                @endif
                        </tr>
                    </thead>
                        @foreach($matchs[1] as $match)
                        <tr>
                            <td>
                                {{ $match->shortMatch }}
                            </td>
                            <td>{{ date("d.m.Y H:i", strtotime($match->match_datetime)) }}</td>
							    @if($res_col)
                            	    <td style="text-align:center;"><?= $match->result ?? '' ?></td>  
							    @endif
                        </tr>  
                        @endforeach
            </table>      
            <p style="margin:0px; padding:0px 0px 0px 0px;">Termíny zápasov sa môžu počas sezóny zmeniť.</p>
            </td>      
        </tr>      
    </table>
    <br/>
    @endfor
<div class="page_break"></div>
    @for ($i = 0; $i < 3; $i++)
    <table style="text-align: center; margin: 0px auto; border: 2px solid black; position:absolute; top: <?= ($i*33) ?>%";>
        <tr>
            <td style="vertical-align: top; padding: 0px;">
              <table>
                    <thead>
                        <tr>
                            <td style="width: <?= $sirka_1  ?>px; text-align:center">
															<div>{{ $teams[2]->name }}</div>
															<div>{{ $season->name.' - '.$whenString }}</div>
														</td>
                            <td style="width: <?= $sirka_2 ?>px">Kedy:</td>
							@if($res_col)
                            	<td style="width: <?= $sirka_3 ?>px">Výs.:</td>
							@endif
                        </tr>
                    </thead>
                        @foreach($matchs[2] as $match)
                        <tr>
                            <td>
                                {{ $match->shortMatch }}
                            </td>
                            <td>{{ date("d.m.Y H:i", strtotime($match->match_datetime)) }}</td>
							    @if($res_col)
                            	    <td style="text-align:center;"><?= $match->result ?? '' ?></td> 
							    @endif
                        </tr>  
                        @endforeach
            </table>  
            </td>
            <td style="vertical-align: top; margin: 0px; padding: 0px;">
              <table>
                    <thead>
                        <tr>
                            <td style="width: <?= $sirka_1  ?>px; text-align:center">
                                <div>{{ $teams[3]->name }}</div>
                                <div>{{ $season->name.' - '.$whenString }}</div>
							</td>
                            <td style="width: <?= $sirka_2 ?>px">Kedy:</td>
							    @if($res_col)
                            	    <td style="width: <?= $sirka_3 ?>px">Výs.:</td>
							    @endif
                        </tr>
                    </thead>
                        @foreach($matchs[3] as $match)
                        <tr>
                            <td>
                                {{ $match->shortMatch }}
                            </td>
                            <td>{{ date("d.m.Y H:i", strtotime($match->match_datetime)) }}</td>
							@if($res_col)
                            	<td style="text-align:center;"><?= $match->result ?? '' ?></td> 
							@endif
                        </tr>  
                        @endforeach
            </table>      
            <p style="margin:0px; padding:0px 0px 0px 0px;">Termíny zápasov sa môžu počas sezóny zmeniť.</p>
            </td>      
        </tr>      
    </table>
    <br/>
    @endfor
</body>
</html>
