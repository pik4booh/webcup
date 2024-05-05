<?php 
include('function.php');
$text = $_POST['text'];
$array = generatePouvoire($text);
var_dump($array);
?>