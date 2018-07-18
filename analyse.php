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
    <script src="Message.js" charset="utf-8"></script>
    <script src="extract.js" charset="utf-8"></script>
  </body>
</html>
