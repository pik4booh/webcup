<?php
require 'flight/Flight.php';
require 'flight/autoload.php';
require 'module/fonction.php';
require 'module/connect.php';

Flight::route('/', function () {
    echo 'huhu world!';
});
Flight::route('/huhu', function () {
    findtest();
});
Flight::route('/insert/@test', function ($test) {
    inserttest($test);
});
Flight::map('error', function(Exception $ex){
    echo $ex->getMessage();
});

Flight::start();
