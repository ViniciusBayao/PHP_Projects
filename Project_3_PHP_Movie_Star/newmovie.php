<?php

  include_once("templates/header.php");

  // Checa authentication
  require_once("models/User.php");
  require_once("dao/UserDAO.php");

  // Checks the token, if it is not correct, redirects to home.
  $auth = new UserDAO($conn, $BASE_URL);

  $userData = $auth->verifyToken();

?>
<div id="main-container" class="container-fluid">
  <div class="offset-md-4 col-md-4 new-movie-container">
    <h1 class="page-title">Add Movie</h1>
    <p class="page-description">Add your review and share it with the world!</p>
    <form id="add-movie-form" action="<?= $BASE_URL ?>movie_process.php" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="type" value="create">
      <div class="form-group">
          <label for="title">Title:</label>
          <input type="text" class="form-control" id="title" name="title" placeholder="Enter movie title">
      </div>
      <div class="form-group">
          <label for="image">Image:</label>
          <input type="file" name="image" class="form-control-file">
      </div>
      <div class="form-group">
          <label for="length">Duration:</label>
          <input type="text" class="form-control" id="length" name="length" placeholder="Enter movie duration">
      </div>
      <div class="form-group">
          <label for="category">Movie Category:</label>
          <select class="form-control" name="category" id="category">
              <option value="">Select</option>
              <option value="Ação">Action</option>
              <option value="Drama">Drama</option>
              <option value="Comédia">Comedy</option>
              <option value="Fantasia / Ficção">Fantasy / Fiction</option>
              <option value="Romance">Romance</option>
          </select>
      </div>
      <div class="form-group">
          <label for="trailer">Trailer:</label>
          <input type="text" class="form-control" id="trailer" name="trailer" placeholder="Enter trailer link">
      </div>
      <div class="form-group">
          <label for="description">Description:</label>
          <textarea class="form-control" name="description" id="description" rows="5"></textarea>
      </div>
      <input type="submit" class="btn form-btn" value="Add movie">
    </form>
  </div>
</div>
<?php

  include_once("templates/footer.php");

?>