<?php 
include('index.php');
$text = $_POST['text'];
$array = generatePouvoire($text);
var_dump($array);
?>