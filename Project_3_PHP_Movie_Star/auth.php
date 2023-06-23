<?php

  include_once("templates/header.php");

?>
  <div id="main-container" class="container-fluid">
    <div class="col-md-12">
      <div class="row" id="auth-row">
        <div class="col-md-4" id="login-container">
          <h2>Sign in</h2>
          <form action="<?= $BASE_URL ?>auth_process.php" method="POST">
            <input type="hidden" name="type" value="login">
            <div class="form-group">
              <label for="email">Mail:</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="Enter your mail">
            </div>
            <div class="form-group">
              <label for="password">Password:</label>
              <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
            </div>
            <input type="submit" class="btn card-btn" value="Sign in">
          </form>
        </div>
        <div class="col-md-4" id="register-container">
          <h2>Create Account</h2>
          <form action="<?= $BASE_URL ?>auth_process.php" method="POST">
            <input type="hidden" name="type" value="register">
            <div class="form-group">
              <label for="email">Mail:</label>
              <input type="email" class="form-control" id="mail" name="mail" placeholder="Type your mail">
            </div>
            <div class="form-group">
              <label for="name">Name:</label>
              <input type="text" class="form-control" id="name" name="name" placeholder="Type your name">
            </div>
            <div class="form-group">
              <label for="lastname">Last name:</label>
              <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Type your last name">
            </div>
            <div class="form-group">
              <label for="password">Password:</label>
              <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
            </div>
            <div class="form-group">
              <label for="confirmpassword">Password confirmation:</label>
              <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" placeholder="Confirm the password">
            </div>
            <input type="submit" class="btn card-btn" value="Sign up">
          </form>
        </div>
      </div>
    </div>
  </div>
<?php

  include_once("templates/footer.php");

?>