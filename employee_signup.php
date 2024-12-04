<?php
require 'includes/init.php';

if(isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['address']) && isset($_POST['phonenum']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['branch'])){
  $result = $employee_obj->signUpEmployee($_POST['fname'], $_POST['lname'], $_POST['address'], $_POST['phonenum'], $_POST['email'],$_POST['password'], $_POST['branch']);
}

$all_branches = $branch_obj->get_all_branches();

if(isset($_SESSION['email'])){
  header('Location: employee_profile.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Employee Signup</title>
    <link rel="stylesheet" href="./style.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
</head>
<body>
	<h2>EasyRide</h2>
  <div class="main_container login_signup_container">
    <h1>Employee Sign Up</h1>
    <form action="" method="POST" novalidate>
      <label for="fname">First Name</label>
      <input type="text" id="fname" name="fname" spellcheck="false" placeholder="Enter your first name" required>
      <label for="lname">Last Name</label>
      <input type="text" id="lname" name="lname" spellcheck="false" placeholder="Enter your last name" required>
      <label for="address">Address</label>
      <input type="text" id="address" name="address" spellcheck="false" placeholder="Enter your address" required>
      <label for="phonenum">Phone Number</label>
      <input type="text" id="phonenum" name="phonenum" spellcheck="false" placeholder="Enter your phone number" required>
      <label for="email">Email</label>
      <input type="email" id="email" name="email" spellcheck="false" placeholder="Enter your email address" required>
      <label for="password">Password</label>
      <input type="password" id="password" name="password" placeholder="Enter your password" required>
      <label for="branch">Branch</label>
      <select name="branch" id="branch" required>
        <option value="">--Select a Branch--</option>
        <?php foreach ($all_branches as $branch): ?>
          <option value="<?= htmlspecialchars($branch->branch_id); ?>">
            <?= htmlspecialchars($branch->name); ?>
        </option>
        <?php endforeach; ?>
        </select>
        </br>
      <input type="submit" value="Sign Up">
      <a href="employee_index.php" class="form_link">Login</a>
    </form>
    <div>  
      <?php
        if(isset($result['errorMessage'])){
          echo '<p class="errorMsg">'.$result['errorMessage'].'</p>';
        }
        if(isset($result['successMessage'])){
          echo '<p class="successMsg">'.$result['successMessage'].'</p>';
        }
      ?>    
    </div>
    
  </div>
</body>
</html>

