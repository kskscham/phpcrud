<!-- To be added in the multisave.php -->
 
<?php
 
require_once('classes/classes/database.php');
 
$con = new database();

session_start();

if (isset($_POST['multisave'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $birthday = $_POST['birthday'];
    $sex = $_POST['sex'];
    $username = $_POST['user'];
    $password = $_POST['pass'];
    $confirm = $_POST['confirm'];
    $street = $_POST['street'];
    $barangay = $_POST['barangay'];
    $city = $_POST['city'];
    $province = $_POST['province'];
   
    if ($password == $confirm) {
      // Passwords match, proceed with signup
      $user_id = $con->signupUser($username, $password,$firstname, $lastname, $birthday, $sex); // Insert into users table and get user_id
      if ($user_id) {
          // Signup successful, insert address into users_address table
          if ($con->insertAddress($user_id, $street ,$barangay ,$city, $province)) {
              // Address insertion successful, redirect to login page
              $_SESSION['Username'] = $result['user'];
              header('location:login.php');
              exit();
          } else {
              // Address insertion failed, display error message
              $error = "Error occurred while signing up. Please try again.";
          }
      } else {
          // User insertion failed, display error message
          $error = "Error occurred while signing up. Please try again.";
      }
  } else {
      // Passwords don't match, display error message
      $error = "Passwords did not match. Please try again.";
  }
}
 
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MultiSave Page</title>
  <link rel="stylesheet" href="./bootstrap-5.3.3-dist/css/bootstrap.css">
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
 
  <style>
    body{
      background-color: #F5347F;
    }
    .custom-container{
        width: 800px;
    }
    body{
    font-family: 'Roboto', sans-serif;
    }
  </style>
 
</head>
<body>
 
<div class="container custom-container rounded-3 shadow my-5 p-3 px-5">
  <h3 class="text-center mt-4"> Registration Form</h3>
  <form method ="post">
    <!-- Personal Information -->
    <div class="card mt-4">
      <div class="card-header bg-danger text-white">Personal Information</div>
      <div class="card-body">
        <div class="form-row">
          <div class="form-group col-md-6 col-sm-12">
            <label for="firstName">First Name:</label>
            <input type="text" class="form-control" id="firstName" name="firstname" placeholder="Enter first name" required>
          </div>
          <div class="form-group col-md-6 col-sm-12">
            <label for="lastName">Last Name:</label>
            <input type="text" class="form-control" id="lastName" name="lastname" placeholder="Enter last name" required>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="birthday">Birthday:</label>
            <input type="date" class="form-control" name="birthday" id="birthday" required>
          </div>
          <div class="form-group col-md-6">
            <label for="sex">Sex:</label>
            <select class="form-control" name="sex" id="sex" required>
              <option selected>Select Sex</option>
              <option>Male</option>
              <option>Female</option>
              <option>Bading</option>
              <option>Yobmot</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="username">Username:</label>
          <input type="text" class="form-control" id="username" name="user" placeholder="Enter username" required>
        </div>
        <div class="form-group">
          <label for="password">Password:</label>
          <input type="password" class="form-control" id="password" name="pass" placeholder="Enter password" required>
        </div>
        <div class="form-group">
      <label for="confirm">Confirm Password:</label>
      <input type="confirm" class="form-control" id="confirm" placeholder="Re-Enter password" name="confirm">
    </div>
      </div>
    </div>
   
    <!-- Address Information -->
    <div class="card mt-4">
      <div class="card-header bg-danger text-white">Address Information</div>
      <div class="card-body">
        <div class="form-group">
          <label for="street">Street:</label>
          <input type="text" class="form-control" id="street" name="street" placeholder="Enter street" required>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="barangay">Barangay:</label>
            <input type="text" class="form-control" id="barangay" name="barangay" placeholder="Enter barangay" required>
          </div>
          <div class="form-group col-md-6">
            <label for="city">City:</label>
            <input type="text" class="form-control" id="city" name="city" placeholder="Enter city" required>
          </div>
        </div>
        <div class="form-group">
          <label for="province">Province:</label>
          <input type="text" class="form-control" id="province" name="province" placeholder="Enter province" required>
        </div>
      </div>
    </div>
   
    <!-- Submit Button -->
   
    <div class="container">
    <div class="row justify-content-center gx-0">
        <div class="col-lg-3 col-md-4">
            <input type="submit" name="multisave" class="btn btn-outline-dark btn-block mt-4" value="Sign Up">
        </div>
        <div class="col-lg-3 col-md-4">
            <a class="btn btn-outline-light btn-block mt-4" href="login.php">Go Back</a>
        </div>
    </div>
</div>
 
 
  </form>
</div>
 
<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="./bootstrap-5.3.3-dist/js/bootstrap.js"></script>
<!-- Bootsrap JS na nagpapagana ng danger alert natin -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
 