<?php
  include "includes/header.php";
  error_reporting(0);
  include "includes/session.php";
  include "includes/connect.php";
?>

<nav class="navbar wrapper sticky top-0 shadow-xl p-1 bg-darker flex justify-between">
  <a href="home.php" class="brand p-1 text-white md:text-3xl text-xl">Socio <i class="far fa-comment-alt md:text-4xl text-blue-400"></i></a>

  <button class="bars text-white text-2xl pr-2" id="btn">
    <i class="fa fa-bars" id="ic"></i>
  </button>
</nav>
  <div class="sidebar shadow-xl z-50 fixed h-full  overflow-y-auto lg:w-2/12 w-6/12 hidden right bg-darker mt-0.5 right-0 flex flex-col justify-etween" id="sidebar">
    <ul class="tabs p-2">
      <?php
        $select = "SELECT * FROM user WHERE userid = '".$_SESSION["userid"]."'";
        $query = mysqli_query($con, $select);
        echo mysqli_error($con);
        while ($a = mysqli_fetch_array($query)) {
      ?>
      <li class="list p-1 ">
        <a href="./profile.php" class="link border-b-dark text-white p-3 flex w-full block bg-darker-h border-bdark flex-wrap md:justify-start md:flex-row flex-col justify-center" style="align-items: center;">
          <img src="./assets/uploads/<?=$a["img"]?>" alt="" class="rounded-full w-28 h-28">
          <span class="txt text-2xl"><?=$a["username"]?></span>
        </a>
      </li>
      <?php }?>
      <li class="list p-1">
        <a href="./chat.php" class="link text-white w-full block p-3 bg-darker-h border-b-dark  border-b-blue-400 flex justify-between">Messages <i class="far fa-comment-dots"></i> </a>
      </li>

      <li class="list p-1">
        <a href="" class="link text-white w-full block p-3 bg-darker-h border-b-dark border-b-blue-400 flex justify-between ">Friends <i class="fa fa-user-plus"></i></a>
      </li>

    </ul>
    <ul class="fixed bottom-0 w-full">
      <button class="bars text-white p-4 border-t-dark w-full text-left" id="btn">
         Mode <i class="fa fa-moon" id="ic"></i>
      </button>
      <li class="list p-1 w-full bg-red-500 hover:bg-red-400">
        <a href="./logout.php" class="link text-white w-full block p-3 w-full">Logout</a>
      </li>
    </ul>
  </div>