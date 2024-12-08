<?php
    require 'includes/init.php';
    if(isset($_SESSION['employee_id']) && isset($_SESSION['email'])){
        $employee_data = $employee_obj->find_employee_by_id($_SESSION['employee_id']);
        if($employee_data ===  false){
            header('Location: logout.php');
            exit;
        }
        // FETCH ALL EMPLOYEES
        // $all_employees = $employee_obj->all_employees();
    }
    else{
        header('Location: logout.php');
        exit;
    }
    $all_bookings = $booking_obj->all_bookings_wo_id();
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
<body>
	<h2>Easy Ride</h2>
    <div class="profile_container">
        <div class="inner_profile">
            <h1><?php echo  $employee_data->employee_fname." ".$employee_data->employee_lname;?></h1>
        </div>
        <nav>
            <ul>
                <li><a href="employee_profile.php" rel="noopener noreferrer" class="active">Home</a></li>
                <li><a href="employee_booking.php" rel="noopener noreferrer" class="active">Bookings</a></li>
                <li><a href="logout.php" rel="noopener noreferrer">Logout</a></li>
            </ul>
        </nav>
        <div class="bookings">
            <h3>Current Bookings</h3>
            <div class="usersWrapper">
            <?php
                if(!empty($all_bookings)){
                    foreach($all_bookings as $row){
                        echo '<div class="booking_list">
                                <div class="booking_info"><span>Confirmation Number: '.$row->confirmation_num.'</span>
                                <div class="booking_info"><span>Customer: '.$row->customer_fname.' '.$row->customer_lname.'</span>
                                <div class="booking_info"><span>VIN: '.$row->vehicle_registration.'</span>
                                <div class="booking_info"><span>PickUp Date: '.$row->pickup_date.'</span>
                                <div class="booking_info"><span>Pickup Branch: '.$row->pickup_branch.'</span>
                                <div class="booking_info"><span>Employee Pickup: '.$row->pu_employee_fn.' '.$row->pu_employee_ln.'</span>
                                <div class="booking_info"><span>Drop Off Date: '.$row->drop_date.'</span>
                                <div class="booking_info"><span>Drop off Branch: '.$row->dropoff_branch.'</span>
                                <div class="booking_info"><span>Drop off Employee: '.$row->do_employee_fn.' '.$row->do_employee_ln.'</span>
                                <div class-"booking_info"><span>Amount: '.$row->amount.'</span>
                                <div class="booking_info"><span>Status: '.$row->status.'</span>
                                <br></br>
                                <a href="booking_update.php?id='.$row->confirmation_num.'" class="see_profileBtn">Update Booking</a>
                            </div>';
                    }
                }
                else{
                    echo '<h4>There is no booking information available!</h4>';
                }
                ?>

            </div>

        </div>
        
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>