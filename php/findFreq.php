<?php
  require_once('databaseDetails.php');
  
  //query frequency of messages by day
  $queryFreqDays = "SELECT DAYNAME(date) AS day, COUNT(DAYNAME(date)) AS count FROM $dbName.messages GROUP BY day";
  $freqDays = $conn->query($queryFreqDays);

  //query frequency of messages by hour
  $queryFreqHours = "SELECT HOUR(time) AS hour, COUNT(HOUR(time)) AS count FROM $dbName.messages GROUP BY hour";
  $freqHours = $conn->query($queryFreqHours);

  //query frequency of messages by date
  $queryFreqDate = "SELECT date AS date, COUNT(date) AS count FROM $dbName.messages GROUP BY date";
  $freqDate = $conn->query($queryFreqDate);

  //query frequency of messages by year
  $queryFreqYear = "SELECT YEAR(date) AS year, SUM(count) AS count 
                    FROM ($queryFreqDate) AS queryFreqDate 
                    GROUP BY year";
  $freqYear = $conn->query($queryFreqYear);

  //query frequency of messages by month
  $queryFreqMonth = "SELECT MONTH(date) AS month, SUM(count) AS count 
                     FROM ($queryFreqDate) AS queryFreqDate
                     GROUP BY month";
  $freqMonth = $conn->query($queryFreqMonth);

  //put all results into arrays
  $arrfreqDays = array();
  while($row = $freqDays->fetch_assoc()) {
    $arrfreqDays[] = $row;
  }

  $arrfreqHours = array();
  while($row = $freqHours->fetch_assoc()) {
    $arrfreqHours[] = $row;
  }

  $resFreqDates = array();
  while($row = $freqDate->fetch_assoc()) {
    $resFreqDates[] = $row;
  }

  $resFreqYears = array();
  while($row = $freqYear->fetch_assoc()) {
    $resFreqYears[] = $row;
  }

  $arrFreqMonths = array();
  while($row = $freqMonth->fetch_assoc()) {
    $arrFreqMonths[] = $row;
  }

  //fill the arrays so all days and hours have values
  $days = array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");
  $hours = range(0,23);
  $months = range(1,12);

  $resFreqDays = fillValues($arrfreqDays,$days,'day');
  $resFreqHours = fillValues($arrfreqHours,$hours,'hour');
  $resFreqMonths = fillValues($arrFreqMonths,$months,'month');

  //print to output
  $result = array(
    'day'=>$resFreqDays,
    'hour'=>$resFreqHours,
    'date'=>$resFreqDates,
    'year'=>$resFreqYears,
    'month'=>$resFreqMonths
  );

  print json_encode($result, JSON_UNESCAPED_UNICODE);
  $conn->close();








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


