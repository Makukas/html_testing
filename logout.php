<?php
require("functions.php");
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
  $session_control->end_session();
?>

</body>
</html>
