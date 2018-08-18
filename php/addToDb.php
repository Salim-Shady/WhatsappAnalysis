<?php
  set_time_limit(500);
  if (!isset($_POST['messages']) || empty($_POST['messages'])) {
    die("No messages given");
  }

  $messages = json_decode($_POST['messages']);
  //retrieve login details
  require_once("databaseDetails.php");

  $queryCreateDB = "CREATE DATABASE $dbName CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;";
  $conn->query($queryCreateDB);
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
    message TEXT NOT NULL,
    wordCount INT NOT NULL
    )";
  $conn->query($queryCreateTableMessages);

  //load all messages to the db
  for ($i=0; $i < sizeof($messages); $i++) { 
    $chat = $messages[$i];
    $date = $chat->sqlDate;
    $time = $chat->sqlTime;
    $sender = $chat->sender;
    $text = $chat->text;
    $text = str_replace('\'', '\\\'', $text);
    $wordCount = str_word_count($text);

    $queryAddMsg = "INSERT INTO $dbName.Messages VALUES ('$date','$time','$sender','$text','$wordCount')";
    $conn->query($queryAddMsg) or die($conn->error);
  }

  $conn->close();
  