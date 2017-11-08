<?php
require("functions.php");
$session_control->retrieve();
?>

<!DOCTYPE html>
<html>
<head>
    <title>
      Database
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
        <a class="nav-link" href="order.php">Order</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="database.php">Database</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="settings.php">User settings<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="logout.php">Log out</a>
      </li>
    </ul>
  </div>
</nav>


  <div class="Login">
  <form method='post'>
  <div class="form-group">
    <label class="col-form-label" for="formGroupExampleInput">First name</label>
    <input type="text" class="form-control" id="formGroupFirstName" name="formGroupFirstName" value=<?php echo $_SESSION['FirstName'];?> placeholder= "First Name">
  </div>
  <div class="form-group">
    <label class="col-form-label" for="formGroupExampleInput2">Last name</label>
    <input type="text" class="form-control" id="formGroupLastName" name="formGroupLastName" value=<?php echo $_SESSION['LastName'];?> placeholder= "Last Name">
  </div>
  <div class="form-group">
    <label class="col-form-label" for="formGroupExampleInput2">Email</label>
    <input type="text" class="form-control" id="formGroupEmail" name="formGroupEmail" value=<?php echo $_SESSION['email'];?> placeholder= "Email">
  </div>
  <div class="form-group">
    <label class="col-form-label" for="formGroupExampleInput2">Password</label>
    <input type="text" class="form-control" id="formGroupPassword" name="formGroupPassword" placeholder="Password"?>
  </div>
  <div class="form-group">
    <label class="col-form-label" for="formGroupExampleInput2">Repeat password</label>
    <input type="text" class="form-control" id="formGroupRepeatPassword" name="formGroupRepeatPassword" placeholder="Repeat password">
    <br><br>
    <button type="submit" name="settings" class="btn btn-outline-primary">Change information</button>
  </div>
</form>
</div>

<?php
if(isset($_POST['settings'])){
  if($session_control->settings() == true){header('Location: index.php');}
}
 ?>

</body>
</html>
