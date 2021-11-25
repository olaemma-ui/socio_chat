<?php
  session_start();
  include "includes/connect.php";
  function userID () {
    $u = array_merge(range('A', 'Z'));
    $l = array_merge(range('a', 'z'));
    $bool = true;
    while ($bool) {

      $len =  mt_rand(4, 10);
      $uid = "SCI-";
      for ($i=0; $i < $len; $i++) {
        $rand = mt_rand(0, 25);
        $uid = $uid.$u[$rand];
        $rand = mt_rand(0, 25);
        $uid = $uid.$l[$i];
      }

      $file = fopen("userID.txt", "a+");
      while (!feof($file)) {
        $prev = fgets($file);
        if (!$prev == $uid) {
          $bool=!$bool;
          fwrite($file, $uid."\n");
        }
      }

      fclose($file);
    }
    return $uid;
  }
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include "includes/validate.php";

    if (empty($uname_err) && empty($psw_err) && empty($name_err) && empty($email_err) && empty($gen_err)) {

      if (sha1($psw[0]) == sha1($psw[1])) {
        $select = "SELECT * FROM user WHERE username = '".$uname[0]."'";
        $query = mysqli_query($con, $select);

        if (!mysqli_num_rows($query) > 0) {
          $psw_sha = sha1($psw[0]);
          $userID = sha1(userID());
          $insert = "INSERT INTO user VALUES('', '".$name[0]."', '".$name[1]."', '".$email[0]."', '".$uname[0]."', '".$psw_sha."', '".$userID."', 'avatar3.png', '".$gen."', '".$name[2]."')";
          $query = mysqli_query($con, $insert);
          if ($query) {
            $_SESSION["userid"] = $userID;
            $_SESSION["password"] = $pass;
            header("location: index.php");
          }else $alert = "Error occured!!";
        }else $alert = "Username already exist";
      }
      else{
        $alert = "Password Missmatch";
      }

    }
  }
  else {
    header("location: index.php");
    session_destroy();
  };


?>