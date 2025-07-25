<?php
  require_once("templates/header.php");
  if($userDao) {
    echo $userDao->destroyToken();
  }