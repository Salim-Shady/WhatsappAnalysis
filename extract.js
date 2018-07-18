let chatText = document.getElementById('chatText').innerHTML;

//remove all <br>
chatText = chatText.replace(/<br>/g, '');

//regex to select each line
let exp = /(.*)\n/g;
let arr, messages = [], multiMessages = [];
//add each line of chats to multiMessages
while ((arr = exp.exec(chatText)) != null) {
  multiMessages.push(arr[1]);
}

//condenses multiline messages into single line
for (let i = 0; i < multiMessages.length; i++) {
  let regex = /\d{2}\/\d{2}\/\d{4}, \d{2}:\d{2} - .*/g
  if (multiMessages[i].match(regex)) {
    messages.push(multiMessages[i]);
  } else {
    messages[messages.length - 1] += ' '+multiMessages[i];
  }
}
