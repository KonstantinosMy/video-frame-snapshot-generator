<?php
  session_start();
  include("connection.php");
  include("functions.php");
  //$user_data=check_login($con);
  
?>
<!DOCTYPE html>
<html lang="el">
<head>

<style>
  .body {
      font-family: Arial, Helvetica, sans-serif;
  }
  .form{
      margin: 5px auto;
      text-align: center;
  }
  .navbar {
    overflow: hidden;
    background-color: lightblue;
  }
  .navbar a {
    float: left;
    font-size: 16px;
    color: black;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
  }
  .navbar a:hover {
    background-color: white;
    
  }

    /* (A) GALLERY CONTAINER */
  /* (A1) ON BIG SCREENS */
  .gallery {
    display: grid;
    grid-template-columns: repeat(3, auto); /* 3 IMAGES PER ROW */
    grid-gap: 10px;
    max-width: 1200px;
    margin: 0 auto; /* HORIZONTAL CENTER */
  }
  /* (A2) ON SMALL SCREENS */
  @media screen and (max-width: 640px) {
    .gallery {
      grid-template-columns: repeat(2, auto); /* 2 IMAGES PER ROW */
    }
  }
  
  /* (B) THUMBNAILS */
  .gallery img {
    width: 100%;
    height: 200px;
    /* FILL, CONTAIN, COVER, SCALE-DOWN : USE WHICHEVER YOU LIKE */
    object-fit: cover;
  }
  .gallery img:fullscreen { object-fit: contain; }
  
  /* (X) DOES NOT MATTER */
  body, html {
    padding: 0;
    margin: 0;
  }

</style>

<title>Αρχική</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">

</head>
<body>
<div class="navbar">
  
  <a href="index.php">Αρχική</a>
  <a href="uploader.php">Ανέβασμα αρχείου</a>
  <a href="logout.php" style="float:right;">Αποσύνδεση</a>

  
</div>

<div>
  <?php
  
  // Full path to ffmpeg (make sure this binary has execute permission for PHP)  
  //$ffmpeg = "C:/FFmpeg/bin/ffmpeg.exe";  
  // Full path to the video file  
  //$videoFile = "C:/xampp/htdocs/videoUploadPlatform/videos/earth.mp4";  
  // Full path to output image file (make sure the containing folder has write permissions!)  
  //$imgOut = "C:/xampp/htdocs/videoUploadPlatform/frames/frame.jpeg";  
  // Number of seconds into the video to extract the frame  
  //$second = 10;  
  // Setup the command to get the frame image  
  //$cmd = $ffmpeg." -i \"".$videoFile."\" -an -ss ".$second.".001 -y -f mjpeg \"".$imgOut."\" 2>&1"; 
  // Get any feedback from the command  
  //$feedback = `$cmd`;  
  // Use $imgOut (the extracted frame) however you need to   
  // ...   

  //Get videos from folder and create descriptions with buttons



  $ffmpeg = "C:/FFmpeg/bin/ffmpeg.exe"; 
      $fetchVideos = mysqli_query($con, "SELECT * FROM videos ORDER BY id DESC");
      while($row = mysqli_fetch_assoc($fetchVideos)){
        $location = $row['location'];
        $name = $row['name'];
        $videoFile = "C:/xampp/htdocs/videoUploadPlatform/$location"; 
        $frameDir = "/frames/$name";
        $imgOut = "C:/xampp/htdocs/videoUploadPlatform/frames/$name/$name-%4d.jpeg"; 
        $second = 4;  
        # I am file1.php
        $_SESSION["framedir"] = $frameDir;

        echo "<div style='float: left; margin-right: 5px;'>
            <video src='".$location."' controls width='320px' height='320px' ></video>     
            <br>
            <br>
            <span>Name:".$name."<br>",'Path:' .$location."</span>
            <a href='getFrames.php'>
              <input onclick='' type='button' class='btnFrame' name='getFrames' value='Προβολή Καρέ'>
            </a>
            
          </div>";
            $cmd = $ffmpeg." -i \"".$videoFile."\"  -qscale:v 2 -r 10.0 \"".$imgOut."\" 2>&1";
            $feedback = `$cmd`;
      }   
  ?>
</div>
  
</body>
</html>