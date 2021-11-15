<?php
  include "includes/connect.php";
  include "includes/session.php";

  $user = "SELECT user.userid FROM USER";
  $q = mysqli_query($con, $user);
  while ($a = mysqli_fetch_array($q)) {
    $select = "SELECT * FROM recent WHERE recent.message_id = '".sha1($a["userid"].$_SESSION["userid"])."' OR recent.message_id = '".sha1($_SESSION["userid"].$a["userid"])."'    ORDER  BY recent.date DESC";
    $query = mysqli_query($con,$select);
    while ($row = mysqli_fetch_array($query)) {
      $select2 = "SELECT * FROM user WHERE userid = '".$row["receiver"]."'";
      $query = mysqli_query($con,$select2);
      while ($r = mysqli_fetch_array($query)) {
      if ($row["receiver"] != $_SESSION["userid"]) {
      ?>
      <li class="list">
        <a href="message.php?id=<?=$r["userID"]?>" class="link text-white w-full block    p-2  shadow-xl flex bg-darker-h border-b-dark " style="align-items: center;">
          <img src="assets/uploads/<?=$r["img"]?>" class="rounded-full w-12 h-12" alt="">
          <div class="flex flex-col w-full">
            <p class="txt flex text-md ml-2 flex justify-between"  style="align-items:      center;">
              <span><?=$r["username"]?></span>
              <span class="date text-xs text-dark-200">
                <?php
                  if(getdate()["mday"] == $row["date"][8].$row["date"][9]){
                    echo substr($row["date"], 10);
                  }
                  else{
                    echo substr($row["date"], 0, 10)."<br>".substr($row["date"], 10);
                  }
                ?>
              </span>
            </p>
            <p class="txt text-left text-xs ml-2 mt-2 p-1" style="color: gray;">
              <?=$row["message"]?>
            </p>
          </div>
        </a>
      </li>
      <?php }
        else if($row["sender"] != $_SESSION["userid"]){
          $select2 = "SELECT * FROM user WHERE userid = '".$row["sender"]."'";
          $query = mysqli_query($con,$select2);
          while ($r = mysqli_fetch_array($query)) {
          ?>
            <li class="list">
              <a href="message.php?id=<?=$r["userID"]?>" class="link text-white
                w-full block p-2 shadow-xl flex bg-darker-h border-b-dark "
                style="align-items:      center;">
                <img src="assets/uploads/<?=$r["img"]?>" class="rounded-full
                  w-12 h-12"   alt="">
                <div class="flex flex-col w-full">
                  <p class="txt flex text-md ml-2 flex justify-between"
                    style="align-items: center;">
                    <span><?=$r["username"]?></span>
                    <span class="date text-xs text-dark-200">
                    <?php
                      if(getdate()["mday"] == $row["date"][8].$row["date"][9]){
                        echo substr($row["date"], 10);
                      }
                      else{
                        echo substr($row["date"], 0, 10)."<br>".substr($row["date"]   , 10);
                      }
                    ?>
                    </span>
                  </p>
                  <p class="txt text-left text-xs ml-2  text-blue-400 mt-2 p-1">
                    <?=$row["message"]?>
                  </p>
                </div>
              </a>
            </li>
            <?php
          }
        }
      }
    }
  }
?>
