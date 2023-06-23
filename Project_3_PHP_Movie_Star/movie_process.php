<?php

  require_once("db.php");
  require_once("globals.php");
  require_once("models/Message.php");
  require_once("models/Movie.php");
  require_once("dao/UserDAO.php");
  require_once("dao/MovieDAO.php");

  // Checking the form type
  $type = filter_input(INPUT_POST, "type");

  $message = new Message($BASE_URL);
  $auth = new UserDAO($conn, $BASE_URL);

  // Get users data Pegar dados do usuário
  $userData = $auth->verifyToken();
  
  // Dao of Movies
  $movieDao = new MovieDAO($conn, $BASE_URL);

  // Update user informations
  if($type === "create") {

    // Receiving form inputs
    $title = filter_input(INPUT_POST, "title");
    $description = filter_input(INPUT_POST, "description");
    $trailer = filter_input(INPUT_POST, "trailer");
    $category = filter_input(INPUT_POST, "category");
    $length = filter_input(INPUT_POST, "length");

    $movie = new Movie();

    // Minimum data validation 
    if(!empty($title) && 
      !empty($description) &&
      !empty($category)) {

      $movie->title = $title;
      $movie->description = $description;
      $movie->trailer = $trailer;
      $movie->category = $category;
      $movie->length = $length;
      $movie->users_id = $userData->id;

      // Upload de imagem
      if(isset($_FILES["image"]) && !empty($_FILES["image"]["tmp_name"])) {

        $image = $_FILES["image"];

        // Checando tipo da imagem
        if(in_array($image["type"], ["image/jpeg", "image/jpg", "image/png"])) {

          // Checa se é jpg
          if(in_array($image["type"], ["image/jpeg", "image/jpg"])) {
            $imageFile = imagecreatefromjpeg($image["tmp_name"]);
          } else {
            $imageFile = imagecreatefrompng($image["tmp_name"]);
          }

          $imageName = $movie->generateImageName();

          imagejpeg($imageFile, "./img/movies/".$imageName, 100);

          $movie->image = $imageName;

        } else {
          $message->setMessage("Invalid image type, upload jpg or png!", "error", "editprofile.php");
        }
      }

      $movieDao->create($movie);
  
    } else {

      $message->setMessage("You need to add at least: títle, description e category.", "error", "newmovie.php");

    }

  // Delete a movie
  } else if($type === "delete") {

    // Receiving form inputs
    $id = filter_input(INPUT_POST, "id");

    $movie = $movieDao->findById($id);

    if($movie) {

      // Verify if movie belongs to user
      if($movie->users_id === $userData->id) {
        $movieDao->destroy($movie->id);
      } else {
        $message->setMessage("Error, try again later!", "error", "dashboard.php");
      }

    } else {

      $message->setMessage("This movie doesn't exists!", "error", "dashboard.php");

    }

  } else if($type === "update") {

    // Receiving form inputs
    $title = filter_input(INPUT_POST, "title");
    $description = filter_input(INPUT_POST, "description");
    $trailer = filter_input(INPUT_POST, "trailer");
    $category = filter_input(INPUT_POST, "category");
    $length = filter_input(INPUT_POST, "length");
    $id = filter_input(INPUT_POST, "id");

    $movieDb = $movieDao->findById($id);

    // Checks if the movie already exists
    if($movieDb) {

      // Checks if the movie belongs to user
      if($movieDb->users_id === $userData->id) {

        // Minimum data validation
        if(!empty($title) && 
          !empty($description) &&
          !empty($category)) {

            // Create movie object, only with the input data
            $movieDb->title = $title;
            $movieDb->description = $description;
            $movieDb->trailer = $trailer;
            $movieDb->category = $category;
            $movieDb->length = $length;

            $image = $_FILES["image"];
            
            // Verify if received any image from input
            if(!empty($image["tmp_name"])) {

              // Check image type
              if(in_array($image["type"], ["image/jpeg", "image/jpg", "image/png"])) {

                // Check if it's JPG
                if(in_array($image["type"], ["image/jpeg", "image/jpg"])) {
                  $imageFile = imagecreatefromjpeg($image["tmp_name"]);
                } else {
                  $imageFile = imagecreatefrompng($image["tmp_name"]);
                }

                $movie = new Movie();

                $imageName = $movie->generateImageName();

                imagejpeg($imageFile, "./img/movies/".$imageName, 100);

                $movieDb->image = $imageName;

              } else {
                $message->setMessage("Invalid image type, upload jpg or png!", "error", "dashboard.php");
              }

            }

            $movieDao->update($movieDb);

        } else {
          
          $message->setMessage("You need to add at least: títle, description and category.", "error", "dashboard.php");

        }

      } else {
        $message->setMessage("Error, try again later!", "error", "dashboard.php");
      }

    } else {

      $message->setMessage("This movie doesn't exists!", "error", "dashboard.php");

    }

  }