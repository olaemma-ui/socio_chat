<?php
  include "includes/header1.php";
  include "includes/session.php";
  $user = $_SESSION["userid"];
?>

  <div class="wrapper bg-darker md:p-10 p-1 flex flex-wrap justify-between">

    <div class="col-3 shadow md:order-1 order-3 md:w-1/5 w-full">
      <div class="card">
        <div class="card-body">
          <div class="card-content">
            <p class="card-title text-xl">
              <!-- Friends <i class="fa fa-users"></i> -->
            </p>
          </div>
        </div>
      </div>
    </div>
    <div class="col-6 shadow md:order-2 order-1 w-full md:w-6/12 body">

      <div class="flex shadow justify-between overflow-x-auto p-1 border-b">

        <div class="w-4/5">
          <div class="user h-40 w-32 rounded-xl m-2 shadow-md">
            <div class="color h-full rounded-xl p-3 flex flex-col justify-end">
              <button class="plus bg-darker text-center rounded-full h-10 w-10">
                <i class="fa fa-plus text-white"></i>
              </button>
            </div>
          </div>
        </div>

        <div class="flex">
        <div class="user h-40 w-32 rounded-xl m-2 shadow-md">
            <div class="color h-full rounded-xl p-3 flex flex-col justify-end">
              <button class="plus bg-darker text-center rounded-full h-10 w-10">
                <i class="fa fa-wifi text-white"></i>
              </button>
            </div>
          </div>
          <div class="user h-40 w-32 rounded-xl m-2 shadow-md">
            <div class="color h-full rounded-xl p-3 flex flex-col justify-end">
              <button class="plus bg-darker text-center rounded-full h-10 w-10">
                <i class="fa fa-wifi text-white"></i>
              </button>
            </div>
          </div>

          <div class="user h-40 w-32 rounded-xl m-2 shadow-md">
            <div class="color h-full rounded-xl p-3 flex flex-col justify-end">
              <button class="plus bg-darker text-center rounded-full h-10 w-10">
                <i class="fa fa-wifi text-white"></i>
              </button>
            </div>
          </div>

          <div class="user h-40 w-32 rounded-xl m-2 shadow-md">
            <div class="color h-full rounded-xl p-3 flex flex-col justify-end">
              <button class="plus bg-darker text-center rounded-full h-10 w-10">
                <i class="fa fa-wifi text-white"></i>
              </button>
            </div>
          </div>

          <div class="user h-40 w-32 rounded-xl m-2 shadow-md">
            <div class="color h-full rounded-xl p-3 flex flex-col justify-end">
              <button class="plus bg-darker text-center rounded-full h-10 w-10">
                <i class="fa fa-wifi text-white"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
      <div class="upload shadow">
        <p class="txt text-2xl p-2 text-white">
          Upload a Post
        </p>
        <form action="" method="POST" class="p-3 flex flex-col">
          <textarea name="txt" placeholder="Content" id="" cols="30" rows="10" class="bg-dark p-2 rounded w-full h-20 text-white"></textarea>
          <input type="file" name="file" id="" class="w-full mt-2 mb-2 text-white bg-dark p-1 rounded">
          <button class="upl bg-green-500 p-2 text-white self-end w-20" type="submit">
            Upload
          </button>
        </form>
      </div>
      <div class="card">
        <div class="card-body shadow m-3 b-green-400">
          <a href="" class="card-content p-2 flex shadow-xl" style="align-items: center;">
            <img src="assets/img/Vector_2648.jpg" class="w-12 h-12 rounded-full" alt="">
            <p class="card-title text-white text-md pl-2 flex flex-col">
              <span>
                Morenikeji Zainab
              </span>
              <small>
                12 09-AM 22-09-2021
              </small>
            </p>
          </a>

          <div class="post p-3 flex flex-col">
            <div class="txt text-white shadow-xl p-2">
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis reprehenderit fugit molestiae cupiditate natus dolorum vel, minus totam eveniet voluptate ad, modi, accusamus nesciunt distinctio veniam commodi exercitationem. Unde, quae.
            </div>
            <div class="flex img flex-wrap">
              <img src="assets/img/Vector_2648.jpg" alt="" class="w-1/2 md:h-80 p-1 h-40">
              <img src="assets/img/log.png" alt="" class="w-1/2 p-1 md:h-80 h-40">
            </div>
          </div>
        </div>
      </div>


    </div>

    <div class="col-3  shadow md:order-3 order-2 md:w-1/5 w-full">
      <div class="card">
        <div class="card-body">
          <div class="card-content">
            <p class="card-title text-xl">
              <!-- Notification <i class="far fa-bell"></i> -->
            </p>
          </div>
        </div>
      </div>
    </div>

  </div>

<?php include "includes/footer.php"?>