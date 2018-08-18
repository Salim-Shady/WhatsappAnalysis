<?php
  require_once('databaseDetails.php');

  $queryTotalMsg = "SELECT sender, COUNT(message) AS count FROM $dbName.Messages GROUP BY sender";
  $totalMsg = $conn->query($queryTotalMsg);

  $queryTotalChars = "SELECT sender, SUM(LENGTH(message)) AS count FROM $dbName.messages GROUP BY sender";
  $totalChars = $conn->query($queryTotalChars);

  $arrTotalMsg = array();
  while ($row = $totalMsg->fetch_assoc()) {
    $arrTotalMsg[] = $row;
  }

  $arrTotalChars = array();
  while ($row = $totalChars->fetch_assoc()) {
    $arrTotalChars[] = $row;
  }

  $result = array(
    'messages'=>$arrTotalMsg,
    'chars'=>$arrTotalChars
  );
  print json_encode($result, JSON_UNESCAPED_UNICODE);
  $conn->close();