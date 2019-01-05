<!DOCTYPE html>
<html>
<head>
	<title>HOTELS HUB</title>
	<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="../styles/main.css">
</head>


<body>
<div class="container">
	<div class="jumbotron" >
	<h1 style="align:center">Pending Reservations</h1>
	</div>
	<nav aria-label="Paging">

	    <ul class="pagination justify-content-center">
  
			 <li class="page-item"><a class="page-link" href="customerReservationHistory.php">Reservations</a></li>
 			 <li class="page-item  active"><a class="page-link" href="CustomerRequestsHistory.php">Reservation Requests</a></li>
		</ul>
	</nav>

    <table class="table table-striped  table-hover" id='table'>


<?php
require_once "server.php";  
session_start();

if(isset($_SESSION["username"])){
	$username=$_SESSION["username"];
	//if I need to update the db
	if(isset($_SESSION['request_id']) && isset($_SESSION['reservation_price'])){
				$request_id=$_SESSION['request_id'];
				$priceToBePaid=$_SESSION['reservation_price'];
			//update the requests and reservation first (for testing purposes only)
			$update_query="SELECT * FROM reservation_requests WHERE  request_id='$request_id'";
			
			$update_result= mysqli_query($db,$update_query);
			
			if (mysqli_num_rows($update_result) > 0)
			{
				while($row=mysqli_fetch_array($update_result))
				{
			
				//check if 30 seconds have passed 
						$checkTime= strtotime(date("Y-m-d H:i:s")) - strtotime($row['request_time']);
						if($checkTime>=30){
							//consider it accepted delete the request and put it in the reservations
						$query4="DELETE FROM reservation_requests WHERE request_id='$request_id'";
						$result4 = mysqli_query($db,$query4);
						if($result4){
							//get details of the request to accept it
							$hotel_name=$row['hotel_name'];
							$roomType=$row['room_type'];
							$checkin=$row['check_in_date'];
							$checkout=$row['check_out_date'];
							$query5="INSERT INTO reservations (hotel_name,request_id,customer_username, room_type, check_in_date, check_out_date,price) VALUES ('$hotel_name','$request_id','$username','$roomType','$checkin','$checkout','$priceToBePaid')";
							$result5 = mysqli_query($db,$query5);
							if(!$result5){
								echo "something went wrong";
							}
							
						}  
						}
					}
				}
			}
$query="SELECT * FROM reservation_requests WHERE customer_username='$username' ORDER BY check_in_date ;";
$result= mysqli_query($db,$query);

if (mysqli_num_rows($result) > 0)
{
	//History exists
	//echo "<table class="table table-dark table-hover" id='table'>";
	while($row=mysqli_fetch_array($result))
	{
	echo "<thead>
      <tr>
        <th>Hotel</th>
        <th>Room type</th>
        <th>Check In</th>
        <th>Checkout</th>
        <th>Price</th>
      </tr>
    </thead>";
    echo "<tbody>";

			
			


    	$checkin= new DateTime($row['check_in_date']);
    	

    	echo "<tr id=" . $row['request_id']. "><td>" .$row['hotel_name'] . "</td><td>" . $row['check_in_date'] . "</td><td>" . $row['check_out_date'] . "</td><td>" . $priceToBePaid."</td>";

    	
    	echo "<td><button type=button class=\"btn btn-primary\" id=". $row['request_id']." onClick=\"del(this.id)\">Cancel</button></td>";
        
        	echo "<td></td>";

		echo "</tr>";
		echo "</tbody>";
		echo "</table>";
	
		echo "<p>Once accepted, they will be moved to the reservations.</p>";
    }
    


   
}
else 
{
	echo "<p> No pending reservations!</p>";
}
    echo "</div>";
}

?>
 <br>
    <a  href="../customer/customer-index.php">Back to explore</a>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  
<script type="text/javascript">
	function del(chosen_id)
	{
jQuery.ajax({
url: "cancelReservationRequest.php",
data:{
	request_id: chosen_id
},
type: "POST",
success:function(data){
if(data == 1) { //success
alert("Reservation Cancelled!")
var row=(document.getElementById(chosen_id));
row.parentNode.removeChild(row);

} else {

alert ("Error! couldn't cancel!");

}

},
error:function (){}
});

	}

</script>


</body>
</html>