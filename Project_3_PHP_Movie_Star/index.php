<?php

  require_once("templates/header.php");

  require_once("dao/MovieDAO.php");

  // Dao of movies
  $movieDao = new MovieDAO($conn, $BASE_URL);

  $lastestMovies = $movieDao->getLatestMovies();

  $actionMovies = $movieDao->getMoviesByCategory("Action");

  $comedyMovies = $movieDao->getMoviesByCategory("Comedy");

?>
<div id="main-container" class="container-fluid">
  <h2 class="section-title">New movies</h2>
  <p class="section-description">See reviews of the latest movies added to MovieStar</p>
  <div class="movies-container">
    <?php foreach($lastestMovies as $movie): ?>
        <?php require("templates/movie_card.php"); ?>
    <?php endforeach; ?>
    <?php if(count($lastestMovies) === 0): ?>
        <p class="empty-list">There are no movies registered yet!</p>
    <?php endif; ?>
  </div>
  <h2 class="section-title">Action</h2>
  <p class="section-description">See the best action movies</p>
  <div class="movies-container">
    <?php foreach($actionMovies as $movie): ?>
        <?php require("templates/movie_card.php"); ?>
    <?php endforeach; ?>
    <?php if(count($actionMovies) === 0): ?>
        <p class="empty-list">There are no movies registered yet!</p>
    <?php endif; ?>
  </div>
  <h2 class="section-title">Comedy</h2>
  <p class="section-description">See the best action comedy movies</p>
  <div class="movies-container">
    <?php foreach($comedyMovies as $movie): ?>
        <?php require("templates/movie_card.php"); ?>
    <?php endforeach; ?>
    <?php if(count($comedyMovies) === 0): ?>
        <p class="empty-list">There are no movies registered yet!</p>
    <?php endif; ?>
  </div>
</div>
<?php

  include_once("templates/footer.php");

?>