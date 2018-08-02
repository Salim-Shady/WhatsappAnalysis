<?php
  $dbHost = "localhost";
  $dbUser = "root";
  $dbPass = "";
  $dbName = "whatsappanalysis";
  //create mysqli connection
  $conn = new mysqli($dbHost,$dbUser,$dbPass);
  !$conn->connect_error OR die();
