// send json to php to be added to DB
let jsonMessageObj = JSON.stringify(messageObj);
$.ajax({
  type: 'POST',
  url: 'php/addToDB.php',
  data: {'messages':jsonMessageObj},
  success: function(cb) {
    // alert(cb);
    $('#loader').text(cb);
  },
  async:false
});

//post to php to retrieve sender stats
let senders;
$.ajax({
  type:'POST',
  url: 'php/findSender.php',
  success: function(res) {
    senders = JSON.parse(res);    
  },
  async: true
});

//post to php to retrive longest and shortest message
let minMaxMessage;
$.ajax({
  type:'POST',
  url: 'php/findMaxMin.php',
  success: function(res) {
    alert(res);
    minMaxMessage = JSON.parse(res);    
  },
  async: true
});

let frequency;
$.ajax({
  type:'POST',
  url: 'php/findFreq.php',
  success: function(res) {
    alert(res);
    frequency = JSON.parse(res);    
  },
  async: true
});



// //Deletes the DB
// $.ajax({
//   type:'POST',
//   url: 'php/dropDB.php',
//   async: false
// });

