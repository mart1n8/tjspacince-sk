<div style="font-size: 0.8em">
<?php
    $table_file = "../uploads/table_atim.html";
    $table_f = fopen($table_file, "r") or die("Unable to open file!");
    if (filesize($table_file) != 0){
      $table = fread($table_f, filesize($table_file));
      fclose($table_f);

      echo '<span style="font-size: 1.5em; font-variant: small-caps; font-weight: bold">Tabuľka A tím</span><br/>';
      echo '<div class="mb-4">';
              echo $table;
      echo '</div>';
    }
?>
</div>
<div style="font-size: 0.8em">
<?php
    $table_file = "../uploads/table_dorast.html";
    $table_f = fopen($table_file, "r") or die("Unable to open file!");
    if (filesize($table_file) != 0){
      $table_dorast = fread($table_f, filesize($table_file));
      fclose($table_f);

      echo '<span style="font-size: 1.5em; font-variant: small-caps; font-weight: bold">Tabuľka Dorast</span><br/>';
      echo '<div class="mb-4">';
          echo $table_dorast;
      echo '</div>';    
    }
?>
</div>
<div style="font-size: 0.8em">
<?php
    $table_file = "../uploads/table_ziaci.html";
    $table_f = fopen($table_file, "r") or die("Unable to open file!");
    if (filesize($table_file) != 0){
      $table_z = fread($table_f, filesize($table_file));
      fclose($table_f);

      echo '<span style="font-size: 1.5em; font-variant: small-caps; font-weight: bold">Tabuľka Žiaci</span><br/>';
      echo '<div class="mb-4">';
          echo $table_z;
      echo '</div>';    
    }
?>
</div>
