<?php
  require_once('databaseDetails.php');

  $queryDropDB = "DROP DATABASE $dbName";
  $conn->query($queryDropDB) or die($conn->connect_error);

  $conn->close();