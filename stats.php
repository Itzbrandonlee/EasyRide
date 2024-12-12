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
                    <li class="nav-item"><a href="stats.php" rel="noopener noreferrer" class="nav-link active">Dashboard</a></li>
                    <li class="nav-item"><a href="employee_vehicles.php" rel="noopener noreferrer" class="nav-link">All Vehicles</a></li>
                    <li class="nav-item"><a href="employee_profile.php" rel="noopener noreferrer" class="nav-link">Bookings</a></li>
                    <li class="nav-item"><a href="logout.php" rel="noopener noreferrer" class="nav-link">Logout</a></li>
                </ul>
                <span class="employee-name">
                <?php echo  $employee_data->employee_fname." ".$employee_data->employee_lname;?>
            </span>
            </div>
        </div>
    </nav>
    <div class="container mt-4">
        <div class="row">
        <div class="col-12 mb-3">
                    <h1 class="h3">Dashboard</h1>
                </div>

        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card stats-card">
                    <div class="card-header">
                        <h3 class="card-title mb-0">Repeat Customers</h3>
                    </div>
                    <div class="card-body">
                        <?php
                        if($repeat_customers){
                            foreach($repeat_customers as $row){
                                echo '<div class="mb-3 pb-3 border-bottom">
                                    <h5 class="mb-1">'.$row->customer_fname.' '.$row->customer_lname.'</h5>
                                    <p class="text-muted mb-1"><span>Email: '.$row->customer_email.'</p>
                                    <p class="text-muted"><span>Phone Number: '.$row->customer_phonenum.'</p>                              
                                </div>';
                            }
                        }
                        else{
                            echo '<div class="alert altert-info">There are no Repeat Customers !</div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card stats-card">
                    <div class="card-header">
                        <h3 class="card-title mb-0">Cancelled Reservations</h3>
                    </div>
                    <div class="card-body">
                        <?php
                        if($users_cancelled){
                            foreach($users_cancelled as $row){
                                echo '<div class="mb-3 pb-3 border-bottom">
                                    <h5 class="mb-1">'.$row->customer_fname.' '.$row->customer_lname.'</h5>
                                    <p class="text-muted mb-1">Email: '.$row->customer_email.'</p>
                                    <p class="text-muted">Phone Number: '.$row->customer_phonenum.'</p>                              
                                </div>';
                            }
                        }
                        else{
                            echo '<div class="alert alert-info>There are no customers who cancelled!</div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card stats-card">
                    <div class="card-header">
                        <h3 class="card-title mb-0">Popular Car Rentals</h3>
                    </div>
                    <div class="card-body">
                        <?php
                        if($freq_rentals){
                            foreach($freq_rentals as $row){
                                echo '<div class="mb-3 pb-3 border-bottom">
                                    <h5 class="mb-1">'.$row->manufacturer.' '.$row->c_name.'</h5>
                                    <p class=" text-muted mb-1">Year: '.$row->model_year.' | Color: '.$row->color.'</p>  
                                    <p class=" text-muted mb-1">Seat Capacity: '.$row->seat_capacity.' | Mileage: '.$row->mileage.'</p>
                                    <small class=" text-muted">VIN: '.$row->registration_num.' </small>                            
                                    
                                </div>';
                            }
                        }
                        else{
                            echo '<div class="alert alert-info">There are no cars likely to be rented !</div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>