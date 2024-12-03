<?php
session_start();
session_regenerate_id(true);

require 'classes/database.php';
require 'classes/user.php';
require 'classes/vehicle.php';

// DATABASE CONNECTIONS
$db_obj = new Database();
$db_connection = $db_obj->dbConnection();

// USER OBJECT
$user_obj = new User($db_connection);
$vehicle_obj = new Vehicle($db_connection);