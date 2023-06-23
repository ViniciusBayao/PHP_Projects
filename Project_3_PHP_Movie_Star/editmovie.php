<?php

  require_once("templates/header.php");

  // Check authentication
  require_once("models/User.php");
  require_once("dao/UserDAO.php");
  require_once("dao/MovieDAO.php");

  $userModel = new User();

  // Verify token, if it's not the correct, redirect to home page
  $userData = $auth->verifyToken();

  $movieDao = new MovieDAO($conn, $BASE_URL);

  $id = filter_input(INPUT_GET, "id");

  $movie = $movieDao->findById($id);

?>
<div id="main-container" class="container-fluid">
  <div class="col-md-12">
    <div class="row"> 
      <div class="col-md-6 offset-md-1">
        <h1><?= $movie->title ?></h1>
        <p class="page-description">Change the movie data in the form below:</p>
        <form id="add-movie-form" action="<?= $BASE_URL ?>movie_process.php" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="type" value="update">
          <input type="hidden" name="id" value="<?= $movie->id ?>">
          <div class="form-group">
              <label for="name">Title:</label>
              <input type="text" class="form-control" id="title" name="title" placeholder="Enter the movie title" value="<?= $movie->title ?>">
          </div>
          <div class="form-group">
              <label for="image">Image:</label>
              <input type="file" name="image" class="form-control-file">
          </div>
          <div class="form-group">
              <label for="length">Duration:</label>
              <input type="text" class="form-control" id="length" name="length" placeholder="Enter the duration of the movie" value="<?= $movie->length ?>">
          </div>
          <div class="form-group">
              <label for="category">Movie Category:</label>
              <select class="form-control" name="category" id="cateogry">
                  <option value="">Select</option>
                  <option value="Ação" <?= $movie->category === "Ação" ? "selected" : "" ?>>Action</option>
                  <option value="Drama" <?= $movie->category === "Drama" ? "selected" : "" ?>>Drama</option>
                  <option value="Comedia" <?= $movie->category === "Comedia" ? "selected" : "" ?>>Comedy</option>
                  <option value="Fantasia / Ficção" <?= $movie->category === "Fantasia / Ficção" ? "selected" : "" ?>>Fantasy / Fiction</option>
                  <option value="Romance" <?= $movie->category === "Romance" ? "selected" : "" ?>>Romance</option>
              </select>
          </div>
          <div class="form-group">
              <label for="trailer">Trailer:</label>
              <input type="text" class="form-control" id="trailer" name="trailer" placeholder="Enter trailer link" value="<?= $movie->trailer ?>">
          </div>
          <div class="form-group">
              <label for="description">Description:</label>
              <textarea class="form-control" name="description" id="description" rows="5"><?= $movie->description ?></textarea>
          </div>
          <input type="submit" class="btn form-btn" value="Change movie">
        </form>
      </div>
      <div class="col-md-3">
        <?php if(!empty($movie->image)): ?>
          <div class="movie-image-container" style="background-image: url('<?= $BASE_URL ?>img/movies/<?= $movie->image ?>')"></div>
        <?php else: ?>
          <p>This movie doesn't have any image yet!</p>
        <?php endif; ?>
      </div>    
    </div>   
  </div>
</div>
<?php

  require_once("templates/footer.php");

?>