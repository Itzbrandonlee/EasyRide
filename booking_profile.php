<?php
require 'includes/init.php';
$booking_data = $booking_obj->find_booking_by_id($_GET['id']);
$all_branches = $branch_obj->get_all_branches();
$all_statuses = $booking_obj->get_all_statuses();

if(isset($_POST['branch']) && isset($_POST['status']) && isset($_POST['departure-date']) && isset($_POST['return-date'])){
    $result = $booking_obj->bookingUpdate($booking_data->confirmation_num, $_POST['departure-date'], $_POST['return-date'], $_POST['branch'], $_POST['status']);
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
<body>
    <div class="profile_container">
        
        <div class="inner_profile">
            <div class="img">
                <!-- Insert picture here -->
            </div>
            <h1><?php echo  $booking_data->confirmation_num;?></h1>
            <nav>
            <ul>
                <li><a href="employee_profile.php" rel="noopener noreferrer">Home</a></li>
                <li><a href="employee_profile.php" rel="noopener noreferrer">Rental History</a></li>
                <li><a href="logout.php" rel="noopener noreferrer">Logout</a></li>
            </ul>
        </nav>
        <div class="background">
        <div class="booking-form">
            <h2>Update</h2>
            <form action="" method="post">  
            <label for="branch">Drop off Branch</label>    
            <select name="branch" id="branch">
                <option value="">--Select a Branch--</option>
                <?php foreach ($all_branches as $branch): ?>
                    <option value="<?= htmlspecialchars($branch->branch_id); ?>">
                        <?= htmlspecialchars($branch->branch_name); ?>
                </option>
                <?php endforeach; ?>
            </select>  
            <br></br>
            <label for="status">Status</label>  
            <select name="status" id="status">
                <option value="">--Select status--</option>
                <?php foreach ($all_statuses as $statuses): ?>
                    <option value="<?= htmlspecialchars($statuses->status); ?>">
                        <?= htmlspecialchars($statuses->status); ?>
                </option>
                <?php endforeach; ?>
            </select>
                <br></br>
           
                <label for="departure-date">Pick Up Date:</label>
                <input type="date" name="departure-date" id="departure-date">
                <br></br>
               
                <label for="return-date">Drop Off Date:</label>
                <input type="date" name="return-date" id="return-date">
                <br></br>

                

                <button type="submit">Submit</button>
            </form>
        </div>
    </div>
        </div>
     
        
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>