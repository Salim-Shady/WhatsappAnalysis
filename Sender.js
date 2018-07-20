class Sender {
  constructor(name) {
    this.name = name;
    this.messages = [];

  }

  addMessage(message) {
    if (!(message instanceof Message)) throw ('Not a message');
    this.messages.push(message);
  }

  getMax() {
    if (this.messages.length === 0) return 0;

    this.maxMessage = this.messages[0];
    for (message in messages) {
      if (message.text.length > this.maxMessage.length) {
        this.maxMessage = message;
      }
    }

    return this.maxMessage;
  }

  getMin() {
    if (this.messages.length === 0) return 0;

    this.minMessage = this.messages[0];
    for (message in messages) {
      if (message.text.length < this.minMessage.length) {
        this.minMessage = message;
      }
    }

    return this.minMessage;
  }

  getTotalChars() {
    if (this.messages.length === 0) return 0;
    this.totalChars = 0;
    for (message in this.messages) {
      this.totalChars += message.text.length;
    }
    return this.totalChars;
  }
}
