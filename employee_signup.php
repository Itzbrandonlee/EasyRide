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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark nav-container">
    <div class="container">
            <a class="navbar-brand" href="#">Easy Ride</a>
    </div>
</nav>

<section class="hero-section text-center text-black bg-light">
    <div class="container">
        <h1 class="display-4 mb-3 mt-4">Welcome to the team!</h1>
    </div>
</section>

<section class="login-form-section py-2 bg-light">
    <div class="container">
      <h2 class="text-center mb-3">Employee Sign up</h2>
  <div class="row justify-content-center login_signup_container">
    <div class="col-md-6">
      <div class="card p-4 shadow">
    <form action="" method="POST" novalidate>
    <div class="mb-3">
      <label for="fname">First Name</label>
      <input type="text" id="fname" name="fname" spellcheck="false" placeholder="Enter your first name" required>
      </div>
      <div class="mb-3">
      <label for="lname">Last Name</label>
      <input type="text" id="lname" name="lname" spellcheck="false" placeholder="Enter your last name" required>
      </div>
      <div class="mb-3">
      <label for="address">Address</label>
      <input type="text" id="address" name="address" spellcheck="false" placeholder="Enter your address" required>
      </div>
      <div class="mb-3">
      <label for="phonenum">Phone Number</label>
      <input type="text" id="phonenum" name="phonenum" spellcheck="false" placeholder="Enter your phone number" required>
      </div>
      <div class="mb-3">
      <label for="email">Email</label>
      <input type="email" id="email" name="email" spellcheck="false" placeholder="Enter your email address" required>
      </div>
      <div class="mb-3">
      <label for="password">Password</label>
      <input type="password" id="password" name="password" placeholder="Enter your password" required>
      </div>
      <div class="mb-3">
      <label for="branch">Branch</label>
      <select name="branch" id="branch" class="form-select" required>
        <option value="">--Select a Branch--</option>
        <?php foreach ($all_branches as $branch): ?>
          <option value="<?= htmlspecialchars($branch->branch_id); ?>">
            <?= htmlspecialchars($branch->branch_name); ?>
        </option>
        <?php endforeach; ?>
        </select>
        </div>
        <input type="submit" class="btn btn-primary w-100" value="Sign Up">
      <div class="d-flex justify-content-end">
          <p class="mt-4">Already a Member? - <a href="index.php">Log In</a> </p>
          </div>
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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

