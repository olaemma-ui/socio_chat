<?php
    include "includes/header1.php";
    include "includes/session.php";
    include "includes/connect.php";
?>
<div class="flex lg:flex-nowrap flex-wrap border-t-dark h-full fixed w-full">

  <div class="side-nav bg-darker shadow-xl lg:w-96 w-full md:h-full lg:visible invisible lg:relative absolute overflow-y-auto" id="sidebar">
    <ul class="tabs p-1">

    <?php
      $select = "SELECT * FROM friends INNER JOIN user ON friends.receiver = user.userID WHERE friends.sender = '".$_SESSION["userid"]."'";
      $query = mysqli_query($con,$select);
      while ($row = mysqli_fetch_array($query)) {
        ?>
        <li class="list">
          <a href="message.php?id=<?=$row["userID"]?>" class="link text-white w-full block p-2 shadow-xl flex bg-darker-h border-b-dark " onclick="toggle()" style="align-items: center;">
            <img src="assets/uploads/<?=$row["img"]?>" class="rounded-full w-12 h-12" alt="">
            <div class="flex flex-col w-full">
              <p class="txt flex text-md ml-2 flex justify-between"  style="align-items: center;">
                <span><?=$row["username"]?></span>
                <span class="date text-xs text-dark-200">
                  <?= $row["date"]?>
                </span>
              </p>
              <p class="txt text-left text-xs ml-2  text-dark-200 mt-2 p-1">
                Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet
              </p>
            </div>
          </button>
        </li>
        <?php }
    ?>

    </ul>
  </div>
  <div class="content h-full lg:w-11/12 w-full h-full flex flex-col justify-end bg-dark testimonials shadow-xl" id="message">
    <div class="message flex flex-col pb-16 md:pb-24 overflow-y-auto">
      <div class="text-white justify-start flex flex-col">

        <div class="sender bg-darker p-2 m-2 md:w-4/12 w-3/4  rounded text-white flex flex-col ">
          <span class="text-white">
            Hello Lorem ipsum dolor sit amet consectetur adipisicing elit.
          </span>
          <spn class="time mt-3 text-xs text-right text-dark-200">
            <span class="note pr-3">
              <i class="far fa-user-circle"></i>
            </span>
            09-08
          </spn>
        </div>

        <div class="receiver flex flex-col bg-blue-900 p-2 md:w-4/12 w-3/4 m-2 rounded" style="align-self: flex-end;">
          <span class="txt text-white">
            Hi bro Lorem ipsum dolor sit, amet consectetur adipisicing elit.
          </span>
          <spn class="time mt-3  text-xs text-right text-dark-200">
            09-08
            <span class="note">
              <i class="fa fa-check"></i>
            </span>
          </spn>
        </div>

      </div>
    </div>
    <div class="send shdow-xl bg-darker sticky bottom-0 w-full border-t-dark">
      <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["send"])) {
            if (isset($_POST["message"]) || isset($_FILES["doc"])) {
                echo $txt = $_POST["message"];
                print_r($file = $_FILES["doc"]);
                if (isset($_FILES["doc"])) {
                  $folder = "assets/uploads/";
                  $folder = $folder.basename($_FILES["doc"]["name"]);
                  $ext = strtolower(pathinfo($folder, PATHINFO_EXTENSION));
                  $valid = array("jpg"=>"image/jpg", "png"=>"image/png",
                  "jpeg"=>"image/jpeg","gif"=>"image/gif", "mp4"=>"video/mp4", "mp3"=>"audio/mp3", "html"=>"text/html", "css"=>"text/css", "js"=>"text/js");
                  $size = getimagesize($_FILES["doc"]["tmp_name"]);
                }
            }
        }
      ?>
      <form action='<?=htmlspecialchars($_SERVER["PHP_SELF"].'?id='.$_GET["id"]);?>' method="POST" class="flex flex-nowrap p-2 md:justify-center lg:justify-start xl:justify-center" style="align-items: center;" enctype="multipart/form-data">
        <label for="doc" class="rounded-full bg-blue-700 text-white text-center p-1 w-8 h-8 cursor-pointer mr-2">
          <i class="fa fa-plus"></i>
          <input type="file" id="doc" class="rounded-full hidden" name="doc">
        </label>
        <textarea name="message" id="mes" cols="30" rows="10" class="rounded h-10 p-2 w-9/12" placeholder="Text message"></textarea>
        <button class="btn bg-green-700 rounded-full lg:rounded ml-2 lg:w-14 w-10 h-10" name="send">
          <i class="far fa-comment-alt text-white"></i>
        </button>
      </form>
    </div>
  </div>
</div>
<?php include "includes/footer.php";
?>


$select = "SELECT * FROM messages WHERE sender = '".$_SESSION["userid"]."' AND receiver = '".$_GET["id"]."'";
      $query = mysqli_query($con, $select);
      if ($query) {
        while ($row = mysqli_fetch_array($query)) {
          ?>
            <!-- <div class="sender bg-darker p-2 m-2 md:w-4/12 w-3/4 rounded text-white flex flex-col "> -->
              <span class="text-white">
                Hi bro Lorem ipsum dolor sit, amet consectetur adipisicing elit. Not sent
              </span>
              <spn class="time mt-3 text-xs text-right text-dark-200">
                <span class="note pr-3">
                  <i class="far fa-user-circle"></i>
                </span>
                09-08
              </spn>
            </div>

            <!-- <div class="receiver flex flex-col bg-blue-900 p-2 md:w-4/12 w-3/4 m-2 rounded"             style="align-self: flex-end;"> -->
              <span class="txt text-white">
                <img src="assets/uploads/<?=$row["img"]?>" alt="" srcset="">
                <?=$row["message"]?>
              </span>
              <spn class="time mt-3  text-xs text-right text-dark-200">
                <span class="note">
                  <i class="fa fa-check"></i>
                </span>
                <?=substr($row["date"], 10)?>
              </spn>
            </div>
            <?php
        }
    }