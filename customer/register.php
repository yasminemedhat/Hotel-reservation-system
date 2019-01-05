<?php
  $db = new mysqli('localhost', 'root', '', 'hotels');
  session_start();
  //If the REQUEST_METHOD is POST, then the form has been submitted - and it should be validated.
  // If it has not been submitted, skip the validation and display a blank form.
  if(isset($_POST["username"]) && isset($_POST["password"]) ){
    
    $username=mysqli_real_escape_string($db,$_POST["username"]);
    $_SESSION['username']=$username;
    //skips characters like null and \n
	$password=mysqli_real_escape_string($db,$_POST["password"]);
	$password=md5($password);
	$email=mysqli_real_escape_string($db,$_POST["email"]);
	$firstName=mysqli_real_escape_string($db,$_POST["firstName"]);
	$lastName=mysqli_real_escape_string($db,$_POST["lastName"]);
    $phone=mysqli_real_escape_string($db,$_POST["phone"]);

    $query="INSERT INTO customers(username,password,fname,lname,phone,email,class) values('$username','$password','$firstName','$lastName','$phone','$email','b')";
    //b-->regular customer

   $result= mysqli_query($db,$query);
   if($result)
   {
    $_SESSION['username'] = $username;
  	echo "success";

   }
   else {
   	echo "error!";
   }
}
?>