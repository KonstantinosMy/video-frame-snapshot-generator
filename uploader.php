<?php
session_start();
include("connection.php");
include("functions.php");


?>
<!DOCTYPE html>
<html lang="el">
<head>
   <style>
body {
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
  .navbar a:hover{
    background-color: white;
    
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
</body>
</html>

<?php
 
if(isset($_POST['but_upload'])){
   $maxsize = 999999999; 
   if(isset($_FILES['file']['name']) && $_FILES['file']['name'] != ''){
       $name = $_FILES['file']['name'];
       $target_dir = "videos/";
       $target_file = $target_dir . $_FILES["file"]["name"];
       $extension = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
       $extensions_arr = array("mp4","avi","3gp","mov","mpeg");

      
       if( in_array($extension,$extensions_arr) ){
 
          
          if(($_FILES['file']['size'] >= $maxsize) || ($_FILES["file"]["size"] == 0)) {
             $_SESSION['message'] = "Το αρχείο είναι αρκετά μεγάλο";
          }else{
            
             if(move_uploaded_file($_FILES['file']['tmp_name'],$target_file)){
               
                       
               $query = "INSERT INTO videos(name,location) VALUES('$name','$target_file')";
               mysqli_query($con,$query);

               $_SESSION['message'] = "Ανέβηκε επιτυχώς";
             }
          }

       }else{
          $_SESSION['message'] = "Λάθος τύπος αρχείου";
       }
   }else{
       $_SESSION['message'] = "Παρακαλώ επιλέξτε αρχείο";
   }
  

   header('location: uploader.php');
   exit;
} 
?>

    <?php 
    if(isset($_SESSION['message'])){
       echo $_SESSION['message'];
       unset($_SESSION['message']);
    }
    

    
    ?>
    <div style="border:1px solid #000077;padding:10px 10px 10px 10px;width:250px;">
    <form method="post" action="" enctype='multipart/form-data'>
      <input type='file' name='file'/><br></br>
      <input type='submit' value='Ανέβασμα' name='but_upload'>
    </form>
    </div>