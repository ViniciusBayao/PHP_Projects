<?php

  require_once("templates/header.php");

  require_once("dao/MovieDAO.php");
  require_once("dao/UserDAO.php");

  // Movies Dao
  $movieDao = new MovieDAO($conn, $BASE_URL);

  // Verify token, if it's not the correct, redirect to home pages
  $auth = new UserDAO($conn, $BASE_URL);

  $userData = $auth->verifyToken();

  $userMovies = $movieDao->getMoviesByUserId($userData->id);

?>
<div id="main-container" class="container-fluid">
  <h2 class="section-title">Dashboard</h2>
  <p class="section-description">Add or update the informations of the movie you sent</p>
  <div class="col-md-12" id="add-movie-container">
      <a href="<?= $BASE_URL ?>newmovie.php" class="btn form-btn"><i class="fas fa-plus"></i> Add Movie</a>
  </div>
  <div class="col-md-12" id="movies-dashboard">
      <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Title</th>
              <th scope="col">Rate</th>
              <th scope="col" class="actions-column">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($userMovies as $movie): ?>
              <tr>
                <td scope="row"><?= $movie->id ?></th>
                <td><a href="<? $BASE_URL ?>movie.php?id=<?= $movie->id ?>" class="table-movie-title"><?= $movie->title ?></a></td>
                <td><i class="fas fa-star"></i> <?= $movie->rating ?></td>
                <td class="actions-column">
                    <a href="<? $BASE_URL ?>editmovie.php?id=<?= $movie->id ?>" class="edit-btn"><i class="far fa-edit"></i> Edit</a>
                    <form action="<? $BASE_URL ?>movie_process.php?id=<?= $movie->id ?>" method="POST">
                      <input type="hidden" name="type" value="delete">
                      <input type="hidden" name="id" value="<?= $movie->id ?>">
                      <button type="submit" class="delete-btn"><i class="fas fa-times"></i> Delete</a>
                    </form>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
  </div>
</div>
<?php

  include_once("templates/footer.php");

?>