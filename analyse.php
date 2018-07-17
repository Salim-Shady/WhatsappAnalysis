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
      $file = $_FILES['file'];
      move_uploaded_file($file['tmp_name'], "uploads/".$file['name']);
    ?>
  </head>
  <body>

  </body>
</html>
