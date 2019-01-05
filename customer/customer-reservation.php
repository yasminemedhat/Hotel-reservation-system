<?php 
   $conn = new mysqli('localhost', 'root', '', 'hotels');
   session_start();
   if(isset($_SESSION['username'])){
    $username=$_SESSION['username'];

   $roomType=$_GET['roomType'];
   $hotel_name=$_GET['hname'];
   preg_replace('/[^A-Za-z0-9\-]/', '', $hotel_name);
   preg_replace('/[^A-Za-z0-9\-]/', '', $roomType);
   $price=$_GET['price'];
   }    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../styles/main.css">
    <title>Room booking</title>
</head>
<body>
 <div class="customer">
    <div style="margin:60px;">
        <div class="col-12 text-right">
           <div class="dropdown" style="margin: 20px;">
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">My Account</button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="customerReservationHistory.php">My Reservations</a>
                <a class="dropdown-item" href="customer-logout.php">Logout</a>
            </div>
        </div>
      </div>
 
 <hr>
   <div id="request-response"></div>
   <h3 style="margin-bottom:50px;"><?php echo "Hotel: ".$hotel_name."---Room Type: ".$roomType."---Price per night= $".$price; ?></h3>
    <form method="post" id="login-form" >
        <div class="form-group">
       
        <label style="font-size:large;"for="checkin"><b>Check-in:</b></label>
        <input type="date"  class="form-control" id="checkin" name="checkin" required>
        </div>
        <div class="form-group">
        <label for="checkout" style="font-size:large;"><b>Check-out:</b></label>
        <input type="date" class="form-control" id="checkout" name="checkout"required>
        </div>
       
         <br>
        <button type="button" class="btn btn-primary" id="login-btn" onclick="sendRequest()">Send Request</button>
     <br>
    </form>
    <br>
    <a  href="../customer/customer-index.php">Back to explore</a>
</div>
</div>
 <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
   <script>
       function sendRequest(){
        var hname="<?php echo $hotel_name?>";
        var type="<?php echo $roomType?>";
        var price="<?php echo $price?>";
        var checkin= $('#checkin').val();
        var checkout= $('#checkout').val(); 
        var msg=document.getElementById("request-response"); 

    $.ajax({
        url:"customer-send-request.php",
        method: "POST",
        data: {
            hname: hname,
            room_type: type,
            price: price,
            checkin: checkin,
            checkout: checkout
        },
        cache:false,
        success: function (response){
           if(response=="sent"){
            msg.innerHTML= "<h6>Booking request was sent to the hotel successfully, Please check your reservations for more updates of the request status.</h6>";
           }
            else if(response=="wrong date"){
            msg.innerHTML= "<h6 class='text-danger'>The dates below are incorrect,make sure checkout date is after checkin date, and checkin is a future date.</h6>";
            }else{
            msg.innerHTML= "<h6 class='text-danger'>An error occured while sending the request, Please try again.</h6>";
            }
       }
    });
}
    
 </script>
</body>
</html>