<?php
  include "includes/header.php";
?>
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
          Login
        </p>
        <div class="form-body mt-5">
        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
              include "login.php";

              if (isset($alert)) {?>
                  <div class="alert md:m-10 md:mb-0 p-3 bg-red-400 rounded text-white shadow-md">
                    <?=$alert?>
                  </div>
              <?php }
            }
          ?>
          <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST" class="md:p-10 md:pt-5">
            <label for="email" class="font-bold text-md">
              Username<sup class="text-md">*</sup>
              <label for="err" class="text-red-500 text-xs md:inline block">
                <?php
                  if (isset($uname_err[0])) {
                    echo $uname_err[0];
                  }
                ?>
              </label>
            </label>
            <label for="email" class="block rounded w-full border flex align-middle bg-darker text-white">
              <i class="far fa-envelope p-3 pl-4 text-xl"></i>
              <input type="text" name="uname[]" class="ml-2 w-full h-full p-4 border-l text-blue-400 rounded-none" id="email"
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
              <i class="far fa-eye-slash p-3 text-xl"></i>
              <input type="password" name="psw[]" class="ml-2 w-full h-full p-4 border-l text-blue-400 rounded-none" id="psw"
              value="<?php
                if (isset($psw[0])){
                  echo $psw[0];
                }
              ?>">
            </label>

            <button class="btn p-2 text-white mt-3 rounded bg-green-500 text-lg w-full" name="login" type="submit">
              Signin
            </button>

            <span class="mt-10 block text-right">
              Dont't have an Account ?
              <a href="signup.php" class="p-2 bg-darker text-white">
                Signup
              </a>
            </span>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php include "includes/footer.php"?>