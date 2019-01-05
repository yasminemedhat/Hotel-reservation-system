<?php
  $conn = new mysqli('localhost', 'root', '', 'hotels');
  //If the REQUEST_METHOD is POST, then the form has been submitted - and it should be validated.
  // If it has not been submitted, skip the validation and display a blank form.
  session_start();
  if(isset($_POST["country"])){
    $country=$_POST["country"];
    $query = "SELECT * FROM `hotels` WHERE country='$country'";
    $result = mysqli_query($conn,$query);
    $rows = mysqli_num_rows($result);
    if($rows>0){
      $_SESSION['country'] = $country;
      $_SESSION['hotels'] = $result;
   
      echo "available";
     }
    else{
         echo "unavailable";
      }
           
              
 
   }
?>