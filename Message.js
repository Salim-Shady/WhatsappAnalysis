class Message {
  constructor(dateString, time, sender, text) {

    let dateRegex = /(\d{2})\/(\d{2})\/(\d{4}), (\d{2}):(\d{2})/g
    let dateArr = dateRegex.exec(dateString);

    let day = parseInt(dateArr[1]);
    let month = parseInt(dateArr[2]) - 1;
    let year = parseInt(dateArr[3]);
    let hour = parseInt(dateArr[4]);
    let mins = parseInt(dateArr[5]);

    this.date = new Date(year,month,day,hour,mins);
    this.sender = sender;
    this.text = text;
  }
}
