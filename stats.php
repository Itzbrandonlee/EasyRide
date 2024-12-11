<?php
require 'includes/init.php';
if(isset($_SESSION['employee_id']) && isset($_SESSION['email'])){
    $employee_data = $employee_obj->find_employee_by_id($_SESSION['employee_id']);
    if($employee_data ===  false){
        header('Location: logout.php');
        exit;
    }
}
else{
    header('Location: logout.php');
    exit;
}
$repeat_customers = $user_obj->repeat_customer();
$users_cancelled = $booking_obj->cancelled_bookings();
$freq_rentals = $vehicle_obj->popular_rentals();
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
    <div class="d-flex justify-content-center">
        <h2>Easy Ride</h2>
    </div>
    <div class="d-flex justify-content-center">

    <div class="profile_container w-100">
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
        <div class="stats_repeat">
            <h1>Statistics</h1>
            <div class="usersWrapper">
                <h3>Repeat Customers</h3>
                <?php
                if($repeat_customers){
                    foreach($repeat_customers as $row){
                        echo '<div class="repeat_customers">
                                <div class="vehicle_info"><span>Customer: '.$row->customer_fname.' '.$row->customer_lname.'</span>
                                <div class="vehicle_info"><span>Email: '.$row->customer_email.'</span>
                                <div class="vehicle_info"><span>Phone Number: '.$row->customer_phonenum.'</span>                              
                                <br></br>
                            </div>';
                    }
                }
                else{
                    echo '<h4>There are no Repeat Customers !</h4>';
                }
                ?>
            </div>
        </div>
        <div class="stats_cancelled">
            <div class="usersWrapper">
                <h3>Customers with Cancelled Reservations</h3>
                <?php
                if($users_cancelled){
                    foreach($users_cancelled as $row){
                        echo '<div class="repeat_customers">
                                <div class="vehicle_info"><span>Customer: '.$row->customer_fname.' '.$row->customer_lname.'</span>
                                <div class="vehicle_info"><span>Email: '.$row->customer_email.'</span>
                                <div class="vehicle_info"><span>Phone Number: '.$row->customer_phonenum.'</span>                              
                                <br></br>
                            </div>';
                    }
                }
                else{
                    echo '<h4>There are no customers who cancelled!</h4>';
                }
                ?>
            </div>
        </div>
        <div class="stats_rentals">
            <div class="usersWrapper">
                <h3>Cars Likely to Be Reserved</h3>
                <?php
                if($freq_rentals){
                    foreach($freq_rentals as $row){
                        echo '<div class="repeat_customers">
                                <div class="vehicle_info"><span>Car Type: '.$row->manufacturer.' '.$row->c_name.'</span>
                                <div class="vehicle_info"><span>Year: '.$row->model_year.'</span>
                                <div class="vehicle_info"><span>Color: '.$row->color.'</span>  
                                <div class="vehicle_info"><span>Description: '.$row->description.'</span>
                                <div class="vehicle_info"><span>Seat Capacity: '.$row->seat_capacity.'</span>
                                <div class="vehicle_info"><span>VIN: '.$row->registration_num.'</span> 
                                <div class="vehicle_info"><span>Mileage: '.$row->mileage.'</span>                            
                                <br></br>
                            </div>';
                    }
                }
                else{
                    echo '<h4>There are no cars likely to be rented !</h4>';
                }
                ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>