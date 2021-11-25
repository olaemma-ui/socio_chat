<?php
include "includes/session.php";
include "includes/connect.php";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update"])) {
    include "includes/validate.php";
    if (empty($uname_err)&&empty($name_err)&&empty($email_err)&&!empty($gen)) {
      $update = "UPDATE user SET firstName = '".$name[0]."', lastName = '".$name[1]."', country = '".$name[2]."', username = '".$uname[0]."', gender = '".$gen."' WHERE userID = '".$_SESSION["userid"]."'";
      $query = mysqli_query($con, $update);
      echo mysqli_error($con);
      if ($query) {
        $alert = "Updated";
      }else{
        print_r($name);
      }
    }
  }
?>