<?php
session_start();
session_regenerate_id(true);

require 'classes/database.php';
require 'classes/user.php';
require 'classes/vehicle.php';
require 'classes/branch.php';
require 'classes/employee.php';
require 'classes/booking.php';

// DATABASE CONNECTIONS
$db_obj = new Database();
$db_connection = $db_obj->dbConnection();

// USER OBJECT
$user_obj = new User($db_connection);

// Vehicle Object
$vehicle_obj = new Vehicle($db_connection);

// Employee object 
$employee_obj = new Employee($db_connection);

// Branch object
$branch_obj = new Branch($db_connection);

// Booking object
$booking_obj = new Booking($db_connection);

