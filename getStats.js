let totalMsg = messageObj.length;
let senders = new Set();

//add all senders to set
for (let i = 0; i < totalMsg; i++) {
  senders.add(messageObj[i].sender);
}
