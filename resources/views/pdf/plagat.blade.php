<!doctype html>
<html lang="sk" style="margin: 10px 20px 10px 20px; text-align: center; vertical-align: middle">
<head>
  <meta charset="utf-8">
  <title>TJ Družstevník Špačince - plagát zo dňa <?= date("d.m.Y", strtotime($date))?></title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            text-align:center;
        }
        .intro{
            font-size: <?= 28 ?>px;
            line-height:30px;
            vertical-align:top;
            text-align:center;

        }
        .tim{
            font-size: <?= round($rating*30)?>px;
            margin: 0px;
            padding: 0px;
            text-transform: uppercase;
            font-style:italic;
        }
        .zapas{
            font-size: <?= round($rating*40)?>px;
            text-decoration: none;
            font-weight:bold;
            margin-top: 0px;
            padding-top:0px;
            text-transform: capitalize;
        }
        .info{
            font-size: 24px;
            margin-bottom: 10px;
        }
        .infoBus{
            font-size: 24px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <span style="position:absolute; top: 0px; left: 0%; width:12%; "><img src="<?= 'images/LOGO_TJ_small.png' ?>" style="width:100%;"></span>
    <span style="position:absolute; top: 0px; left: 90%; width:10%;"><img src="<?= 'images/logo_spacince_3.png' ?>" style="width:100%;"></span>
    <div style="text-align:center; width: 100%; margin: 0% 15% 2% 15%">
        <span class="intro">TJ Družstevník Špačince Vás pozýva na majstrovské futbalové zápasy</span>
    </div>
<div style="margin-bottom: 5em">&nbsp;</div>
     <?php 
          $i = $matchs->count()>1 ? 0 : 1; 
          $matchCount = $matchs->count()>1 ? $matchs->count() : 3;
      ?>
     <?php foreach($matchs as $match){ ?>
        <div style="position:absolute; top:<?= 12+((85/$matchCount)*$i) ?>%; width: 100%; margin-left:0% ?>">
          <?php if(!isset($prevTeam) or $prevTeam != $match->team->id) { ?>
          <span class="tim">
              <img src="<?= 'images/ball_small.png' ?>" style="width:25px; padding: 5px 5px 0px 0px"/>
                <?= $match->team->name ?>
              <img src="<?= 'images/ball_small.png' ?>" style="width:25px; padding: 5px 0px 0px 5px"/>

          </span><br>
          <?php }
          else{
          ?>
            <br>
          <?php
              }
          ?>
          <span class="zapas"><?= $match->shortMatch ?></span><br/>
          <span class="info"><?= $match->matchDateString ?></span>   
          <?php if($match->is_bus) { ?>
                <br/>
                <span class="infoBus">odchod autobusu o <?= $match->busTime() ?> z ihriska TJ</span>  
          <?php } ?>
        </div>
        <?php $prevTeam = $match->team->id ?>

        <?php 
          $i++;                         
          } 
        ?>      
    <?= count($matchs)==0 ? '<span style="font-size:32px; color:black">NA NAJBLIŽŠÍ TÝŽDEŇ<br/>NIE SÚ NAPLÁNOVANÉ ŽIADNE ZÁPASY</span>' : '' ?>  
  <span style="position:absolute; top: 730px; left: 800px;  color: lightgrey">webstránka: www.tjspacince.sk</span>

</body>
</html>
