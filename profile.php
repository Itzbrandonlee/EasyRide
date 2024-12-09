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
} else{
    header('Location: logout.php');
    exit;
}

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
<body>
	<h2>Easy Ride</h2>
    <div class="profile_container">
        <div class="inner_profile">
            <h1><?php echo  $user_data->customer_fname." ".$user_data->customer_lname;?></h1>
        </div>
        <nav>
            <ul>
                <li><a href="profile.php" rel="noopener noreferrer" class="active">Home</a></li>
                <li><a href="mybookings.php" rel="noopener noreferrer">Bookings</a></li>
                <li><a href="profile.php" rel="noopener noreferrer">Rental History</a></li>
                <li><a href="logout.php" rel="noopener noreferrer">Logout</a></li>
            </ul>
        </nav>
        <div class="search">
            <form action="" method="GET" class="search">
            <h2>Search Vehicles</h2>
            <select name="branch" id="branch" required>
                <option value="">--Select a Branch--</option>
                    <?php foreach ($all_branches as $branch): ?>
                <option value="<?= htmlspecialchars($branch->branch_id); ?>">
                    <?= htmlspecialchars($branch->branch_name); ?>
            </option>
            <?php endforeach; ?>
            </select>
            <input type="date" id="pickup" name="pickup" placeholder="Enter Pickup Date" required>
            <input type="date" id="dropoff" name="dropoff" placeholder="Enter Dropoff Date" required>
            <input type="submit" value="Search">
            </form>
        </div>

        <div class="search_vehicles">
            <h3>Available Vehicles</h3>
            <div class="usersWrapper">
            <?php
                if(!empty($search_vehicles)){
                    foreach($search_vehicles as $row){
                        echo '<div class="vehicle_box">
                                <div class="vehicle_info"><span>Manufacturer: '.$row->manufacturer.'</span>
                                <div class="vehicle_info"><span>Car Name: '.$row->c_name.'</span>
                                <div class="vehicle_info"><span>Type: '.$row->car_type_name.'</span>
                                <div class="vehicle_info"><span>Model Year: '.$row->model_year.'</span>
                                <div class="vehicle_info"><span>Seat Capacity: '.$row->seat_capacity.'</span>
                                <div class="vehicle_info"><span>Mileage: '.$row->mileage.'</span>
                                <div class="vehicle_info"><span>Rate: '.$row->rate.'</span>
                                <div class="vehicle_info"><span>Fuel Type: '.$row->fuel_type_name.'</span>
                                <div class="vehicle_info"><span>Description: '.$row->description.'</span>
                                <div class="vehicle_info"><span>Color: '.$row->color.'</span>
                                <span><a href="vehicle_profile.php?id='.$row->registration_num.'" class="see_profileBtn">See vehicle</a></div>
                                <br></br>
                            </div>';
                    }
                }
                else{
                    echo '<h4>There are no available vehicles!</h4>';
                }
                ?>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
