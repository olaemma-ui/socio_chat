<?php
    include "includes/session.php";
    include "includes/connect.php";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $success = "loading";
      if (isset($_POST["message"]) || isset($_FILES["doc"])) {
          $txt = $_POST["message"];
          $bool = 0;
          $file_name = "";
          if (isset($_FILES["doc"]) && !empty($_FILES["doc"])) {
            $folder = "assets/uploads/";
            $folder = $folder.basename($_FILES["doc"]["name"]);
            $ext = strtolower(pathinfo($folder, PATHINFO_EXTENSION));
            $valid = array(
              "jpg"=>"image/jpg", "png"=>"image/png","jpeg"=>"image/jpeg","gif"=>"image/gif", "mp4"=>"video/mp4", "mp3"=>"audio/mp3", "html"=>"text/html", "css"=>"text/css", "js"=>"text/js");
            if (array_key_exists($ext, $valid)) {
              if (move_uploaded_file($_FILES["doc"]["tmp_name"], $folder)) {
                $bool++;
                $file_name = $_FILES["doc"]["name"];
              }
            }
          }else{
            echo '
              <script>alert("File too large")</script>
            ';
          }
          if (!empty($_POST["message"])) {
            $bool++;
          }
          if ($bool > 0) {
            $mess_id = sha1($_GET["id"].$_SESSION["userid"]);
            $insert = "INSERT INTO messages values('', '".$txt."', '".$file_name."',      CURRENT_TIMESTAMP(), '".$_SESSION["userid"]."', '".$mess_id."', '".$_GET["id"]."')";
            $query = mysqli_query($con, $insert);
            $_POST["message"] = "";
            $_FILES["doc"] = "";
            if ($query) {
              $success = "sent";
              $select = "SELECT * FROM recent WHERE message_id = '".$mess_id."' OR message_id = '".sha1($_SESSION["userid"].$_GET["id"])."'";
              $query = mysqli_query($con, $select);
              if (mysqli_num_rows($query) > 0) {
                $update = "UPDATE recent SET message = '".$txt."', img = '".$file_name."',date =  CURRENT_TIMESTAMP(), sender = '".$_SESSION["userid"]."',receiver = '".$_GET["id"]."' WHERE message_id = '".$mess_id."' OR message_id = '".sha1($_SESSION["userid"].$_GET["id"])."'";
                $up_query = mysqli_query($con, $update);
              }else{
                $insert = "INSERT INTO recent values('', '".$txt."', '".$file_name."',      CURRENT_TIMESTAMP(), '".$_SESSION["userid"]."', '".$mess_id."', '".$_GET["id"]."')";
                $query = mysqli_query($con, $insert);
              }

              $select = "SELECT * FROM friends WHERE messageId = '".$mess_id."' OR messageId = '".sha1($_SESSION["userid"].$_GET["id"])."'";
              $query = mysqli_query($con, $select);
              if (mysqli_num_rows($query) > 0) {
                $update = "UPDATE friends SET status = '1' WHERE messageId = '".$mess_id."' OR messageId = '".sha1($_SESSION["userid"].$_GET["id"])."'";
                $up_query = mysqli_query($con, $update);
              }else{
                $insert = "INSERT INTO friends values('', '".$_GET["id"]."', '".$_SESSION["userid"]."',  CURRENT_TIMESTAMP(),'0', '".$mess_id."')";
                $query = mysqli_query($con, $insert);
              }
            }
          }else $success = "not sent";
      }
      $select = "SELECT * FROM messages WHERE message_id = '".sha1($_GET["id"].$_SESSION["userid"])."' OR message_id = '".sha1($_SESSION["userid"].$_GET["id"])."'";
      $query = mysqli_query($con, $select);
      if ($query) {
        while ($row = mysqli_fetch_array($query)) {
              if ($_SESSION["userid"] == $row["sender"]) {
                ?>
                  <div class="receiver flex flex-col bg-blue-900 p-2 md:w-4/12 w-3/4 m-2
                    rounded-xl" style="align-self: flex-end;">
                    <span class="txt text-white">

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
                    <spn class="time text-xs text-right text-dark-200">
                      <span class="note">
                        <i class="fa fa-check"></i>
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
                              <img src="assets/uploads/<?=$row["img"]?>" onclick="zoom(this.src)" class="w-full max-h-64 rounded cursor-pointer" alt="" srcset="">
                          <?php }
                        }
                      ?>
                      <p class="txt w-full" style="word-wrap: break-word;">
                        <?=$row["message"]?>
                      </p>
                    </span>

                    <spn class="time text-xs text-right text-dark-200">
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
  }
    else header("location: chat.php");

?>