<?php
require 'includes/init.php';
// if(isset($_SESSION['user_id']) && isset($_SESSION['email'])){
//     if(isset($_GET['id'])){
//         $user_data = $user_obj->find_user_by_id($_GET['id']);
//         if($user_data ===  false){
//             header('Location: profile.php');
//             exit;
//         }
//         else{
//             if($user_data->id == $_SESSION['user_id']){
//                 header('Location: profile.php');
//                 exit;
//             }
//         }
//     }
// }
// else{
//     header('Location: logout.php');
//     exit;
// }

$vehicle_data = $vehicle_obj->find_vehicle_by_id($_GET['id']);
$all_branches = $branch_obj->get_all_branches();
// if($vehicle_data === false){
//     header('Location: profile.php');
//     exit;
// }
// // CHECK FRIENDS
// $is_already_friends = $frnd_obj->is_already_friends($_SESSION['user_id'], $user_data->id);
// //  IF I AM THE REQUEST SENDER
// $check_req_sender = $frnd_obj->am_i_the_req_sender($_SESSION['user_id'], $user_data->id);
// // IF I AM THE REQUEST RECEIVER
// $check_req_receiver = $frnd_obj->am_i_the_req_receiver($_SESSION['user_id'], $user_data->id);
// // TOTAL REQUESTS
// $get_req_num = $frnd_obj->request_notification($_SESSION['user_id'], false);
// // TOTAL FRIENDS
// $get_frnd_num = $frnd_obj->get_all_friends($_SESSION['user_id'], false);
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
            <form action="index.php" method="post">  
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>