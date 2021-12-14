<?php
session_start();
include("connection.php");
include("functions.php");


if($_SERVER['REQUEST_METHOD']=="POST"){
    $username=$_POST['username'];
    $password=$_POST['password'];

    if(!empty($username) && !empty($password) && !is_numeric($username)){
        $user_id=random_num(2);
$query="insert into users(id,username,password) values('$id','$username','$password')";
mysqli_query($con,$query);
header("Location:login.php");
die;
    }else{
        echo"Μη έγκυρα στοιχεία";
    }
}
?>

<!DOCTYPE html>
<html lang="el">
<head>

<title>Εγγραφή</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
 </head>

<body>
<div id="box">
<form method="post">
<div class="header"><h3>Δημιουργία νέου λογαρισμού</h3></div>

<input id="text" type="text" name="username" placeholder="Όνομα χρήστη"><br></br>
<input id="text" type="password" name="password" placeholder="Κωδικός πρόσβασης"><br></br>
<input id="button" type="submit" value="Εγγραφή"><br></br>
<a href="login.php">Σύνδεση</a><br></br>
</form>
</div>
</body>
</html>

