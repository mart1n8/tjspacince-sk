<!doctype html>
<html lang="sk" style="margin: 20px 20px 20px 40px; text-align: center;">
<head>
  <meta charset="utf-8">
  <title>TJ Družstevník Špačince - lístky na zápas dňa <?= date("d.m.Y", strtotime($match->match_datetime))?></title>
  <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
    <style>
            body {
                font-family: DejaVu Sans, sans-serif;
                text-align:center;
            }
            table{
                border: none;
                border-collapse: collapse;
                padding: 0;
                margin: 0;
            }
            tr{
                border: 1px solid black;
                margin:0px;
            }
            td{
                vertical-aling:middle;
                border: 1px solid black;
                height:100px;
                margin:0px;
            }
            p{
                margin-top: 0px;
                margin-bottom: 0px;
                padding-top: 0px;
                padding-bottom: 0px;
            }
            .page-break {
                page-break-after: always;
            }

            .lokno{
                width: 100px;
                font-size:40px;
                text-align:center;
            }
            .pokno{
                width: 550px;
                vertical-align:top;
                background: url(/resources/images/logo_listky_small.png) left;
                background-repeat: no-repeat;
            }
            .info1{
                font-size:16px;
                text-align:center;
            }
            .info2{
                font-size:16px;
            }
            .zapas{
                font-size:25px;
                font-weight:bold;
                text-align:center;
            }
            .hrube{
                font-weight:bold;
            }
    </style>
</head>
<body>
<?php 
$sekcia=0;
$pages=$count/10;
for ($s = 1; $s <= $pages; $s++) {
	echo '<table>';
		$k=$s-($sekcia*5)+($sekcia*50);
		for ($i = 0; $i <= 9; $i++) {
		?>
		<tr>
                    <td style="min-width:70px; text-align:center;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>|<br>|</td>
                    <td class="lokno"><?= $k+($i*5) ?></td>
                    <td class="pokno">
                    <p class="info1"><?= $sutaz ?> - <?= $round.'. kolo' ?> | <?= date("d.m.Y", strtotime($match->match_datetime))?><?= ($type==1) ? ' | dôchodcovský lístok' : ''?></p>
                    <p class="zapas"><?= $match->shortMatch ?></p>
                    <p class="info2" style="padding-left:50px">Číslo lístka: <span class="hrube"><?= $k+($i*5) ?></span><span style="position:relative; margin-left: 230px;">Cena: <span class="hrube"><?= $price;?> &euro;</span></span></p>
                    </td>
		</tr>
		
		<?php
		if(($k+($i*5))%50==0) $sekcia+=1;
		}
            echo '</table>';
            if ($s<>$pages) {
                echo '<div class="page-break"></div>';
            }
	} 
?>
</body>
</html>
