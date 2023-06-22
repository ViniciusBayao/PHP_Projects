<?php

    if(empty($movie->image)) {
        $movie->image = "movie_cover.png";
    }

?>
<div class="card movie-card">
  <div style="background-image: url('<?= $BASE_URL ?>img/movies/<?= $movie->image ?>')" class="card-img-top"></div>
  <div class="card-body">
      <p class="card-rating">
          <i class="fas fa-star"></i>
          <span class="rating"><?= $movie->rating ?></span>
      </p>
      <h5 class="card-title">
          <a href="<?= $BASE_URL ?>movie.php?id=<?= $movie->id ?>"><?= $movie->title ?></a>
      </h5>
      <a href="<?= $BASE_URL ?>movie.php?id=<?= $movie->id ?>" class="btn btn-primary rate-btn">Rate</a>
      <a href="<?= $BASE_URL ?>movie.php?id=<?= $movie->id ?>" class="btn btn-primary card-btn">Discover</a>
  </div>
</div>