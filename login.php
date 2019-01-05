<?php
  $conn = new mysqli('localhost', 'root', '', 'hotels');
  session_start();
  //If the REQUEST_METHOD is POST, then the form has been submitted - and it should be validated.
  // If it has not been submitted, skip the validation and display a blank form.
  if(isset($_POST["username"]) && isset($_POST["password"]) ){
    // escape variables for security to be able to insert them db
    $username = mysqli_real_escape_string($conn, $_POST['username']);         
    $password = mysqli_real_escape_string($conn,$_POST['password']);
   //for security
    $psw= md5($password);
    //echo "login-customer";
    
   //check which type of account 1=customer 2=hotel owner 3=broker
  
             //if he's the broker check for the username and password given to him
             if($_POST['radiobtn']=="usertype3"){
                 if($username=="amthebroker" && $password=="87654321"){
                    $_SESSION['username'] = $username;
                     echo "login-broker";
                 }
             }
             //if customer
             else if($_POST['radiobtn']=="usertype1"){
                $query = "SELECT * FROM `customers` WHERE username='$username'
                and password='$psw'";
                 $result = mysqli_query($conn,$query);
                $rows = mysqli_num_rows($result);
                  if($rows==1){
                    $_SESSION['username'] = $username;

                 echo "login-customer";
                 
              }
              
             }
             //if hotel owner
             else if($_POST['radiobtn']=="usertype2"){
                $query = "SELECT * FROM `hotels` WHERE username='$username'
                and password='$password'";
                 $result = mysqli_query($conn,$query);
                $rows = mysqli_num_rows($result);
                  if($rows==1){
             $_SESSION['username'] = $username;
             echo "login-hotel";
              }
              
             }
             else{
               echo "Username and Password are unavailable, please try";
              }
           
              
 
       }
?>