<?php
session_start();
include("connection.php");
include("functions.php");


if($_SERVER['REQUEST_METHOD']=="POST"){
    $username=$_POST['username'];
    $password=$_POST['password'];

    if(!empty($username) && !empty($password) && !is_numeric($username)){
     $query="select * from users where username='$username'limit 1";
$result = mysqli_query($con,$query);
if($result){
if($result && mysqli_num_rows($result)>0){
    $user_data=mysqli_fetch_assoc($result);
    if($user_data['password']===$password){
        $_SESSION['user_id']=$user_data['user_id'];
        header("Location: index.php");
        die;
    }
}
}
echo"Λάθος όνομα χρήστη ή κωδικός";
    }else{
        echo"Λάθος όνομα χρήστη ή κωδικός";
    }
}
?>

<!DOCTYPE html>
<html lang="el">
<head>

<title>Σύνδεση</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
 </head>

<body>
<div id="box">
<form method="post">
<div class="header"><h3>Σύνδεση σε λογαριασμό</h3></div>

<input id="text" type="text" name="username" placeholder="Όνομα χρήστη"><br></br>
<input id="text" type="password" name="password" placeholder="Κωδικός πρόσβασης"><br></br>
<input id="button" type="submit" value="Σύνδεση"><br></br>
<a href="signup.php">Εγγραφή</a><br></br>
</form>
</div><br></br>


</body>
</html>

