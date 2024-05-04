<?php
Flight::register('database_connector', 'PDO', array('mysql:host=localhost;dbname=superdevy_power_switch','root',''), function($database_connector) {
    $database_connector->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
});

$database_connector = Flight::database_connector();
?>