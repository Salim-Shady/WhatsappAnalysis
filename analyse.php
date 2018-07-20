<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Analyser</title>
    <?php
      //check if file was posted
      if (!isset($_FILES['file'])) {
        echo "<meta http-equiv=\"refresh\" content=\"0; url=./index.html\" />";
        exit();
      }

      $fileArr = $_FILES['file'];
      $fileLoc = "uploads/".$fileArr['name'];

      //prevent dir traversal
      $basePath = getcwd();
      $realBasePath = realpath($basePath);
      $realFileLoc = realpath($fileLoc);
      if ($realFileLoc === false || strpos($realFileLoc,$realBasePath) !== 0 ) {
        echo "<meta http-equiv=\"refresh\" content=\"0; url=./index.html\" />";
        exit();
      }

      move_uploaded_file($fileArr['tmp_name'], $fileLoc);

      $file = fopen($fileLoc, 'r');
      $fileData = fread($file, filesize($fileLoc));
      $fileData = htmlspecialchars($fileData);
      $fileData = nl2br($fileData);
    ?>
    <script src = "https://d3js.org/d3.v4.min.js"></script>
  </head>
  <body>
    <div id="chatText" style="display:none">
      <?php echo $fileData; ?>
    </div>
    <div id='container'></div>
    <script src="Message.js" charset="utf-8"></script>
    <script src="Sender.js" charset="utf-8"></script>
    <script src="extract.js" charset="utf-8"></script>
    <script src="getStats.js" charset="utf-8"></script>
  </body>
</html>
