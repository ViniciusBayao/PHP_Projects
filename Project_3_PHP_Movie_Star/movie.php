<?php

  require_once("templates/header.php");

  // Movie data and reviews
  require_once("models/Movie.php");
  require_once("dao/MovieDAO.php");
  require_once("dao/ReviewDAO.php");

  // Get details from user by id of get
  $id = filter_input(INPUT_GET, 'id');

  $movie;

  $movieDao = new MovieDAO($conn, $BASE_URL);

  if(empty($id)) {

    $message->setMessage("Movie not found.", "error", "index.php");

  } else {

    $movie = $movieDao->findById($id);

    // If can't find the user
    if(!$movie) {
      $message->setMessage("Movie not found.", "error", "index.php");
    }

  }

  // Checking if the movie is related to user
  $userOwnsMovie = false;

  if(!empty($userData)) {

    if($userData->id === $movie->users_id) {
      $userOwnsMovie = true;
    }

  }
  
  // Rescues the movie reviews
  $reviewDao = new ReviewDAO($conn, $BASE_URL);

  $movieReviews = $reviewDao->getMovieReviews($id);

  // Just check if the user is logged in
  if(!empty($userData)) {
    // Check if user made a review
    $alreadyReviewed = $reviewDao->hasAlreadyReviewed($id, $userData->id);
  }


?>
<div id="main-container" class="container-fluid">
  <div class="row">
    <div class="offset-md-1 col-md-6 movie-container">
      <h1 class="page-title"><?= $movie->title ?></h1>
      <p class="movie-details">
        <span>Duração: <?= $movie->length ?></span>
        <span class="pipe"></span>
        <span><?= $movie->category ?></span>
        <span class="pipe"></span>
        <span><i class="fas fa-star"></i> <?= $movie->rating ?></span>
      </p>
      <iframe width="560" height="315" src="<?= $movie->trailer ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      <p><?= $movie->description ?></p>
    </div>
    <div class="col-md-4">
      <?php if(!empty($movie->image)): ?>
        <div class="movie-image-container" style="background-image: url('<?= $BASE_URL ?>img/movies/<?= $movie->image ?>')"></div>
      <?php else: ?>
        <p>This movie does not have a photo yet!</p>
      <?php endif; ?>
    </div>
    <div class="offset-md-1 col-md-10" id="reviews-container">
      <h3 id="reviews-title">Movie Reviews:</h3>
      <!-- Enable form only if user don't own the movie and haven't reviewed it -->
      <?php if(!empty($userData) && !$userOwnsMovie && !$alreadyReviewed): ?>  
        <div class="col-md-12" id="review-form-container">
          <h4>Send you review</h4>
          <p class="page-description">Fill in the form with the review and comment about the movie</p>
          <form action="<?= $BASE_URL ?>review_process.php" method="POST">
            <input type="hidden" name="type" value="create">
            <input type="hidden" name="movies_id" value="<?= $movie->id ?>">
            <div class="form-group">
              <label for="rating">Movie Rating:</label>
              <select class="form-control" name="rating" id="rating">
                  <option value="">Select</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6</option>
                  <option value="7">7</option>
                  <option value="8">8</option>
                  <option value="9">9</option>
                  <option value="10">10</option>
              </select>
            </div>
            <div class="form-group">
              <label for="review">Your comment:</label>
              <textarea class="form-control" id="review" name="review" rows="3" placeholder="What did you think about the movie?"></textarea>
            </div>
            <input type="submit" class="btn form-btn" value="Send feedback">
          </form>
        </div>
      <?php endif; ?>
      <?php foreach($movieReviews as $review): ?>
        <?php require("templates/user_review.php"); ?>
      <?php endforeach; ?>
      <?php if(empty($movieReviews)): ?>
        <p class="empty-list">There are no comments yet!</p>
      <?php endif; ?>
    </div>
  </div>
</div>
<?php

  require_once("templates/footer.php");

?>