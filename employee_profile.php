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
                <li><a href="logout.php" rel="noopener noreferrer">Logout</a></li>
            </ul>
        </nav>
        <!-- <div class="all_users">
            <h3>All Users</h3>
            <div class="usersWrapper">
                <?php
                if($all_users){
                    foreach($all_users as $row){
                        echo '<div class="user_box">
                                <div class="user_info"><span>'.$row->customer_fname.'</span>
                                <span><a href="user_profile.php?id='.$row->customer_id.'" class="see_profileBtn">See profile</a></div>
                            </div>';
                    }
                }
                else{
                    echo '<h4>There is no user!</h4>';
                }
                ?>
            </div>
        </div> -->
        
    </div>
</body>
</html>