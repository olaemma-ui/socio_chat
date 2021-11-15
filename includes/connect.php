<?php
  $con = mysqli_connect("localhost", "root", "", "socio");
  if (!$con) {
    die( mysqli_error($con));
  }
?>