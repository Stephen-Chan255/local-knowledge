<?php

  // connect to the database
  $host = 'localhost';
  $username = 'username';
  $password = 'password';
  $db = 'local_knowledge';

  $conn = mysqli_connect($host, $username, $password, $db);

  // check for connection error
  if (!$conn) {
    die('Connection failed: '. mysqli_connect_error());
  }
