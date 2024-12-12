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
$vehicle_data = $vehicle_obj->find_vehicle_by_id($_GET['id']);
$all_branches = $branch_obj->get_all_branches();

if(isset($_POST['branch']) && isset($_POST['departure-date']) && isset($_POST['return-date'])){
    $result = $booking_obj->bookingSubmission($_GET['id'], $_POST['departure-date'], $_SESSION['customer_id'], $_POST['return-date'], $vehicle_data->vehicle_branch_id, $_POST['branch'], $vehicle_data->rate);
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
                <h1 class="h3">Rental Booking Form</h1>
            </div>
            <div class="row g-4">
                <form action="" method="post">  
                <div class="d-flex justify-content-center">  
                        <div class="col-xl-4 col-md-6 col-sm-12">
                            <div class="card h-100">
                                <div class="card-body">
                                    <label for="branch" class="form-label">Drop off Branch</label>    
                                    <select name="branch" id="branch" class="form-select" required>
                                        <option value="">--Select a Branch--</option>
                                            <?php foreach ($all_branches as $branch): ?>
                                            <option value="<?= htmlspecialchars($branch->branch_id); ?>">
                                            <?= htmlspecialchars($branch->branch_name); ?>
                                            </option>
                                            <?php endforeach; ?>
                                    </select>
                                    <div class="mb-3">
                                        <label for="departure-date" class="form-label">Pick Up Date:</label>
                                        <input type="date" name="departure-date" id="departure-date" class="form-control" required>
                                    </div> 
                                    <div class="mb-3">         
                                        <label for="return-date">Drop Off Date:</label>
                                        <input type="date" name="return-date" id="return-date" class="form-control" required>
                                    </div>
                                    <button class="btn btn-primary" type="submit">Book Now</button>
                                </div>
                            </div>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>