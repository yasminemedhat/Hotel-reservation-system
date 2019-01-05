<!DOCTYPE html>
<html>
<head>
	<title>HOTELS HUB</title>
	<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="../styles/main.css">

</head>


<body>
<div class="container">
	<div class="jumbotron" >
	<h1 style="align:center;">Reservation History</h1>
	</div>
	<nav aria-label="Paging">

	    <ul class="pagination">
  
			 <li class="page-item active"><a class="page-link" href="CustomerReservationHistory.php">Reservations</a></li>
 			 <li class="page-item"><a class="page-link" href="RequestsHistory.php">Reservation Requests</a></li>
		</ul>
	</nav>

    <table class="table table-striped  table-hover" id='table'>


<?php
require_once "server.php";
session_start();
if(isset($_SESSION['username'])){
    $username=$_SESSION['username'];

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

        


    	echo "<tr id=" . $row['id']. "><td>" .$row['hotel_name'] . "</td><td>" . $row['room_type']. "</td><td>" . $row['check_in_date'] . "</td><td>" . $row['check_out_date'] . "</td><td>" . $row['price'] . "</td><td>" . $row['booking_status'] . "</td>";

    	if ($checkin>=$currentDate && $days>=$allowed && $months==$zero && $years==$zero  ) //within allowable cancellation period
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
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    
<script type="text/javascript">
	function del(chosen_id)
	{
jQuery.ajax({
url: "cancelReservation.php",
data:'id='+chosen_id,
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