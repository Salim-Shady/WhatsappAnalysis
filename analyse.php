<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Analyser</title>
    <script
			  src="https://code.jquery.com/jquery-3.3.1.min.js"
			  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
			  crossorigin="anonymous"></script>
    <script src = "https://d3js.org/d3.v4.min.js"></script>
    <?php
      //check if file was posted
      
      if (!isset($_FILES['file']) || !file_exists($_FILES['file']['tmp_name']) || !is_uploaded_file($_FILES['file']['tmp_name'])) {
        echo '<meta http-equiv="refresh" content="2; url=index.php" />';
      } else {
        //if file exists
        $fileArr = $_FILES['file'];
        $fileLoc = "uploads/".str_replace(' ','',$fileArr['name']);
        
        //prevent dir traversal
        $basePath = getcwd();
        $realBasePath = realpath($basePath);
        $realFileLoc = realpath($fileLoc);
        $fileData = '';
        if ( !TRUE || ($realFileLoc === FALSE || strpos($realFileLoc,$realBasePath) !== 0) ) {
          echo '<meta http-equiv="refresh" content="2; url=index.php" />';
        } else {
          //if no dir traversal
          move_uploaded_file($fileArr['tmp_name'], $fileLoc);
          
          $file = fopen($fileLoc, 'r');
          $fileData = fread($file, filesize($fileLoc));
          $fileData = htmlspecialchars($fileData);
          $fileData = nl2br($fileData);
          
        }//if-else dirTraversal
      }//if-else fileExists
      ?>
</head>
  <body>
    <div id="chatText" style="display:none">'
      <?php echo $fileData; ?>
    </div>
    <div id="loader">uploading to database</div>
    <div id="container"></div>
    <script src="js/Message.js" charset="utf-8"></script>
    <script src="js/extract.js" charset="utf-8"></script>
    <script src="js/database.js"></script>
  </body>
</html>
