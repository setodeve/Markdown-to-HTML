<?php
spl_autoload_extensions(".php"); 
spl_autoload_register();
require_once 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $input = file_get_contents('php://input');
  $array = json_decode($input, true);
  // $Parsedown = new Parsedown();
  $command = 'python3 test.py ';
  exec($command .escapeshellarg($input),$html);
  $html_str = "";

  if($array["type"]=="preview" || $array["type"]=="download"){
    // echo $Parsedown->text($array["textData"]);

    for($i = 0;$i < count($html);$i++){
      $html_str .= $html[$i]."\n";
    }
    echo $html_str;
  }elseif($array["type"]=="html"){
    $html_temp = str_replace("<", "&lt;", $html);
    $html_arr = str_replace(">", "&gt;", $html_temp);

    for($i = 0;$i < count($html_arr);$i++){                
        $html_str .= "<p>".$html_arr[$i]."</p>";
    }
    echo $html_str;
    // echo $Parsedown->setMarkupEscaped(true)->setBreaksEnabled(true)->text($Parsedown->text($array["textData"]));
  }
}
?>