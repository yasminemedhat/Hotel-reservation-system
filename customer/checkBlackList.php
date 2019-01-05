<?php
  $conn = new mysqli('localhost', 'root', '', 'hotels');
  //If the REQUEST_METHOD is POST, then the form has been submitted - and it should be validated.
  // If it has not been submitted, skip the validation and display a blank form.
  session_start();
  if(isset($_SESSION["username"])){
    $username=$_SESSION["username"];
    $query = "SELECT class FROM customers WHERE username='$username'";
    $result = mysqli_query($conn,$query);
    $rows = mysqli_num_rows($result);
    if($rows==1){
        $class = mysql_fetch_row($result);
        //if he's blacklisted
        if($class[0]=='c'){
        echo "blacklisted";
        }
        else{
            echo "not";
         }
     }
    else{
         echo "wrongQuery";
      }
           
              
 
   }
   else{ echo "no username";}
?>