// send json to php to be added to DB
let jsonMessageObj = JSON.stringify(messageObj);
$.ajax({
  type: 'POST',
  url: 'php/addToDB.php',
  data: {'messages':jsonMessageObj},
  success: function() {
    $('#loader').hide();
    $('#drop').show();
  },
  async:false
});

//post to php to retrieve sender stats
let total;
$.ajax({
  type:'POST',
  url: 'php/findSender.php',
  success: function(res) {
    total = JSON.parse(res);    
  },
  async: true
});

//post to php to retrive longest and shortest message
let minMaxMessage;
$.ajax({
  type:'POST',
  url: 'php/findMaxMin.php',
  success: function(res) {
    // alert(res);
    minMaxMessage = JSON.parse(res);    
  },
  async: true
});

let frequency;
$.ajax({
  type:'POST',
  url: 'php/findFreq.php',
  success: function(res) {
    // alert(res);
    frequency = JSON.parse(res);    
  },
  async: false
});

//sort frequency by day
frequency.day.sort(function(a,b) {
  let order = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
  let indexA = order.indexOf(a.day);
  let indexB = order.indexOf(b.day);

  return indexA - indexB;
});

//sort frequency by hour
frequency.hour.sort(function(a,b) {
  return a.hour - b.hour;
});

//sort frequency by month
frequency.month.sort(function(a,b) {
  return a.month - b.month;
});
