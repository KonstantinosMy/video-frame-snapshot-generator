<!DOCTYPE html>
<html lang="el">

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
</style>

<body>
<div class="navbar">
  <a href="index.php">Αρχική</a>
  <a href="logout.php" style="float:right;">Αποσύνδεση</a>
</div>
</body>

<?php

    # I am file2.php
    session_start(); 

    //get current directory
    $working_dir = getcwd();
      
    //get image directory
    $img_dir = $working_dir . $_SESSION["framedir"];

    //change current directory to image directory
    chdir($img_dir);

    //using glob() function get images 
    $files = glob("*.{jpg,jpeg,png,gif,JPG,JPEG,PNG,GIF}", GLOB_BRACE );

    //again change the directory to working directory 
    chdir($working_dir);
    ?>
    <table width="80%" height="40px" align="center" border="4px">
      <tr>
        <th>ID</th>
        <th>Keyframes</th>
        <th>Όνομα keyframe</th>
      </tr>

      <?php
      $c = 1;
      //iterate over image files
      foreach ($files as $file) {
        ?>
        <tr align="center">
          <td><?php echo $c;?></td>
          <td><img src="<?php echo "http://localhost/videouploadplatform", $_SESSION["framedir"], "/" . $file ?>" style="height: 100px; width: 100px;"/></td>
          <td><?php echo $file ?></td>
        </tr>
        <?php $c++;} ?>
    </table>
</html>