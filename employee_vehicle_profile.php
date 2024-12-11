<?php
require 'includes/init.php';
$vehicle_data = $vehicle_obj->find_vehicle_by_id($_GET['id']);
$all_branches = $branch_obj->get_all_branches();

if($_SERVER['REQUEST_METHOD'] === 'POST'){
if(isset($_POST['btnDelete'])){
    echo '<script>console.log("Welcome to GeeksforGeeks!"); </script>'; 
    $vehicle_obj->deleteVehicle($vehicle_data->registration_num);
    header("Location: employee_vehicles.php");
  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo  $vehicle_data->c_name;?></title>
    <link rel="stylesheet" href="./style.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="profile_container">
        
        <div class="inner_profile">
            <div class="img">
                <!-- Insert picture here -->
            </div>
            <h1><?php echo  $vehicle_data->c_name;?></h1>
            <nav>
            <ul>
            <li><a href="employee_profile.php" rel="noopener noreferrer" class="active">Home</a></li>
                <li><a href="employee_vehicles.php" rel="noopener noreferrer">All Vehicles</a></li>
                <li><a href="stats.php" rel="noopener noreferrer">Stats</a></li>
                <li><a href="logout.php" rel="noopener noreferrer">Logout</a></li>
            </ul>
        </nav>
        <div class="background">
        <div class="booking-form">
            <h2>Actions</h2>
            <form method=POST>  
            <div class="vehicle_info"><span>Manufacturer: <?php echo $vehicle_data->manufacturer ?></span>
                                <div class="vehicle_info"><span>Car Name: <?php echo $vehicle_data->c_name ?></span>
                                <div class="vehicle_info"><span>Type: <?php echo $vehicle_data->car_type_name ?></span>
                                <div class="vehicle_info"><span>Model Year: <?php echo $vehicle_data->model_year ?></span>
                                <div class="vehicle_info"><span>Seat Capacity: <?php echo $vehicle_data->seat_capacity ?></span>
                                <div class="vehicle_info"><span>Mileage: <?php echo $vehicle_data->mileage ?></span>
                                <div class="vehicle_info"><span>Rate: <?php echo $vehicle_data->rate ?></span>
                                <div class="vehicle_info"><span>Fuel Type: <?php echo $vehicle_data->fuel_type_name ?></span>
                                <div class="vehicle_info"><span>Description: <?php echo $vehicle_data->description ?></span>
                                <div class="vehicle_info"><span>Color: <?php echo $vehicle_data->color ?></span>
                                <div class="vehicle_info"><span>Location: <?php echo $vehicle_data->branch_name ?></span>
                                <button type="submit" name="btnDelete" value="Delete">Delete</button>
                                <br></br>
            </form>
        </div>
    </div>
        </div>
     
        
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>