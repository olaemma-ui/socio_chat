<?php
  include "includes/connect.php";
  include "includes/session.php";
  $user = $_SESSION["userid"];
  $id = $_GET["id"];
  if (isset($id) && $_SERVER["REQUEST_METHOD"] == "GET") {
    $select = "SELECT * FROM user where username LIKE '%".$id."%'";
    $query = mysqli_query($con, $select);
    while ($row = mysqli_fetch_array($query)) {
      if ($_SESSION["userid"] != $row["userID"]) {
      ?>
      <ul class="tabs p-1">
        <li class="list">
          <div class="link text-white w-full block p-2 shadow-xl flex bg-darker-h border-b-dark " style="align-items: center;">
              <img src="assets/uploads/<?=$row["img"]?>" class="rounded-full w-12 h-12" alt="">
              <div class="flex flex-col w-full">
                <p class="txt flex text-md ml-2 flex justify-between"  style="align-items: center;">
                  <span><?=$row["username"]?></span>
                </p>
                <div class="txt text-left text-xs ml-2  text-dark-200 mt-2 p-1">
                  <a href="message.php?id=<?=$row["userID"]?>" class="btn bg-green-700 p-2 text-sm text-white">
                    <i class="far fa-comment-alt"></i> Message
                  </a>
                </div>
              </div>
          </div>
        </li>
      </ul>
      <?php
      }
    }
  }else{
    header("location: index.php");
  }

?>