<?php
  $uname_err = array();
  $psw_err = array();
  $name_err = array();
  $email_err = array();
  $gen_err;

  $uname = array();
  $psw = array();
  $name = array();
  $email = array();
  $gen;


  function validate ($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    /*
    * Username
    */
    if (isset($_POST["uname"])) {
        for ($i=0; $i < count($_POST["uname"]); $i++) {
          if (!empty($_POST["uname"][$i])) {
            $regex = validate($_POST["uname"][$i]);
            if (!preg_match("/^[a-zA-Z_ 0-9@.]*$/", $regex)) {
              $uname_err[$i] = "No special character ** [a-Z 0-9 _]";
            }else{
              $uname[$i] = $_POST["uname"][$i];
            }
          }
          else{
            $uname_err[$i] = "All fields are required **";
          }
        }
    }

    /**
     *  Password Validate
     **/
    if (isset($_POST["psw"])) {
      for ($i=0; $i < count($_POST["psw"]); $i++) {
        if (!empty($_POST["psw"][$i])) {
          if (strlen($_POST["psw"][$i]) > 7) {
            $regex = validate($_POST["psw"][$i]);
            if (!preg_match("/^[a-zA-Z_ 0-9]/", $regex)) {
              $psw_err[$i] = "No special character ** [a-Z 0-9 _]";
            }else{
              $psw[$i] = $_POST["psw"][$i];
            }
          }else{
            $psw_err[$i] = "8 letters above**";
          }
        }
        else{
          $psw_err[$i] = "All fields are required **";
        }
      }
    }

    /**
     * Name Validate
     * */
    if (isset($_POST["name"])) {
      for ($i=0; $i < count($_POST["name"]); $i++) {
        if (!empty($_POST["name"][$i])) {

          $regex = validate($_POST["name"][$i]);
          if (!preg_match("/^[a-zA-Z]/", $regex)) {
            $name_err[$i] = "No special character ** [A-Z a-z]";
          }else{
            $name[$i] = $_POST["name"][$i];
          }

        }
        else{
          $name_err[$i] = "All fields are required **";
        }
      }
    }


    /**
     * Email Validate
     * */
    if (isset($_POST["email"])) {
      for ($i=0; $i < count($_POST["email"]); $i++) {
        if (!empty($_POST["email"][$i])) {

          $regex = validate($_POST["email"][$i]);
          if (!filter_var($_POST["email"][$i], FILTER_VALIDATE_EMAIL)) {
            $email_err[$i] = "Invalid E-mail address";
          }else{
            $email[$i] = $_POST["email"][$i];
          }

        }
        else{
          $email_err[$i] = "All fields are required **";
        }
      }
    }

    /**
     * Gender Validate
     **/
    if (isset($_POST["gen"])) {
        if (!empty($_POST["gen"])) {
          $regex = validate($_POST["gen"]);
          if (!preg_match("/^[a-zA-Z]*$/", $regex)) {
            $gen_err = "!!!!";
          }else{
            $gen = $_POST["gen"];
          }
        }
        else{
          $gen_err = "All fields are required **";
        }
      }
  }
?>