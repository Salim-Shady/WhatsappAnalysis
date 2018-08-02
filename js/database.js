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

//Deletes the DB
$.ajax({
  type:'POST',
  url: 'php/dropDB.php',
  async: false
});

