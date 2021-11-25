<?php
    include "includes/header1.php";
    include "includes/session.php";
    include "includes/connect.php";
?>
<div class="flex lg:flex-nowrap flex-wrap border-t-dark h-full fixed w-full">

  <div class="side-nav bg-darker shadow-xl lg:w-80 w-full md:h-full lg:visible invisible lg:relative absolute overflow-y-auto" id="sidebar">
  <div class="search w-full">
      <input type="text" class="w-full p-3 md:text-xl text-sm" placeholder="@Search { Username }" id="search">
    </div>
    <div class="friends w-full overflow-y-auto" id="friends"></div>
    <ul class="tabs p-1 h-full" id="notify"></ul>
  </div>
  <div class="content h-full lg:w-11/1 w-full h-full flex md:flex-row flex-col bg-dark testimonials shadow-xl overflow-y-auto md:pb-0 pb-24">
    <div class="img-profile p-3 flex md:justify-start justify-center" style="align-items: baseline;">
      <img src="assets/uploads/avatar3.png" class="md:w-80 w-40" alt="" srcset="">
      <label for="upl" class="upload relative right-5 text-center text-white rounded-full md:w-12 md:h-12 w-12 h-8 p-1 md:p-4 md:pt-3 cursor-pointer bg-green-800">
        <i class="fa fa-plus"></i>
      </label>
      <input type="file" name="upl" class="invisible" id="upl">
    </div>
    <div class="details w-full">
      <p class="text-3xl m-0 p-2 border-b-dark" style="color: gray;">
        Details
      </p>
      <div class="form p-3 bg-dark">
        <div class="form-body">
          <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update"])) {
              include "update_profile.php";
              if (isset($alert)) {?>
                <div class="alert mb-5 md:mt-0 p-3 bg-green-800 rounded text-white shadow-md">
                  <?=$alert?>
                </div>
            <?php }
            }
          ?>
          <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"])?>" method="POST">
            <?php
            $query = mysqli_query($con, "SELECT * FROM user WHERE userID = '".$_SESSION["userid"]."'");
            while ($row = mysqli_fetch_array($query)) {
            ?>
            <div class="md:flex justify-between">
              <div class="w-full mr-1">
              <span class="md:inline block md:text-sm txt mb-2 mt-3" style="color: gray;">First name: </span>
              <label for="err" class="md:pl-5 text-red-400 text-xs md:inline block">
                <?php
                  if (isset($name_err[0])) {
                    echo $name_err[0];
                  }
                ?>
              </label>
              <input type="text" name="name[]" class="txt p-1 text-blue-400 w-full bg-darker h-14 border-b-dark"
              value="<?php
                if (isset($name[0])) {
                  echo $name[0];
                }else{
                  echo $name[0] = $row["firstName"];
                }
              ?>">
              </div>

              <div class="w-full ml-1">
              <span class="md:inline block md:text-sm txt mb-2 mt-3" style="color: gray;">Last name: </span>
              <label for="err" class="md:pl-5 text-red-400 text-xs md:inline block">
                <?php
                  if (isset($name_err[1])) {
                    echo $name_err[1];
                  }
                ?>
              </label>
              <input type="text" name="name[]" class="txt p-1 text-blue-400 w-full bg-darker h-14 border-b-dark"
              value="<?php
                if (isset($name[1])) {
                  echo $name[1];
                }else{
                  echo $name[1] =$row["lastName"];
                }
              ?>"
              >
              </div>
            </div>

            <span class="md:inline block md:text-sm txt mb-2 mt-3" style="color: gray;">Username: </span>
            <label for="err" class="md:pl-5 text-red-400 text-xs md:inline block">
                <?php
                  if (isset($uname_err[0])) {
                    echo $uname_err[0];
                  }
                ?>
              </label>
            <input type="text" name="uname[]" class="txt p-1 text-blue-400 w-full bg-darker h-14 border-b-dark"
            value="<?php
                if (isset($uname[0])) {
                  echo $uname[0];
                }else{
                  echo $uname[0] = $row["username"];
                }
              ?>"
            >

            <span class="md:inline block md:text-sm txt mb-2 mt-3" style="color: gray;">E-mail: </span>
            <label for="err" class="md:pl-5 text-red-400 text-xs md:inline block">
                <?php
                  if (isset($email_err[0])) {
                    echo $email_err[0];
                  }
                ?>
              </label>
            <input type="text" name="email[]" class="txt p-1 text-blue-400 w-full bg-darker h-14 border-b-dark"
            value="<?php
                if (isset($email[0])) {
                  echo $email[0];
                }else{
                  echo $email[0] =$row["email"];
                }
              ?>"
            >

            <span class="block md:text-sm txt mb-2 mt-3 " style="color: gray;">Gender: </span>
            <select name="gen" id="gender" class="bg-darker text-md w-full h-full p-4 text-blue-400 rounded-none">
                  <option class="text-xl" value="<?php if (isset($gen)){echo $gen;}else echo $gen = $row["gender"];?>">
                  <?php if (isset($gen)){echo $gen;}else echo $gen = $row["gender"];?>
                    </option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>

            <span class="md:inline block md:text-sm txt mb-2 mt-3" style="color: gray;">Country: </span>
            <label for="err" class="md:pl-5 text-red-400 text-xs md:inline block">
                <?php
                  if (isset($name_err[2])) {
                    echo $name_err[2];
                  }
                ?>
              </label>
            <input type="text" name="name[]" class="txt p-1 text-blue-400 w-full bg-darker h-14 border-b-dark"
            value="<?php
                if (isset($name[2])) {
                  echo $name[2];
                }else{
                  echo $name[2] = $row["country"];
                }
              ?>"
            >
        <?php }?>
            <button class="btn bg-green-800 text-white p-3 mt-3" name="update">
              Update <i class="far fa-user-circle"></i>
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php include "includes/footer.php";?>