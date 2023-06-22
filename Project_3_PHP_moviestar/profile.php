<?php

  require_once("templates/header.php");

  // Check Autentication
  require_once("models/User.php");
  require_once("dao/UserDAO.php");
  require_once("dao/MovieDAO.php");

  $user = new User();
  $userDao = new UserDao($conn, $BASE_URL);

  // Get user details by id of get method
  $id = filter_input(INPUT_GET, 'id');

  if(empty($id)) {

    $id = $userData->id;

  } else {

    $userData = $userDao->findById($id);

    // If can't find the user
    if(!$user) {
      $message->setMessage("User not found.", "error", "index.php");
    }

  }

  $fullName = $user->getFullName($userData);

  // Verify if the user has an image
  if(empty($userData->image)) {
    $userData->image = "user.png";
  }

  $movieDao = new MovieDAO($conn, $BASE_URL);

  $userMovies = $movieDao->getMoviesByUserId($id);

?>
<div id="main-container" class="container-fluid">
  <div class="col-md-8 offset-md-2">
    <div class="row profile-container">
      <div class="col-md-12 about-container">
        <h1 class="page-title"><?= $fullName ?></h1>
        <div id="profile-image-container" style="background-image: url('<?= $BASE_URL ?>img/users/<?= $userData->image ?>')"></div>
        <h3 class="about-title">About:</h3>
        <?php if(!empty($userData->bio)): ?>
          <p class="profile-description"><?= $userData->bio ?></p>
        <?php else: ?>
          <p class="profile-description">The user hasn't written anything here yet...</p>
        <?php endif; ?>
      </div>
      <div class="col-md-12 added-movies-container">
        <h3>Movies you uploaded:</h3>
          <div class="movies-container">
          <?php foreach($userMovies as $movie): ?>
            <?php require("templates/movie_card.php"); ?>
          <?php endforeach; ?>
          <?php if(count($userMovies) === 0): ?>
              <p class="empty-list">The user has not yet uploaded movies!</p>
          <?php endif; ?>
        </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php

  require_once("templates/footer.php");

?>