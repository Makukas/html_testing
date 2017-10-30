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
      Logging out...
    </title>
</head>
<body>


<?php
  session_regenerate_id();
  session_unset();
  session_destroy();
  header('Location: index.php');
?>

</body>
</html>
