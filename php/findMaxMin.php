<?php
  require_once('databaseDetails.php');

  //query selects the record with the most amount of characters in message
  $queryMaxMessage = "SELECT date, time, sender, message, LENGTH(message) AS msgLen 
                      FROM $dbName.Messages 
                      ORDER BY msgLen DESC
                      LIMIT 1";
  $max = $conn->query($queryMaxMessage);
  
  //query selects the record with the least amount of characters in message
  $queryMinMessage = "SELECT date, time, sender, message, LENGTH(message) AS msgLen 
                      FROM $dbName.Messages 
                      ORDER BY msgLen ASC
                      LIMIT 1";
  $min = $conn->query($queryMinMessage);
  
  //add the msgType parameter to distinguish both results
  $max = $max->fetch_assoc();
  $min = $min->fetch_assoc();
  $max['msgType'] = 'max';
  $min['msgType'] = 'min';
  
  //adds the query results to an array
  $rows = array();
  $rows[] = $max;
  $rows[] = $min;
  
  print json_encode($rows, JSON_UNESCAPED_UNICODE);
  $conn->close();