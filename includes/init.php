<?php
session_start();
session_regenerate_id(true);

require 'classes/database.php';
require 'classes/user.php';
require 'classes/branch.php';
require 'classes/employee.php';

// DATABASE CONNECTIONS
$db_obj = new Database();
$db_connection = $db_obj->dbConnection();

// USER OBJECT
$user_obj = new User($db_connection);

// Employee Object 
$employee_obj = new Employee($db_connection);

// Branch Object
$branch_obj = new Branch($db_connection);