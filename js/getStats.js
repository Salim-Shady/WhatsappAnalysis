/*
  messagesObj contains all the messages as Message objects from the chat
*/
//stats object will hold all the stats of the chat
let stats = {
  totalMsgs: 0,
  msgPercentage: {},
  maxMsg: {
    senders: {},
    overall: null
  },
  minMsg: {
    senders: {},
    overall: null
  },
  firstMsg: {
    sender: null,
    msg: null
  },
  longestReign: {
    sender: null,
    messages: []
  },
  longestIdle: {
    sender: null,
    idleLength: 0
  },
  mostChars: {
    sender: null
  },
  leastChars:null
};

let totalMsg = messageObj.length;
stats.totalMessages = totalMsg;
let senders = new Set();

//add all senders to set
for (let i = 0; i < totalMsg; i++) {
  senders.add(messageObj[i].sender);
}

//make objects for all senders
let sendersArr = [...senders];
let sendersObj = [];
for (sender in sendersArr) {
  sendersObj.push(new Sender(sender));
}
