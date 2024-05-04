<?php
Flight::register('database_connector', 'PDO', array('mysql:host=185.161.10.160;dbname=superdevy_power_switch','superdevy_root','ggpunish*xd'), function($database_connector) {
    $database_connector->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
});

$database_connector = Flight::database_connector();
?>