<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$db = "html_training";

// Create connection
$conn = new mysqli($servername, $username, $password, $db);
$con = true;

// Check connection
if ($conn->connect_error) {

   $con = false;
}
?>
<!DOCTYPE html>

<html>
<head>
    <title>
      Registration
    </title>

      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
      <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="index.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="login.php">Login</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="register.php">Register<span class="sr-only">(current)</span></a>
      </li>
    </ul>
  </div>
</nav>

<br><br>

<?php
if(empty($_SESSION['email'])){
 ?>

<div class="Login">
  <h3>Registration</h3><br>
<form method="post">
    <div class="form-group">
    <label for="InputFirstName">First name</label>
    <input type="text" class="form-control" id="RegFirstName" name="RegFirstName" placeholder="First name">
  </div>
  <div class="form-group">
    <label for="InputLastName">Last name</label>
    <input type="text" class="form-control" id="RegLastName" name="RegLastName" placeholder="Last name">
  </div>
  <div class="form-group">
    <label for="InputEmail">Email address</label>
    <input type="email" class="form-control" id="RegEmail" name="RegEmail" placeholder="Enter email">
  </div>
  <div class="form-group">
    <label for="InputPassword">Password</label>
    <input type="password" class="form-control" id="RegPassword" name="RegPassword" placeholder="Password">
  </div>
  <div class="form-group">
    <label for="InputPassword1">Repeat password</label>
    <input type="password" class="form-control" id="RegPassword1" name="RegPassword1" placeholder="Repeat password">
  </div>
  <div class="form-check">
  </div>
  <button type="submit" class="btn btn-outline-primary" name="registration">Submit</button>
</form>
<br>

<?php
}
else{
?>
<div class="alert alert-danger" role="alert">
You already have an account!
</div>
<?php
}
 ?>

<?php
$pssw_wrong = false;
if (isset($_POST['registration'])){
$RegPassword = $_POST[htmlspecialchars('RegPassword')];
$RegPassword1 = $_POST[htmlspecialchars('RegPassword1')];
$RegEmail = $_POST[htmlspecialchars('RegEmail')];
$sql = "SELECT * FROM `login` WHERE email = '$RegEmail'";
$result = mysqli_query($conn,$sql);

if($RegPassword1 == $RegPassword && mysqli_num_rows($result) == 0){

$RegPassword1 = password_hash($RegPassword, PASSWORD_DEFAULT);

$RegFirstName = $_POST[htmlspecialchars('RegFirstName')];
$RegLastName = $_POST[htmlspecialchars('RegLastName')];

$sql = "INSERT INTO login (FirstName, LastName, email, password_hash, User_role) VALUES('$RegFirstName', '$RegLastName', '$RegEmail', '$RegPassword1', 'User')";
$result = mysqli_query($conn, $sql);

}
else if(mysqli_num_rows($result) >= 1){
  ?>
  <br>
  <div class="alert alert-danger" role="alert">
  This email is already registered!
  </div>
  <?php
  die;
}
else{ $pssw_wrong = true;}?>
<?php
 if($pssw_wrong == true){
   ?>
   <br>
<div class="alert alert-danger" role="alert">
Passwords do not match!
</div>
<?php
}
if($pssw_wrong == false){
  ?>
  <br>
  <div class="alert alert-success" role="alert">
    New account created!
  </div>
<?php
}
}
?>
</div>
</body>
</html>
