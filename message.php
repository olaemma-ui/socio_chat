<?php
  if (isset($_GET["id"])) {
    $receive = $_GET["id"];
    include "includes/header1.php";
    include "includes/session.php";
    include "includes/connect.php";
?>
<div class="flex lg:flex-nowrap flex-wrap border-t-dark h-full fixed w-full">

  <div class="side-nav bg-darker shadow-xl lg:w-96 w-full md:h-full lg:visible invisible lg:relative absolute overflow-y-auto text-sm p-2" id="sidebar">
    <div class="search w-full">
      <input type="text" class="w-full p-3 md:text-xl text-sm"placeholder="@Search   { Username }" id="search">
    </div>
    <div class="friends w-full overflow-y-auto" id="friends">
    </div>
    <ul class="tabs" id="notify">

    </ul>
  </div>
  <div class="content h-full lg:w-11/12 w-full h-full flex flex-col justify-end bg-dark testimonials shadow-xl">
    <div class="bg-darker fixed top-10 mt-2  w-full h-10">
      <?php

      $select = "SELECT * FROM user WHERE userid = '".$receive."'";
      $query = mysqli_query($con,$select);
      while ($row = mysqli_fetch_array($query)) {
        ?>
          <div class="text-white w-full block md:mt-2 p-2 shadow-xl flex bg-darker
            border-t-dark " onclick="toggle()"   style="align-items: center;">
            <img src="assets/uploads/<?=$row["img"]?>" class="rounded-full w-12
            h-12" alt="">
            <div class="flex flex-col w-full">
              <p class="txt flex text-md ml-2 flex justify-between"
                style="align-items: center;">
                <span><?=$row["username"]?></span>
              </p>
            </div>
          </div>
        <?php }
      ?>
    </div>
    <div class="message flex flex-col pb-16 md:pb-24  pt-20 overflow-y-auto" id="message">
      <div class="text-white justify-start flex flex-col">
        <?php
          $select = "SELECT * FROM messages WHERE message_id = '".sha1($_GET["id"].$_SESSION
          ["userid"])."' OR message_id = '".sha1($_SESSION["userid"].$_GET["id"])."'";
          $query = mysqli_query($con, $select);
          if ($query) {
            while ($row = mysqli_fetch_array($query)) {
              if ($_SESSION["userid"] == $row["sender"]) {
                ?>
                  <div class="receiver flex flex-col bg-blue-900 p-2 md:w-4/12 w-3/4 m-2
                    rounded-xl" style="align-self: flex-end;">
                    <span class="txt text-white ">

                      <?php
                        if (!empty($row["img"])) {
                          $s = stripos($row["img"], ".");
                          $ext = substr($row["img"], ($s+1));
                          $img = array("jpg"=>"image/jpg", "png"=>"image/png","jpeg"=>"image/
                          jpeg","gif"=>"image/gif");
                          if (array_key_exists(strtolower($ext), $img)) { ?>
                            <img src="assets/uploads/<?=$row["img"]?>" onclick="zoom(this.src)" class="w-full max-h-64 rounded cursor-pointer" alt="" srcset="">
                          <?php }
                        }
                      ?>
                      <p class="txt  w-full" style="word-wrap: break-word;">
                        <?=$row["message"]?>
                      </p>
                    </span>
                    <spn class="time  text-xs text-right text-dark-200">
                      <span class="note">
                        <i class="fa fa-check"></i>
                      </span>
                      <?php
                        if(getdate()["mday"] == $row["date"][8].$row["date"][9]){
                          echo substr($row["date"], 10);
                        }
                        else{
                          echo substr($row["date"], 0, 10)."<br>".substr($row["date"], 10);
                        }
                      ?>
                    </spn>
                  </div>
                <?php
              }else{
                ?>
                  <div class="sender bg-darker p-2 m-2 md:w-4/12 w-3/4 m-2
                    rounded-xl text-white
                    flex flex-col ">
                    <span class="txt text-white">
                      <?php
                        if (!empty($row["img"])) {
                          $s = stripos($row["img"], ".");
                          $ext = substr($row["img"], ($s+1));
                          $img = array("jpg"=>"image/jpg", "png"=>"image/png","jpeg"=>"image/
                          jpeg","gif"=>"image/gif");
                          if (array_key_exists(strtolower($ext), $img)) { ?>
                            <img src="assets/uploads/<?=$row["img"]?>" onclick="zoom(this.src)" class="w-full rounded max-h-64 cursor-pointer" alt="" srcset="">
                          <?php }
                        }
                      ?>
                      <p class="txt  w-full" style="word-wrap: break-word;">
                        <?=$row["message"]?>
                      </p>
                    </span>

                    <spn class="time  text-xs text-right text-dark-200">
                      <span class="note">
                        <i class="far fa-clock"></i>
                      </span>
                        <?php
                          if(getdate()["mday"] == $row["date"][8].$row["date"][9]){
                            echo substr($row["date"], 10);
                          }
                          else{
                            echo substr($row["date"], 0, 10)."<br>".substr($row["date"], 10)  ;
                          }
                        ?>
                    </spn>

                  </div>
                <?php
              }

            }
          }
        ?>
      </div>
    </div>
    <div class="send shdow-xl bg-darker sticky bottom-0 w-full border-t-dark">
      <form action="" method="POST" class="flex flex-nowrap p-2 md:justify-center lg:justify-start xl:justify-center" style="align-items: center;" enctype="multipart/form-data" id="form">
        <label for="doc" class="rounded-full bg-blue-700 text-white text-center p-1 w-8 h-8 cursor-pointer mr-2">
          <i class="fa fa-plus"></i>
          <input type="file" id="doc" class="rounded-full hidden" name="doc" id="doc">
        </label>
        <textarea name="message" id="mes" cols="30" rows="10" class="rounded h-10 p-2 w-full" placeholder="Text message"></textarea>
        <button class="btn bg-green-700 rounded-full lg:rounded ml-2 lg:w-14 w-10 h-10" name="send" id="send">
          <i class="far fa-comment-alt text-white"></i>
        </button>
      </form>
    </div>
  </div>
  <div class="profile bg-darker border-l-dark shadow-xl w-1/4 md:visible invisible md:mt-16">
      <?php
        $select = "SELECT * FROM user WHERE userid = '".$receive."'";
        $que = mysqli_query($con, $select);
        while ($row = mysqli_fetch_array($que)) {
      ?>
      <div class="img p-3" style="align-items: center;">
        <img src="assets/uploads/<?=$row["img"]?>" alt="" class="rounded-full w-20">
        <div class="txt ">
          <span class="text-sm mt-5 block" style="color: gray;">Username</span>
          <p class="txt text-white border-b-dark p-2"><?=$row["username"]?></p>

          <span class="text-sm mt-5 block" style="color: gray;">Full name</span>
          <p class="txt text-white border-b-dark p-2">
            <?php
              $str = strtoupper($row["firstName"][0]).substr($row["firstName"], 1);
              echo $str. " &nbsp ";
              $str = strtoupper($row["lastName"][0]).substr($row["lastName"], 1);
              echo $str;
            ?></p>

          <span class="text-sm mt-5 block" style="color: gray;">Gender </span>
          <p class="txt text-white text-md mt-2 border-b-dark p-3"><?=strtoupper($row["gender"][0]).substr($row["gender"], 1);?></p>

          <span class="text-sm mt-5 block" style="color: gray;">E-mail address</span>
          <p class="txt text-white text-md mt-2 border-b-dark p-3"><?=$row["email"]?></p>

          <span class="text-sm mt-5 block" style="color: gray;">Country </span>
          <p class="txt text-white text-md mt-2 border-b-dark p-3"><?=strtoupper($row["country"][0]).substr($row["country"], 1);?></p>
        </div>
      </div>

      <?php
        }
      ?>
  </div>
</div>
<div class="modal cursor-pointer">
  <div id="txt_img" class="fa-3x text-white"></div>
  <img src="" class="modalimg" alt="" onclick="document.getElementsByClassName('modal')[0].style.display = 'none'">
</div>
<script>
  var modal = document.querySelectorAll(".modal");
  var modalImg = document.querySelectorAll(".modalimg");
  function zoom(e) {
    modal[0].style.display = "block";
    modalImg[0].src = e;
    document.getElementById("txt_img").innerText = document.getElementById("txt_img").innerText.substring(14, e.length);
  }
  onload = scroll();
  function scroll() {
     var div = document.querySelector("#message");
     div.scrollTop = div.scrollHeight
  }
  var t = setInterval(load_msg, 1000);
  function load_msg () {
    var xml = new XMLHttpRequest();
    xml.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("message").innerHTML = this.responseText;
      }
    }
    xml.open("POST", 'messageAction.php?id=<?=$receive?>', true);
    xml.send();
  }
  document.querySelector("#send").addEventListener("click",function (e) {
     e.preventDefault();
    var form = new FormData(document.getElementById("form"));
    var xml = new XMLHttpRequest();
    xml.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("message").innerHTML = this.responseText;
        scroll();
        document.getElementById("mes").innerHTML = "";
      }
    };
    xml.open("POST", 'messageAction.php?id=<?=$receive?>', true);
    xml.send(form);
  })
</script>
<?php
include "includes/footer.php";
    }else header("location: error.php");

?>