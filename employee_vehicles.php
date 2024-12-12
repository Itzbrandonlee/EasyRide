
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo  $employee_data->employee_fname;?></title>
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
                    <h1 class="h3">All Vehicles</h1>
                </div>

            <div class="row g-4">
                <?php
                if($all_vehicles){
                    foreach($all_vehicles as $row){
                        echo '<div class="col-xl-4 col-md-6 col-sm-12">
                        <div class="card vehicle-card h-100">
                            <div class="card-body">
                                <h5 class="card-title">' . htmlspecialchars($row->manufacturer . ' ' . $row->c_name) . '</h5>
                                <div class="vehicle-details">
                                    <div class="detail-row">
                                        <span class="detail-label">Type:</span>
                                        <span class="detail-value">' . htmlspecialchars($row->car_type_name) . '</span>
                                    </div>
                                    <div class="detail-row">
                                        <span class="detail-label">Model Year:</span>
                                        <span class="detail-value">' . htmlspecialchars($row->model_year) . '</span>
                                    </div>
                                    <div class="detail-row">
                                        <span class="detail-label">Seat Capacity:</span>
                                        <span class="detail-value">' . htmlspecialchars($row->seat_capacity) . '</span>
                                    </div>
                                    <div class="detail-row">
                                        <span class="detail-label">Mileage:</span>
                                        <span class="detail-value">' . htmlspecialchars($row->mileage) . '</span>
                                    </div>
                                    <div class="detail-row">
                                        <span class="detail-label">Rate:</span>
                                        <span class="detail-value">$' . htmlspecialchars($row->rate) . ' / Day </span>
                                    </div>
                                    <div class="detail-row">
                                        <span class="detail-label">Fuel Type:</span>
                                        <span class="detail-value">' . htmlspecialchars($row->fuel_type_name) . '</span>
                                    </div>
                                    <div class="detail-row">
                                        <span class="detail-label">Color:</span>
                                        <span class="detail-value">' . htmlspecialchars($row->color) . '</span>
                                    </div>
                                    <div class="detail-row">
                                        <span class="detail-label">Location:</span>
                                        <span class="detail-value">' . htmlspecialchars($row->location) . '</span>
                                    </div>
                                </div>
                                <div class="card-footer mt-3 text-center">
                                    <a href="employee_vehicle_profile.php?id=' . htmlspecialchars($row->registration_num) . '" class="btn btn-primary btn-sm">View Details</a>
                                </div>
                            </div>
                        </div>
                    </div>';
                    }
                }
                else{
                    echo '<div class="alert alert-info">There is no vehicles in inventory!</4>';
                }
                ?>
            </div>
        </div>
        
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>