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
$booking_data = $booking_obj->find_booking_by_id($_GET['id']);
$all_branches = $branch_obj->get_all_branches();

if(isset($_POST['branch']) && isset($_POST['departure-date']) && isset($_POST['return-date'])){
    $result = $booking_obj->bookingUpdate($booking_data->confirmation_num, $_POST['departure-date'], $_POST['return-date'], $_POST['branch']);
  }
// else if(isset($_POST['branch'])){
//     $result = $booking_obj->bookingUpdate($booking_data->confirmation_num, $booking_data->pickup_date, $booking_data->drop_date, $_POST['branch'], $booking_data->status);
// }
// else if(isset($_POST['status'])){
//     $result = $booking_obj->bookingUpdate($booking_data->confirmation_num, $booking_data->pickup_date, $booking_data->drop_date, $booking_data->drop_branch_id, $_POST['status']);
// }
// else if(isset($_POST['departure-date'])){
//     $result = $booking_obj->bookingUpdate($booking_data->confirmation_num, $_POST['departure-date'], $booking_data->drop_date, $booking_data->drop_branch_id, $booking_data->status);
// }
// else if(isset($_POST['return-date'])){
//     $result = $booking_obj->bookingUpdate($booking_data->confirmation_num, $booking_data->pickup_date, $_POST['return-date'], $booking_data->drop_branch_id, $booking_data->status);
// }

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
                    <li class="nav-item"><a href="employee_vehicles.php" rel="noopener noreferrer" class="nav-link">All Vehicles</a></li>
                    <li class="nav-item"><a href="employee_profile.php" rel="noopener noreferrer" class="nav-link active">Bookings</a></li>
                    <li class="nav-item"><a href="logout.php" rel="noopener noreferrer" class="nav-link">Logout</a></li>
                </ul>
                <span class="employee-name">
                <?php echo  $employee_data->employee_fname." ".$employee_data->employee_lname;?>
            </span>
            </div>
        </div>
    </nav>
    <div class="container py-4">
        <div class="row mb-4">
            <div class="col-12">
                <h1 class="h3">Update Booking Information</h1>
            </div>
            <div class="row">
                <div class="col-md-8 offset-md-2 mt-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <form action="" method="post">  
                                <div class="mb-3">
                                <label for="branch" class="form-label">Drop off Branch</label>    
                                <select name="branch" id="branch" class="form-select" required>
                                    <option value="">--Select a Branch--</option>
                                    <?php foreach ($all_branches as $branch): ?>
                                        <option value="<?= htmlspecialchars($branch->branch_id); ?>">
                                            <?= htmlspecialchars($branch->branch_name); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select> 
                            </div>
                            <div class="mb-3">
                                <label for="departure-date" class="form-label">Pick Up Date:</label>
                                <input type="date" name="departure-date" id="departure-date" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="return-date" class="form-label">Drop Off Date:</label>
                                <input type="date" name="return-date" id="return-date" class="form-control" required>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>