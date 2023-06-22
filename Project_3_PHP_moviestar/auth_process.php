<?php

  require_once("db.php");
  require_once("globals.php");
  require_once("models/User.php");
  require_once("models/Message.php");
  require_once("dao/UserDAO.php");

  $message = new Message($BASE_URL);
  $userDao = new UserDAO($conn, $BASE_URL);

  // Checking the form type
  $type = filter_input(INPUT_POST, "type");

  // Form type check
  if($type === "register") {

    // Receiving form inputs
    $name = filter_input(INPUT_POST, "name");
    $lastname = filter_input(INPUT_POST, "lastname");
    $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
    $password = filter_input(INPUT_POST, "password");
    $confirmPassword = filter_input(INPUT_POST, "confirmpassword");

    // Verification of required fields for registration
    if($name && $lastname && $email && $password) {

      // Verificar se as senhas são iguais
      if($password === $confirmPassword) {

        // Check if user already exists
        if($userDao->findByEmail($email) === false) {

          $user = new User();

          // Create token and password
          $userToken = $user->generateToken();
          $finalPassword = password_hash($password, PASSWORD_DEFAULT);

          $user->name = $name;
          $user->lastname = $lastname;
          $user->email = $email;
          $user->password = $finalPassword;
          $user->token = $userToken;

          $auth = true;

          $userDao->create($user, $auth);

        } else {

          $message->setMessage("User already registered, try a different email.", "error", "auth.php");

        }

      } else {

        $message->setMessage("Passwords are not the same.", "error", "auth.php");

      }

    } else {

      $message->setMessage("Please fill in all fields.", "error", "auth.php");

    }

  //  User login execute
  } else if($type === "login") {

    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $password = filter_input(INPUT_POST, 'password');

    // If can authenticate, success message
    if($userDao->authenticateUser($email, $password)) {

      $message->setMessage("Welcome!", "success", "editprofile.php");

    // If it does not authenticate, it redirects to the auth page with error
    } else {

      $message->setMessage("User and/or password incorrects!", "error", "auth.php");

    }

  } else {

    $message->setMessage("Informações inválidas, tente novamente.", "error", "index.php");

  }