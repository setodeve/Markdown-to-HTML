<?php
spl_autoload_extensions(".php"); 
spl_autoload_register();
require_once 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $input = file_get_contents('php://input');
  $array = json_decode($input, true);
  $Parsedown = new Parsedown();

  if($array["type"]=="preview" || $array["type"]=="download"){
    echo $Parsedown->text($array["textData"]);
  }elseif($array["type"]=="html"){
    echo $Parsedown->setMarkupEscaped(true)->setBreaksEnabled(true)->text($Parsedown->text($array["textData"]));
  }
}
?>