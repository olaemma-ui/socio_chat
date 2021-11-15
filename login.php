<?php
  session_start();
  include "includes/connect.php";
  $user = "";
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include "includes/validate.php";
    if (empty($uname_err) && empty($psw_err)) {

      $psw_sha = sha1($psw[0]);
      $select = "SELECT * FROM user WHERE username = '".$uname[0]."' OR email = '".$uname[0]."'";
      $query = mysqli_query($con, $select);
      if (mysqli_num_rows($query) == 1) {
        while ($row = mysqli_fetch_array($query)) {
          $pass = $row["password"];
          if ($psw_sha == $pass) {
              $_SESSION["userid"] = $row["userID"];
              $_SESSION["password"] = $pass;
              $file = fopen("login.socio", "a+");
              fwrite($file, $_SESSION["userid"]."\n");
              fclose($file);
              header("location: chat.php");
          }else{
            $alert = "Wrong password";
            $psw_err[0] = "********";
          }
        }
      }
      else{
        $alert = "Account does not exist";
        $psw_err[0] = "********";
        $uname_err[0] = "********";
      }
    }
  }
  else {
    header("location: index.php");
    session_destroy();
  };


?>