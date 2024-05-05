<?php 
include('index.php');
$text = $_GET['text'];
$array = generatePouvoire($text);
var_dump($array);
?>