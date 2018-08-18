<?php
  require_once('databaseDetails.php');

  //query selects the record with the most amount of characters in message
  $queryMaxChars = "SELECT date, time, sender, message, LENGTH(message) AS msgLen 
                      FROM $dbName.Messages 
                      ORDER BY msgLen DESC
                      LIMIT 1";

  
  //query selects the record with the least amount of characters in message
  $queryMinChars = "SELECT date, time, sender, message, LENGTH(message) AS msgLen 
                      FROM $dbName.Messages 
                      ORDER BY msgLen ASC
                      LIMIT 1";

  $queryChars = "($queryMaxChars) UNION ALL ($queryMinChars)";
  $Chars = $conn->query($queryChars);


  
  //query selects message with max words
  $queryMaxWords = "SELECT date, time, sender, message, wordCount
                      FROM $dbName.messages
                      ORDER BY wordCount DESC
                      Limit 1";

  //query selects message with min words
  $queryMinWords = "SELECT date, time, sender, message, wordCount
                      FROM $dbName.messages
                      ORDER BY wordCount ASC
                      Limit 1";
  
  $queryWords = "($queryMaxWords) UNION ALL ($queryMinWords)";
  $Words = $conn->query($queryWords);



  //convert all query results into arrays
  $maxChars = $Chars->fetch_assoc();
  $minChars = $Chars->fetch_assoc();
  $maxWords = $Words->fetch_assoc();
  $minWords = $Words->fetch_assoc();

  //adds the query results to an array
  $rows = array(
    'maxChars' => $maxChars,
    'minChars' => $minChars,
    'maxWords' => $maxWords,
    'minWords' => $minWords
  );
  
  print json_encode($rows, JSON_UNESCAPED_UNICODE);
  $conn->close();