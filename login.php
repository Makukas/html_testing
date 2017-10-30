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
      Login
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
      <li class="nav-item active">
        <a class="nav-link" href="login.php">Login<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="register.php">Register</a>
      </li>
    </ul>
  </div>
</nav>

<br><br>

<div class="Login">
  <h3>Log in</h3><br>
  <form method="post">
    <div class="form-group">
      <label for="exampleInputEmail1">Email address</label>
      <input type="email" class="form-control" id="InputEmail" name="InputEmail" aria-describedby="emailHelp" placeholder="Enter email" required>
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Password</label>
      <input type="password" class="form-control" id="InputPassword" name="InputPassword" placeholder="Password" required>
    </div>
    <button type="submit" name="login" class="btn btn-outline-primary">Submit</button>
  </form>

  <?php if (isset($_POST['login'])){
      $InputEmail = htmlspecialchars($_POST['InputEmail']);
      $InputPassword = htmlspecialchars($_POST['InputPassword']);
      $sql = "SELECT * FROM `login` WHERE email = '$InputEmail'";
      $result = mysqli_query($conn,$sql);
      $retrieved = mysqli_fetch_assoc($result);
      if (password_verify($InputPassword, $retrieved['password_hash'])) {
        $_SESSION['id'] = session_id();
        $sql = "UPDATE login SET session_id = '{$_SESSION['id']}' WHERE email = '$InputEmail'";
        $result = mysqli_query($conn,$sql);
        header('Location: index.php');
      }
      else{
        ?>
        <br>
        <div class="alert alert-danger" role="alert">
        Wrong Email and/or password!
      </div>
      <?php
      }

    } ?>

</div>
</body>
</html>
