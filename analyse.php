<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Analyser</title>
    <?php
      if (!isset($_FILES['file'])) {
        echo "<meta http-equiv=\"refresh\" content=\"0; url=./index.html\" />";
        exit();
      }
      $fileArr = $_FILES['file'];
      $fileLoc = "uploads/".$fileArr['name'];
      move_uploaded_file($fileArr['tmp_name'], $fileLoc);

      $file = fopen($fileLoc, 'r');
      $fileData = fread($file, filesize($fileLoc));
      $fileData = htmlspecialchars($fileData);
      $fileData = nl2br($fileData);
    ?>
  </head>
  <body>
    <div id="chatText">
      <?php echo $fileData; ?>
    </div>
    <script>
      let chatText = document.getElementById('chatText').innerHTML;
      chatText = chatText.replace(/<br>/g, '');

      //regex to pick out only chats
      let exp = /\d{2}\/\d{2}\/\d{4}, \d{2}:\d{2} - .*:.*/g;
      let arr, messages = [];
      //while there are more chats add them to messages
      while ((arr = exp.exec(chatText)) != null) {
        messages.push(arr[0]);
      }
    </script>
  </body>
</html>
