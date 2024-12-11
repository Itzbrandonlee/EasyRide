<?php
require 'includes/init.php';
if(isset($_SESSION['employee_id']) && isset($_SESSION['email'])){
    $employee_data = $employee_obj->find_employee_by_id($_SESSION['employee_id']);
    if($employee_data ===  false){
        header('Location: logout.php');
        exit;
    }
    // FETCH ALL BOOKINGS
    $all_bookings = $booking_obj->all_bookings();
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
    <title><?php echo  $user_data->username;?></title>
    <link rel="stylesheet" href="./style.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
</head>
<body>
	<h2>Easy Ride</h2>
    <div class="profile_container">
        <div class="inner_profile">
            <h1><?php echo  $employee_data->employee_fname." ".$employee_data->employee_lname;?></h1>
        </div>
        <nav>
            <ul>
                <li><a href="employee_profile.php" rel="noopener noreferrer" class="active">Home</a></li>
                <li><a href="employee_vehicles.php" rel="noopener noreferrer">All Vehicles</a></li>
                <li><a href="stats.php" rel="noopener noreferrer">Stats</a></li>
                <li><a href="logout.php" rel="noopener noreferrer">Logout</a></li>
            </ul>
        </nav>
        <div class="all_bookings">
            <h3>All Bookings</h3>
            <div class="usersWrapper">
                <?php
                if($all_bookings){
                    foreach($all_bookings as $row){
                        echo '<div class="bookings_box">
                                <div class="vehicle_info"><span>Confirmation Number: '.$row->confirmation_num.'</span>
                                <div class="vehicle_info"><span>Status: '.$row->status.'</span>
                                <div class="vehicle_info"><span>Vehicle Type: '.$row->manufacturer.' '.$row->c_name.' '.$row->model_year.'</span>
                                <div class="vehicle_info"><span>Seat Capacity: '.$row->seat_capacity.'</span>                                
                                <div class="vehicle_info"><span>Pickup date: '.$row->pickup_date.'</span>
                                <div class="vehicle_info"><span>Dropoff date: '.$row->drop_date.'</span>
                                <div class="vehicle_info"><span>Pickup Branch: '.$row->b1_branch_name.'</span>
                                <div class="vehicle_info"><span>Dropoff Branch: '.$row->b2_branch_name.'</span>
                                <span><a href="booking_profile.php?id='.$row->confirmation_num.'" class="see_profileBtn">View</a></div>
                                <br></br>
                            </div>';
                    }
                }
                else{
                    echo '<h4>There is no bookings!</h4>';
                }
                ?>
            </div>
        </div>
        
    </div>
</body>
</html>