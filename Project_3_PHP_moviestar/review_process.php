<?php

  require_once("db.php");
  require_once("globals.php");
  require_once("models/Message.php");
  require_once("models/Movie.php");
  require_once("dao/UserDAO.php");
  require_once("dao/ReviewDAO.php");

  // checking the form type
  $type = filter_input(INPUT_POST, "type");

  $message = new Message($BASE_URL);
  $auth = new UserDAO($conn, $BASE_URL);
  $reviewDao = new ReviewDAO($conn, $BASE_URL);

  // get input from user
  $userData = $auth->verifyToken();

  // Verifying the form type
  $type = filter_input(INPUT_POST, "type");
  
  if($type === "create") {

    // Receiving form inputs
    $rating = filter_input(INPUT_POST, "rating");
    $review = filter_input(INPUT_POST, "review");
    $movies_id = filter_input(INPUT_POST, "movies_id");

    $reviewObject = new Review();

    // Minimum data validation
    if(!empty($rating) && 
      !empty($review) &&
      !empty($movies_id)) {

        $reviewObject->rating = $rating;
        $reviewObject->review = $review;
        $reviewObject->movies_id = $movies_id;
        $reviewObject->users_id = $userData->id;

        $reviewDao->create($reviewObject);

    } else {

      $message->setMessage("You need to add your rating and comment to the movie.", "error", "back");

    }

  }