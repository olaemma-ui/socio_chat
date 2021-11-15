<?php include "includes/header.php"?>
  <div class="md:flex h-screen">
    <div class="c1 bg-darker p-3 flex flex-col md:w-1/2 md:rounded-l md:shadow-xl bg-img justify-center md:p-10 p-5">
      <div class="txt text-white p-2 rounded">
        <p class="font-bold text-5xl rounded" align="center">
          Socio <i class="far fa-comment-alt text-blue-400 text-9xl"></i>
        </p>
      </div>
    </div>
    <div class="md:w-1/2 md:rounded-r p-3 md:shadow-xl testimonials">
      <div class="form flex flex-col justify-center h-full">
        <p class="form-title m-0 md:text-4xl text-3xl p-1">
          Create an Account
        </p>
        <div class="form-body mt-5">
        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["signup"])) {
              include "signin.php";

              if (isset($alert)) {?>
                  <div class="alert md:m-10 md:mb-0 md:mt-0 p-3 bg-red-400 rounded text-white shadow-md">
                    <?=$alert?>
                  </div>
              <?php }
            }
          ?>
          <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"])?>" method="POST" class="md:p-10 md:pt-5">
            <div class="flex flex-wrap justify-between">
              <div class="md:w-6/12 w-full md:p-1 md:pl-0">
                <label for="fname" class="font-bold text-md">
                  First Name<sup class="text-md">*</sup>

                  <label for="err" class="text-red-500 text-xs md:inline block">
                    <?php
                      if (isset($name_err[0])) {
                        echo $name_err[0];
                      }
                    ?>
                  </label>
                </label>
                <label for="fname" class="block rounded w-full border flex align-middle bg-darker text-white">
                  <i class="far fa-user p-3 text-xl"></i>
                  <input type="text" name="name[]" class="ml-2 w-full h-full p-4 border-l text-blue-400 rounded-none" id="fname"
                  value="<?php
                            if (isset($name[0])){
                              echo $name[0];
                            }
                          ?>">
                </label>
              </div>
              <div class="md:w-6/12 w-full md:p-1">
                <label for="lname" class="font-bold text-md">
                  Last Name<sup class="text-md">*</sup>

                  <label for="err" class="text-red-500 text-xs md:inline block">
                    <?php
                      if (isset($name_err[1])) {
                        echo $name_err[1];
                      }
                    ?>
                  </label>
                </label>
                <label for="lname" class="block rounded w-full border flex align-middle bg-darker text-white">
                  <i class="far fa-user p-3 text-xl"></i>
                  <input type="text" name="name[]" class="ml-2 w-full h-full p-4 border-l text-blue-400 rounded-none" id="lname"
                  value="<?php
                            if (isset($name[1])){
                              echo $name[1];
                            }
                          ?>">
                </label>
              </div>
            </div>
            <label for="email" class="font-bold text-md mt-5">
              E-mail<sup class="text-md">*</sup>

              <label for="err" class="text-red-500 text-xs md:inline block">
                    <?php
                      if (isset($email_err[0])) {
                        echo $email_err[0];
                      }
                    ?>
                  </label>
            </label>
            <label for="email" class="block rounded w-full border flex align-middle bg-darker text-white">
              <i class="far fa-envelope p-3 text-xl"></i> <input type="email" name="email[]" class="ml-2 w-full h-full p-4 border-l text-blue-400 rounded-none" id="email"
              value="<?php
                        if (isset($email[0])){
                          echo $email[0];
                        }
                      ?>">
            </label>

            <label for="user" class="font-bold text-md mt-5 block">
              Username<sup class="text-md">*</sup>

              <label for="err" class="text-red-500 text-xs md:inline block">
                    <?php
                      if (isset($uname_err[0])) {
                        echo $uname_err[0];
                      }
                    ?>
                  </label>
            </label>
            <label for="user" class="block rounded w-full border flex align-middle bg-darker text-white">
              <i class="far fa-user p-3 text-xl"></i>
              <input type="text" name="uname[]" class="ml-2 w-full h-full p-4 border-l text-blue-400 rounded-none" id="user"
              value="<?php
                        if (isset($uname[0])){
                          echo $uname[0];
                        }
                      ?>">
            </label>

            <label for="psw" class="font-bold block mt-5 text-md">
              Password<sup class="text-md">*</sup>

              <label for="err" class="text-red-500 text-xs md:inline block">
                    <?php
                      if (isset($psw_err[0])) {
                        echo $psw_err[0];
                      }
                    ?>
                  </label>
            </label>
            <label for="psw" class="block rounded w-full border flex align-middle bg-darker text-white">
              <i class="far fa-eye-slash p-3 pr-2 text-xl"></i>
              <input type="password" name="psw[]" class="ml-2 w-full h-full p-4 border-l text-blue-400 rounded-none" id="psw"
              value="<?php
                        if (isset($psw[0])){
                          echo $psw[0];
                        }
                      ?>">
            </label>

            <label for="cpsw" class="font-bold block mt-5 text-md">
              Confirm Password<sup class="text-md">*</sup>

              <label for="err" class="text-red-500 text-xs md:inline block">
                    <?php
                      if (isset($psw_err[1])) {
                        echo $psw_err[1];
                      }
                    ?>
                  </label>
            </label>
            <label for="cpsw" class="block rounded w-full border flex align-middle bg-darker text-white">
              <i class="far fa-eye-slash p-3 pr-2 text-xl"></i>
              <input type="password" name="psw[]" class="ml-2 w-full h-full p-4 border-l text-blue-400 rounded-none" id="cpsw"
              value="<?php
                        if (isset($psw[1])){
                          echo $psw[1];
                        }
                      ?>">
            </label>

            <button class="btn p-2 text-white mt-3 rounded bg-green-500 text-lg w-full" name="signup" type="submit">
              Signup
            </button>

            <span class="mt-10 block text-right">
              already have an Account ?
              <a href="index.php" class="p-2 bg-darker text-white">
                Login
              </a>
          </span>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php include "includes/footer.php"?>