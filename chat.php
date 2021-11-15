<?php
  include "includes/header1.php";
  include "includes/connect.php";
  include "includes/session.php";
  $user = $_SESSION["userid"];
?>
<div class="flex lg:flex-nowrap flex-wrap border-t-dark h-full fixed w-full">

  <div class="side-nav bg-darker shadow-xl lg:w-96 w-full h-full overflow-y-auto" id="sidebar">
    <div class="search w-full">
      <input type="text" class="w-full p-3 md:text-xl text-sm" placeholder="@Search { Username }" id="search">
    </div>
    <div class="friends w-full overflow-y-auto" id="friends">
    </div>
    <ul class="tabs p-1 h-full" id="notify">
    </ul>
  </div>
  <div class="content h-full lg:w-11/12 w-full h-full flex flex-col justify-center bg-dark testimonials shadow-xl" id="message" style="align-items: center;">
      <div class="message flex flex-col pb-32 overflow-y-autobg-green-300">
        <p class="text-white text-center logo md:text-7xl text-3xl">
          Socio <i class="text-blue-400 md:text-9xl md:text-5xl far fa-comment-alt"></i>
        </p>
    </div>
  </div>
</div>
<?php include "includes/footer.php"?>