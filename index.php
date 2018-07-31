<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Whatsapp Analyser</title>
    <script
			  src="https://code.jquery.com/jquery-3.3.1.min.js"
			  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
			  crossorigin="anonymous"></script>
  </head>
  <body>
    <div class="form">
      <form action="index.php" method="post" enctype="multipart/form-data">
        <input type="text" name="fileName" placeholder="Group Name" >
        <input type="file" name="file">
        <input type="submit" name="submit" value="Submit">
      </form>
    </div>

    <!-- Script for generating tests -->
    <script>
      function generate() {
        let line = '';
        let day   = randomRange(12,1,2);
        let month = randomRange(12,1,2);
        let year  = randomRange(2100,1800,4);
        let date  = day+"/"+month+"/"+year;

        let hour = randomRange(23,0,2);
        let min = randomRange(59,0,2);
        let time = hour+':'+min;

        let dict = 'abcdefghijklmnopqrstuvwxyz';
        let name = '';
        for (let i = 0; i<parseInt(randomRange(15,1)); i++) {
          name += dict[parseInt(randomRange(26))];
        }

        let messageDict = dict + ' ';
        let message = '';
        for (let i = 0; i<parseInt(randomRange(100,1)); i++) {
          message += dict[parseInt(randomRange(27))];
        }

        // console.log(date, time, name, message);

        let text = date+', '+time+' - '+name+': '+message;
        return text;

      }

      function randomRange(upper, lower, digits) {

        if (!upper) {
          return;
        }

        //if lower given then difference b/w upper and lower else just upper
        let diff = lower ? upper-lower : upper;
        //if lower given then random num + lower else just random number
        let rand = lower ? Math.floor(Math.random()*diff) + lower : Math.floor(Math.random()*diff);

        if (digits && (""+rand).length != digits) {
          //if digits given then pad rand to num of digits
          let pre = '';
          for (let i = 0; i < digits - (""+rand).length; i++) {
            pre += '0';
          }
          rand = pre + rand;
        }

        return "" + rand;
      }
    </script>

    <?php
      //check if file was posted
      
      if (!isset($_FILES['file'])|| !file_exists($_FILES['file']['tmp_name']) || !is_uploaded_file($_FILES['file']['tmp_name'])) {
        exit();
      } else {
        //if file exists
        $fileArr = $_FILES['file'];
        $fileLoc = "uploads/".$fileArr['name'];
  
        //prevent dir traversal
        $basePath = getcwd();
        $realBasePath = realpath($basePath);
        $realFileLoc = realpath($fileLoc);
        $fileData = '';
        if ( $realFileLoc === false || strpos($realFileLoc,$realBasePath) !== 0 ) {
          exit();
        } else {
          //if no dir traversal
          move_uploaded_file($fileArr['tmp_name'], $fileLoc);
    
          $file = fopen($fileLoc, 'r');
          $fileData = fread($file, filesize($fileLoc));
          $fileData = htmlspecialchars($fileData);
          $fileData = nl2br($fileData);  
    ?>

    <div id="chatText" style="display:none">
      <?php echo $fileData; ?>
    </div>
    <div id='container'></div>
    <script src="js/Message.js" charset="utf-8"></script>
    <script src="js/extract.js" charset="utf-8"></script>
    <?php 
        }//if-else dirTraversal
      }//if-else fileExists
    ?>
  </body>
</html>
