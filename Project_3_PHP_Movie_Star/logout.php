<?php

  // Calling headers because it has User configuration and DAO files
  require_once("templates/header.php");

  if($userDao) {
    $userDao->destroyToken();
  }