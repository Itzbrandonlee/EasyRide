<?php
require 'includes/init.php';
// IF EMPLOYEE MAKING LOGIN REQUEST
if(isset($_POST['email']) && isset($_POST['password'])){
  $result = $employee_obj->loginEmployee($_POST['email'],$_POST['password']);
}
// IF USER ALREADY LOGGED IN
if(isset($_SESSION['email'])){
  header('Location: stats.php');
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Employee Login</title>
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
        <h1 class="display-4 mb-4 mt-4">Welcome to Easy Ride!</h1>

    </div>
</section>
<section class="login-form-section py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-4">Employee Login</h2>
        <div class="row justify-content-center login_signup_container">
            <div class="col-md-6">
                <div class="card p-4 shadow">
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" spellcheck="false" placeholder="Enter your email address" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" >Password</label>
                            <input type="password"  id="password" name="password" placeholder="Enter your password" required>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <a href="employee_signup.php" class="form-link">Sign Up</a>
                            <a href="index.php" class="form-link">Customer Login</a>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Login</button>
                        <?php
                        if(isset($result['errorMessage'])){
                            echo '<p class="text-danger mt-3">'.$result['errorMessage'].'</p>';
                        }
                        if(isset($result['successMessage'])){
                            echo '<p class="text-success mt-3">'.$result['successMessage'].'</p>';
                        }
                        ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
    
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>