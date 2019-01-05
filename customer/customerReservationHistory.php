<!DOCTYPE html>
<html>
<head>
	<title>HOTELS HUB</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../styles/main.css">
	


	<style>
	p.ex1 {
		border: 1px solid red; 
		padding-top: 25px;
	}
</style>
</head>


<body>
	<div class="container">
		<div class="jumbotron" >
			<h1 style="align:center;">Reservation History</h1>
		</div>
		<nav aria-label="Paging">

			<ul class="pagination justify-content-center">

				<li class="page-item active"><a class="page-link" href="CustomerReservationHistory.php">Reservations</a></li>
				<li class="page-item"><a class="page-link" href="CustomerRequestsHistory.php">Reservation Requests</a></li>
			</ul>
		</nav>


		<table class="table table-striped  table-hover" id='table'>


<?php
require_once "server.php";  //produces fatal error 
session_start();
if(isset($_SESSION["username"])){
$username=$_SESSION["username"];
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
						if($result5){
							echo "Something went wrong";
					    }
				}
			}
		}
	}
}



$query="SELECT * FROM reservations WHERE customer_username='$username' ORDER BY check_in_date ;";
$result= mysqli_query($db,$query);



if (mysqli_num_rows($result) > 0)
{
//History exists
//echo "<table class="table table-dark table-hover" id='table'>";

	echo "<thead>
	<tr>
	<th>Hotel</th>
	<th>Room type</th>
	<th>Check In</th>
	<th>Checkout</th>
	<th>Price</th>
	<th>Booking Status</th>
	<th>Rate The Hotel</th>
	</tr>
	</thead>";
	echo "<tbody>";

	$allowed=3;
	$zero=0;

	while($row=mysqli_fetch_array($result))
	{
		$checkin= new DateTime($row['check_in_date']);
		$status=$row['booking_status'];
		$currentDate=new DateTime(date("Y-m-d"));
		$difference = $checkin->diff($currentDate);
		$days=$difference->d;
		$months=$difference->m;
		$years=$difference->y;
		$rated=0;
		$id=$row['id'];
		$hotel_name=$row['hotel_name'];
		$query2="SELECT * from actual_checks where reservation_id='$id';";
		$result2= mysqli_query($db,$query2);
		if (mysqli_num_rows($result2) != 0)
		{
			$query3="SELECT rating from ratings WHERE customer_username='$username' AND hotel_name='$hotel_name' ;";
			$result3= mysqli_query($db,$query3);
			if (mysqli_num_rows($result3) > 0)
			{
				$row2=mysqli_fetch_array($result3);
				$rating=$row2['rating'];
				$rated=1;

			}

		}




		echo "<tr id=" . $row['id']. "><td>" .$row['hotel_name'] . "</td><td>" . $row['room_type']. "</td><td>" . $row['check_in_date'] . "</td><td>" . $row['check_out_date'] . "</td><td>" . $row['price'] . "</td><td>" . $row['booking_status'] . "</td>";
		if ($rated==1)
		{
			echo "<td>". $rating ."</td>";

		}
		else if (mysqli_num_rows($result2) >0){ //checkin exist

			echo "<td><button type=button class=\"btn btn-primary\" id=". $row['id']." onClick=\"modal('$hotel_name')\">Rate Hotel</button></td>";

		}
		else
		{
			echo "<td></td>";
		}
if ($checkin>=$currentDate && $days>=$allowed && $months>=$zero && $years>=$zero  ) //within allowable cancellation period
{echo "<td><button type=button class=\"btn btn-primary\" id=". $row['id']." onClick=\"del(this.id)\">Cancel</button></td>";}
else
	{echo "<td></td>";}

echo "</tr>";
}


echo "</tbody>";
echo "</table>";
//  echo "</div>";
}

else 
{
	echo "<p> No reservations yet!</p>";
}
echo "</div>";

}

?>
 <br>
    <a  href="../customer/customer-index.php">Back to explore</a>
<!-- Modal -->
<div class="modal fade" id="modal" name="modal" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Rate Hotel</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p>How did you find this hotel?</p>
				<div class="btn-toolbar" role="toolbar" aria-label="bts">
					<div class="btn-group mr-2" name="ratesbtns" role="group" aria-label="First group">
						<button type="button" onClick="addRate('1')" class="btn btn-secondary" id="1">1</button>
						<button type="button" onClick="addRate('2')" class="btn btn-secondary" id="2">2</button>
						<button type="button" onClick="addRate('3')"  class="btn btn-secondary" id="3">3</button>
						<button type="button" onClick="addRate('4')"  class="btn btn-secondary" id="4">4</button>
						<button type="button" onClick="addRate('5')"  class="btn btn-secondary" id="5">5</button>
						<button type="button" onClick="addRate('6')"  class="btn btn-secondary" id="6">6</button>
						<button type="button" onClick="addRate('7')"  class="btn btn-secondary" id="7">7</button>
						<button type="button" onClick="addRate(8)"  class="btn btn-secondary" id="8">8</button>
						<button type="button" onClick="addRate('9')"  class="btn btn-secondary" id="9">9</button>
						<button type="button" onClick="addRate('10')"  class="btn btn-secondary" id="10">10</button>
						<h5> /10</h5>
					</div>

				</div>
				<div class="modal-footer"></div>
			</div>
		</div>
	</div>
</div>

 <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    
<script type="text/javascript">
var hotelname=null;
var rate=null;
		function del(chosen_id)
		{

			jQuery.ajax(
			{
				url: "cancelReservation.php",
				data:'id='+chosen_id,
				type: "POST",
				success:function(data)
				{
						if(data == 1) { //success
						alert("Reservation Cancelled!");
						var row=(document.getElementById(chosen_id));
						row.parentNode.removeChild(row);

						} 
						else {

						alert ("Error! couldn't cancel!");

						}

				},
				error:function (){}
			});
		}



		function addRate(rate)
		{

			hotelname = document.getElementById("modal").getAttribute("name");
            jQuery.ajax({
	 			method: "POST",
                url: "rateHotel.php",
                data: {
				hotel: hotelname,
				rate: rate
				},
				success:function(response)
				{
					if (response=="1"){
						alert("Successful Rating!");
						
					}
				  else{
					alert("Error! Couldn't rate");
					 }
					 $('#modal').modal('hide');
				}
			});


		}

		function modal(hotel)
		{
			document.getElementById("modal").setAttribute("name",hotel);   
			$("#modal").modal();
		}

	</script>
</body>
</html>
