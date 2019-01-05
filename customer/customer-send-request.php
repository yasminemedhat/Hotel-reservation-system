<?php
  $conn = new mysqli('localhost', 'root', '', 'hotels');
  //If the REQUEST_METHOD is POST, then the form has been submitted - and it should be validated.
  session_start();
  // If it has not been submitted, skip the validation and display a blank form.
  if(isset($_SESSION['username'])){
    $username=$_SESSION['username'];

     $roomType=$_POST['room_type'];
     $price=$_POST['price'];
     
    $hotel_name=$_POST['hname'];
   $checkin=$_POST['checkin'];
   $checkout=$_POST['checkout'];
   $nowDate=date("Y-m-d");
   $mysql_now=strtotime($nowDate);
   $mysql_checkin = strtotime($checkin);
   $mysql_checkout =strtotime($checkout);
   $datediff1=$mysql_checkin -$mysql_now;
   $datediff2 = $mysql_checkout - $mysql_checkin;
   $numberOfDays= ceil($datediff2 / (60 * 60 * 24)) +1;
   $request_time=date("Y-m-d H:i:s");
   if($datediff2<0 || $datediff1<0){
       echo "wrong date";
   }
   else{
            $priceToBePaid=$numberOfDays * $price;
            $_SESSION['reservation_price']=$priceToBePaid;
            $query = "INSERT INTO reservation_requests (hotel_name, customer_username, room_type, check_in_date, check_out_date, request_time) VALUES ('$hotel_name','$username','$roomType','$checkin','$checkout','$request_time')";
           
            $result = mysqli_query($conn,$query);
            $id=mysqli_insert_id($conn);
            $_SESSION['request_id']=$id;
            if($result==false){
        
                echo "error";
            }
            else{
               echo "sent";
            }          
 
   }
}
?>