<?php
require 'includes/init.php';
if(isset($_SESSION['employee_id']) && isset($_SESSION['email'])){
    $employee_data = $employee_obj->find_employee_by_id($_SESSION['employee_id']);
    if($employee_data ===  false){
        header('Location: logout.php');
        exit;
    }
    // FETCH ALL VEHICLES
    $all_vehicles = $vehicle_obj->all_vehicles();
}
else{
    header('Location: logout.php');
    exit;
}
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
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark nav-container">
        <div class="container">
            <a class="navbar-brand" href="#">Easy Ride</a>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a href="stats.php" rel="noopener noreferrer" class="nav-link">Dashboard</a></li>
                    <li class="nav-item"><a href="employee_vehicles.php" rel="noopener noreferrer" class="nav-link active">All Vehicles</a></li>
                    <li class="nav-item"><a href="employee_profile.php" rel="noopener noreferrer" class="nav-link">Bookings</a></li>
                    <li class="nav-item"><a href="logout.php" rel="noopener noreferrer" class="nav-link">Logout</a></li>
                </ul>
                <span class="employee-name">
                <?php echo  $employee_data->employee_fname." ".$employee_data->employee_lname;?>
            </span>
            </div>
        </div>
    </nav>
    <div class="container px-4 py-4">
            <div class="row mb-4">
                <div class="col-12">
                    <h1 class="h3">Actions</h1>
                </div>
                <div class="row g-4">
                    <form method=POST>
                        <div class="d-flex justify-content-center">  
                        <div class="col-xl-4 col-md-6 col-sm-12">
                            <div class="card vehicle-card h-100">
                                <div class="card-body">
                                <div class="img">
                                    <!-- Insert picture here -->
                                </div>
                                    <h5 class="card-title"><?php echo $vehicle_data->manufacturer.' '.$vehicle_data->c_name ?></h5>
                                        <div class="vehicle-details">
                                            <div class="detail-row">
                                                <span class="detail-label">Type:</span>
                                                <span class="detail-value"><?php echo $vehicle_data->car_type_name ?></span>
                                            </div>
                                            <div class="detail-row">
                                                <span class="detail-label">Model Year:</span>
                                                <span class="detail-value"><?php echo $vehicle_data->model_year ?></span>
                                            </div>
                                            <div class="detail-row">
                                                <span class="detail-label">Seat Capacity:</span>
                                                <span class="detail-value"><?php echo $vehicle_data->seat_capacity ?></span>
                                            </div>
                                            <div class="detail-row">
                                                <span class="detail-label">Mileage:</span>
                                                <span class="detail-value"><?php echo $vehicle_data->mileage ?></span>
                                            </div>
                                            <div class="detail-row">
                                                <span class="detail-label">Rate:</span>
                                                <span class="detail-value">$<?php echo $vehicle_data->rate ?> / Day</span>
                                            </div>
                                            <div class="detail-row">
                                                <span class="detail-label">Fuel Type:</span>
                                                <span class="detail-value"><?php echo $vehicle_data->fuel_type_name ?></span>
                                            </div>
                                            <div class="detail-row">
                                                <span class="detail-label">Color:</span>
                                                <span class="detail-value"><?php echo $vehicle_data->description ?></span>
                                            </div>
                                            <div class="detail-row">
                                                <span class="detail-label">Description:</span>
                                                <span class="detail-value"><?php echo $vehicle_data->color ?></span>
                                            </div>
                                            <div class="detail-row">
                                                <span class="detail-label">Location:</span>
                                                <span class="detail-value"> <?php echo $vehicle_data->branch_name ?></span>
                                            </div>
                                        </div>
                                        <div class="card-footer mt-3 text-center">
                                            <button type="submit" name="btnDelete" value="Delete" class="btn btn-primary btn-sm">Delete</button>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>   
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>