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
  <div class="bg-darke fixed top-10 mt-2  w-full h-10">
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
    <div class="message flex flex-col pb-16 md:pb-24 overflow-y-auto" id="message">
      <div class="text-white justify-start flex flex-col">
        <?php
          $select = "SELECT * FROM messages WHERE message_id = '".sha1($_GET["id"].$_SESSION
          ["userid"])."' OR message_id = '".sha1($_SESSION["userid"].$_GET["id"])."'";
          $query = mysqli_query($con, $select);
          if ($query) {
            while ($row = mysqli_fetch_array($query)) {
              if ($_SESSION["userid"] == $row["sender"]) {
                ?>
                  <div class="receiver flex flex-col bg-blue-900 p-2 lg:w-1/4 md:w-4/12 w-3/4 m-2
                    rounded" style="align-self: flex-end;">
                    <span class="txt text-white ">

                      <?php
                        if (!empty($row["img"])) {
                          $s = stripos($row["img"], ".");
                          $ext = substr($row["img"], ($s+1));
                          $img = array("jpg"=>"image/jpg", "png"=>"image/png","jpeg"=>"image/
                          jpeg","gif"=>"image/gif");
                          if (array_key_exists(strtolower($ext), $img)) { ?>
                            <img src="assets/uploads/<?=$row["img"]?>" class="w-full
                            max-h-64" alt="" srcset="">
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
                  <div class="sender bg-darker p-2 m-2 lg:w-1/4 md:w-4/12 w-3/4 rounded text-white
                    flex flex-col ">
                    <span class="txt text-white">
                      <?php
                        if (!empty($row["img"])) {
                          $s = stripos($row["img"], ".");
                          $ext = substr($row["img"], ($s+1));
                          $img = array("jpg"=>"image/jpg", "png"=>"image/png","jpeg"=>"image/
                          jpeg","gif"=>"image/gif");
                          if (array_key_exists(strtolower($ext), $img)) { ?>
                            <img src="assets/uploads/<?=$row["img"]?>" class="w-full
                            max-h-64" alt="" srcset="">
                          <?php }
                        }
                      ?>
                      <p class="txt  w-full" style="word-wrap: break-word;">
                        <?=$row["message"]?>
                      </p>
                    </span>

                    <spn class="time  text-xs text-right text-dark-200">
                      <span class="note">
                        <i class="far fa-user-circle"></i>
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
        <textarea name="message" id="mes" cols="30" rows="10" class="rounded h-10 p-2 w-9/12" placeholder="Text message" id="txt"></textarea>
        <button class="btn bg-green-700 rounded-full lg:rounded ml-2 lg:w-14 w-10 h-10" name="send" id="send">
          <i class="far fa-comment-alt text-white"></i>
        </button>
      </form>
    </div>
  </div>
</div>
<script>
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
        scroll();
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