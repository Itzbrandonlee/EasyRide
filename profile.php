<?php
require 'includes/init.php';
if(isset($_SESSION['customer_id']) && isset($_SESSION['email'])){
    $user_data = $user_obj->find_user_by_id($_SESSION['customer_id']);
    if($user_data ===  false){
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
$search_vehicles = null;
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['branch']) && isset($_GET['pickup']) && isset($_GET['dropoff'])) {
        $branch_id = intval($_GET['branch']);
        $start_date = $_GET['pickup']; 
        $end_date = $_GET['dropoff'];
        $search_vehicles = $vehicle_obj->search_vehicle($branch_id, $start_date, $end_date);
    }
}

$all_branches = $branch_obj->get_all_branches();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo  $user_data->username;?></title>
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
                    <li class="nav-item"><a href="profile.php" rel="noopener noreferrer" class="nav-link active">Home</a></li>
                    <li class="nav-item"><a href="mybookings.php" rel="noopener noreferrer" class="nav-link">Bookings</a></li>
                    <li class="nav-item"><a href="logout.php" rel="noopener noreferrer" class="nav-link">Logout</a></li>
                </ul>
                <span class="employee-name">
                <?php echo  $user_data->customer_fname." ".$user_data->customer_lname;?>
            </span>
            </div>
        </div>
    </nav>
    <div class="container px-4 py-4">
            <div class="row mb-4">
                <div class="col-12">
                    <h1 class="h3">Search Available Vehicles</h1>
                </div>
                <div class="container mt-4">
    <div class="row justify-content-start">
        <div class="col-md-12">
            <div class="card p-3">
                <form action="" method="GET" class="search">
                    <h4 class="text-center mb-4">Search Vehicles</h4>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="me-3 w-100">
                            <select name="branch" id="branch" class="form-select" required>
                                <option value="">--Select a Branch--</option>
                                <?php foreach ($all_branches as $branch): ?>
                                    <option value="<?= htmlspecialchars($branch->branch_id); ?>">
                                        <?= htmlspecialchars($branch->branch_name); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="me-3 w-100">
                            <input type="date" id="pickup" name="pickup" class="form-control" required>
                        </div>
                        <div class="me-3 w-100">
                            <input type="date" id="dropoff" name="dropoff" class="form-control" required>
                        </div>
                        <div class="ms-3">
                            <input type="submit" class="btn btn-primary" value="Search">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

        <div class="mt-4 ">
            <div class="col-12">
                <h1 class="h3">All Vehicles</h1>
            </div>
            <div class="usersWrapper">
                <?php
                if($search_vehicles){
                    foreach($search_vehicles as $row){
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
                                    <a href="vehicle_profile.php?id=' . htmlspecialchars($row->registration_num) . '" class="btn btn-primary btn-sm">Book Vehicle</a>
                                </div>
                            </div>
                        </div>
                    </div>';
                    }
                }
                else{
                    echo '<div class="alert alert-info mt-4">There are no vehicles! Please search again. </div>';
                }
                ?>
            </div>
        </div>
        
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>