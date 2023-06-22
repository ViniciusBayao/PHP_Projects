<?php

  require_once("templates/header.php");

  // Check for authentication
  require_once("models/User.php");
  require_once("dao/UserDAO.php");

  $userModel = new User();

  // Verify token, if it's not the correct, redirect to home page
  $auth = new UserDAO($conn, $BASE_URL);

  $userData = $auth->verifyToken();

  $fullName = $userModel->getFullName($userData);

  if($userData->image == "") {
    $userData->image = "user.png";
  }

?>
  <div id="main-container" class="container-fluid">
    <div class="col-md-12">
      <form action="<?= $BASE_URL ?>user_process.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="type" value="update">
        <div class="row"> 
          <div class="col-md-4">
            <h1><?= $fullName ?></h1>
            <p class="page-description">Change your data in the form below:</p>
            <div class="form-group">
              <label for="name">Name:</label>
              <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" value="<?= $userData->name ?>">
            </div>
            <div class="form-group">
              <label for="lastname">Last name:</label>
              <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Enter your last name" value="<?= $userData->lastname ?>">
            </div>
            <div class="form-group">
              <label for="email">Mail:</label>
              <input type="email" class="form-control disabled" id="email" name="email" placeholder="Enter your mail" readonly value="<?= $userData->email ?>">
            </div>
            <input type="submit" class="btn form-btn" value="Alterar">
          </div>
          <div class="col-md-4">
            <div id="profile-image-container" style="background-image: url('<?= $BASE_URL ?>img/users/<?= $userData->image ?>')"></div>
            <div class="form-group">
              <label for="image">Image</label>
              <input type="file" name="image" class="form-control-file">
            </div>
            <div class="form-group">
              <label for="bio">About you:</label>
              <textarea class="form-control" id="bio" name="bio" rows="5" placeholder="Tell us who you are, what you do, where you work..."><?= $userData->bio ?></textarea>
            </div>
          </div>    
        </div> 
      </form> 
      <div class="row" id="change-password-container">
        <div class="col-md-4">
          <h2>Change password:</h2>
          <p class="page-description">Enter new password and confirm to change password:</p>
          <form action="<?= $BASE_URL ?>user_process.php" method="POST">
            <input type="hidden" name="type" value="changepassword">
            <input type="hidden" name="id" value="<?= $userData->id ?>">
            <div class="form-group">
              <label for="password">Password:</label>
              <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
            </div>
            <div class="form-group">
              <label for="confirmpassword">Password confirmation:</label>
              <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" placeholder="Password confirm">
            </div>
            <input type="submit" class="btn form-btn" value="Change Password">
          </form>
        </div>
      </div> 
    </div>
  </div>
<?php

  require_once("templates/footer.php");

?>