<?php
  class session_manager{

    public $session_email;
    public $session_FirstName;
    public $session_LastName;

    public function connect_db(){
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
    }

    public function start_session(){
      session_start();
    }

    public function end_session(){
      session_regenerate_id();
      session_unset();
      session_destroy();
      header('location: index.php');
    }

    public function check_session(){

      $servername = "localhost";
      $username = "root";
      $password = "";
      $db = "html_training";

      // Create connection
      $conn = new mysqli($servername, $username, $password, $db);

      $_SESSION['id'] = session_id();
      $sql = "SELECT * FROM login WHERE session_id = '{$_SESSION['id']}'";
      $result = mysqli_query($conn,$sql);
      $retrieved = mysqli_fetch_assoc($result);
      if(mysqli_num_rows($result) == 0){
        return false;}
      else{
        return true;}
    }

    public function login(){

      $servername = "localhost";
      $username = "root";
      $password = "";
      $db = "html_training";

      // Create connection
      $conn = new mysqli($servername, $username, $password, $db);

      if (isset($_POST['login'])){
          $InputEmail = htmlspecialchars($_POST['InputEmail']);
          $InputPassword = htmlspecialchars($_POST['InputPassword']);
          $sql = "SELECT * FROM `login` WHERE email = '$InputEmail'";
          $result = mysqli_query($conn,$sql);
          $retrieved = mysqli_fetch_assoc($result);
          if (password_verify($InputPassword, $retrieved['password_hash'])) {
            $_SESSION['id'] = session_id();
            $sql = "UPDATE login SET session_id = '{$_SESSION['id']}' WHERE email = '$InputEmail'";
            $result = mysqli_query($conn,$sql);
            $_SESSION['email'] = htmlspecialchars($_POST['InputEmail']);
            header('Location: index.php');
          }
          else{return false;}

        }
    }

    public function settings(){
      $servername = "localhost";
      $username = "root";
      $password = "";
      $db = "html_training";

      // Create connection
      $conn = new mysqli($servername, $username, $password, $db);

      $FirstName = htmlspecialchars($_POST['formGroupFirstName']);
      $LastName = htmlspecialchars($_POST['formGroupLastName']);
      $Email = htmlspecialchars($_POST['formGroupEmail']);
      $Password = htmlspecialchars($_POST['formGroupPassword']);
      $RepeatPassword = htmlspecialchars($_POST['formGroupRepeatPassword']);

      $sql = "UPDATE login SET FirstName = '$FirstName', LastName = '$LastName', email = '$Email' WHERE session_id = '{$_SESSION['id']}'";
      $result = mysqli_query($conn,$sql);

      if(!empty($Password) && $Password == $RepeatPassword){

      $Password = password_hash($Password, PASSWORD_DEFAULT);
      $sql = "UPDATE login SET password_hash = '$Password' WHERE session_id = '{$_SESSION['id']}'";
      $result = mysqli_query($conn,$sql);
      return true;
    }
  }

  public function retrieve(){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "html_training";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $db);
    $sql = "SELECT * FROM `login` WHERE email = '{$_SESSION['email']}'";
    $result = mysqli_query($conn,$sql);
    $retrieved = mysqli_fetch_assoc($result);
    $_SESSION['email'] = $session_email = $retrieved['email'];
    $_SESSION['FirstName'] = $session_FirstName = $retrieved['FirstName'];
    $_SESSION['LastName'] = $session_LastName = $retrieved['LastName'];
  }

}


  $session_control = new session_manager();
  $session_control->connect_db();
  $session_control->start_session();



?>
