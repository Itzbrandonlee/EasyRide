<?php
require 'includes/init.php';
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
</head>
<body>
    <div class="profile_container">
        
        <div class="inner_profile">
            <div class="img">
                <!-- Insert picture here -->
            </div>
            <h1><?php echo  $vehicle_data->c_name;?></h1>
            <nav>
            <ul>
                <li><a href="profile.php" rel="noopener noreferrer">Home</a></li>
                <li><a href="profile.php" rel="noopener noreferrer">Bookings</a></li>
                <li><a href="profile.php" rel="noopener noreferrer">Rental History</a></li>
                <li><a href="logout.php" rel="noopener noreferrer">Logout</a></li>
            </ul>
        </nav>
        <div class="background">
        <div class="booking-form">
            <h2>Rental Booking Form</h2>
            <form action="" method="post">  
            <label for="branch">Branch</label>    
            <select name="branch" id="branch" required>
                <option value="">--Select a Branch--</option>
                <?php foreach ($all_branches as $branch): ?>
                    <option value="<?= htmlspecialchars($branch->branch_id); ?>">
                        <?= htmlspecialchars($branch->branch_name); ?>
                </option>
                <?php endforeach; ?>
            </select>
                <br></br>
           
                <label for="departure-date">Pick Up Date:</label>
                <input type="date" name="departure-date" id="departure-date" required>
                <br></br>
               
                <label for="return-date">Drop Off Date:</label>
                <input type="date" name="return-date" id="return-date" required>
                <br></br>

                <button type="submit">Book Now</button>
            </form>
        </div>
    </div>
        </div>
     
        
    </div>
</body>
</html>