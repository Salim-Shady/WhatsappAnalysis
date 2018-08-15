<?php
  require_once('databaseDetails.php');
  
  //query retrieves the frequency of messages per day
  $queryFreqDays = "SELECT DAYNAME(date) AS day, COUNT(DAYNAME(date)) AS count FROM $dbName.messages GROUP BY day";
  $freqDays = $conn->query($queryFreqDays);

  //query retrives frequency of messages in every hour
  $queryFreqHours = "SELECT HOUR(time) AS hour, COUNT(HOUR(time)) AS count FROM $dbName.messages GROUP BY hour";
  $freqHours = $conn->query($queryFreqHours);

  //put all results into arrays
  $arrfreqDays = array();
  while($row = $freqDays->fetch_assoc()) {
    $arrfreqDays[] = $row;
  }

  $arrfreqHours = array();
  while($row = $freqHours->fetch_assoc()) {
    $arrfreqHours[] = $row;
  }

  //fill the arrays so all days and hours have values
  //all the values to be filled
  $days = array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");
  $hours = range(0,23);

  $resFreqDays = fillValues($arrfreqDays,$days,'day');
  $resFreqHours = fillValues($arrfreqHours,$hours,'hour');


  //returns an array that is filled with all the data from the filler
  function fillValues($array, $filler, $type) {
    
    //store all values appearing in array
    $recorded = array();
    for ($i = 0; $i < sizeof($array); $i++) {
      $recorded[] = $array[$i][$type];
    }

    //for all the values that appear in filler but not in array add the values and count 0
    for ($i = 0; $i < sizeof($filler); $i++) {
      if (!in_array($filler[$i],$recorded)) {
        $array[] = array(
          $type   => $filler[$i],
          'count' => 0
        );
      }
    }

    return $array;
  }

  $result = array($resFreqDays,$resFreqHours);

  print json_encode($result, JSON_UNESCAPED_UNICODE);
  $conn->close();