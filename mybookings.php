<?php
require 'includes/init.php';
if(isset($_SESSION['customer_id']) && isset($_SESSION['email'])){
    $user_data = $user_obj->find_user_by_id($_SESSION['customer_id']);
    if($user_data ===  false){
        header('Location: logout.php');
        exit;
    }
    // FETCH ALL BOOKINGS
    $all_bookings = $user_obj->all_user_bookings($_SESSION['customer_id']);
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark nav-container">
        <div class="container">
            <a class="navbar-brand" href="#">Easy Ride</a>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a href="profile.php" rel="noopener noreferrer" class="nav-link">Home</a></li>
                    <li class="nav-item"><a href="mybookings.php" rel="noopener noreferrer" class="nav-link active">Bookings</a></li>
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
                    <h1 class="h3">All My Bookings</h1>
                </div>
            <div class="row g-4">
                <?php
                if($all_bookings){
                    foreach($all_bookings as $row){
                        echo '<div class="col-xl-4 col-md-6 col-sm-12">
                                <div class="card vehicle-card h-100">
                                    <div class="card-body">
                                        <h5 class="card-title">Confirmation Number: '.$row->confirmation_num.'</h5>
                                        <div class="detail-row"><span class="detail-label">Status:</span><span class="detail-value"> '.$row->status.'</span></div>
                                        <div class="detail-row"><span class="detail-label">Vehicle Type:</span><span class="detail-value"> '.$row->manufacturer.' '.$row->c_name.' '.$row->model_year.'</span></div>
                                        <div class="detail-row"><span class="detail-label">Seat Capacity:</span><span class="detail-value">'.$row->seat_capacity.'</span></div>
                                        <div class="detail-row"><span class="detail-label">Pickup date:</span><span class="detail-value"> '.$row->pickup_date.'</span></div>
                                        <div class="detail-row"><span class="detail-label">Dropoff date: </span><span class="detail-value">'.$row->drop_date.'</span></div>
                                        <div class="detail-row"><span class="detail-label">Pickup Branch:</span><span class="detail-value"> '.$row->b1_branch_name.'</span></div>
                                        <div class="detail-row"><span class="detail-label">Dropoff Branch:</span><span class="detail-value"> '.$row->b2_branch_name.'</span></div>
                                    </div>
                                </div>
                            </div>';
                    }
                }
                else{
                    echo '<div class="alert alert-info">You Currently have bookings!</div>';
                }
                ?>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>