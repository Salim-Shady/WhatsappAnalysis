<?php
  set_time_limit(500);
  if (!isset($_POST['messages']) || empty($_POST['messages'])) {
    die("No messages given");
  }

  $messages = json_decode($_POST['messages']);
  //retrieve login details
  include("databaseDetails.php");

  //create mysqli connection
  $conn = new mysqli($dbHost,$dbUser,$dbPass);
  !$conn->connect_error OR die();

  $dbName = "whatsappanalysis";

  //create database
  $queryCreateDB = "CREATE DATABASE $dbName";
  $conn->query($queryCreateDB) or die("Could not create DB: ".$conn->error);

  
  // $queryCreateTableSender = "CREATE TABLE $dbName.Sender (
  //   id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  //   name VARCHAR(255) NOT NULL
  //   )";
  // $conn->query($queryCreateTableSender) or die("Could not create Table 'Sender': ".$conn->error);

  //create the messages table
  $queryCreateTableMessages = "CREATE TABLE $dbName.Messages (
    date DATE NOT NULL,
    time TIME NOT NULL,
    sender TEXT NOT NULL,
    message TEXT NOT NULL
    )";
  $conn->query($queryCreateTableMessages) or die("Could not create Table: ".$conn->error);

  //load all messages to the db
  for ($i=0; $i < sizeof($messages); $i++) { 
    $chat = $messages[$i];
    $date = $chat->sqlDate;
    $time = $chat->sqlTime;
    $sender = $chat->sender;
    $text = $chat->text;
    $text = str_replace('\'', '\\\'', $text);

    $queryAddMsg = "INSERT INTO $dbName.Messages VALUES ('$date','$time','$sender','$text')";
    $conn->query($queryAddMsg) or die($conn->error);
  }
  