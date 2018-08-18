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


let findTotal = () => {
  return new Promise((resolve,reject) => {
    let ans;
    $.ajax({
      type:'POST',
      url: 'php/findSender.php',
      success: function(res) {
        ans = JSON.parse(res);    
      },
      async: false
    });

    resolve(ans);
  });
};

let findMinMax = () => {
  return new Promise((resolve,reject) => {
    let ans;
    $.ajax({
      type:'POST',
      url: 'php/findMaxMin.php',
      success: function(res) {
        console.log(res);
        ans = JSON.parse(res);    
      },
      async: false
    });

    resolve(ans);
  });
};

let findFreq = () => {
  return new Promise((resolve,reject) => {
    let ans;
    $.ajax({
      type:'POST',
      url: 'php/findFreq.php',
      success: function(res) {
        ans = JSON.parse(res);    
      },
      async: false
    });

    //sort ans by day
    ans.day.sort(function(a,b) {
      let order = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
      let indexA = order.indexOf(a.day);
      let indexB = order.indexOf(b.day);

      return indexA - indexB;
    });

    //sort ans by hour
    ans.hour.sort(function(a,b) {
      return a.hour - b.hour;
    });

    //sort ans by month
    ans.month.sort(function(a,b) {
      return a.month - b.month;
    });

    resolve(ans);
  });
};


let total,minMaxMessage,frequency;
Promise.all([
  findTotal().then(success => total = success),
  findMinMax().then(success => minMaxMessage = success),
  findFreq().then(success => frequency = success)
]).then(success => console.log("All queries executed"));