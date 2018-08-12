<?php
  require_once('databaseDetails.php');

  $queryFindSenders = "SELECT sender, COUNT(message) AS count FROM $dbName.Messages GROUP BY sender";
  $res = $conn->query($queryFindSenders);

  $rows = array();
  while ($row = $res->fetch_assoc()) {
    $rows[] = $row;
  }

  print json_encode($rows, JSON_UNESCAPED_UNICODE);
  $conn->close();