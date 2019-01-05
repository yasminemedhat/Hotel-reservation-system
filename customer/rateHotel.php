<?php
require_once "server.php";  //produces fatal error 
 //store information (in variables) to be used across multiple pages.
//if ( isset( $_SESSION['username'] ) ) {
    // Grab user data from the database using the user_id
    // Let them access the "logged in only" pages
  //  $username=$_SESSION['username'];
  session_start();
  if(isset($_SESSION['username'])){
	$username=$_SESSION['username'];
  
if (!empty($_POST['hotel']))
{

	$rate=$_POST['rate']; //skips characters like null and \n
	$hotel=$_POST['hotel']; //skips characters like null and \n

    $query="INSERT INTO ratings (customer_username, hotel_name, rating) VALUES ('$username','$hotel',$rate)";
$result= mysqli_query($db,$query);
//update the rated hotel's rating
$updateRatingQuery="SELECT AVG(rating) FROM ratings WHERE hotel_name='$hotel' GROUP BY hotel_name";
$rateUpdateResult= mysqli_query($db,$updateRatingQuery);
$row=mysqli_fetch_array($rateUpdateResult);
$newRate=$row['AVG(rating)'];
$newRate=round($newRate);
$newRateQuery="UPDATE hotels SET rating='$newRate' WHERE hname='$hotel'";
$result2=mysqli_query($db,$newRateQuery);

if ($result && $result2)
{
	//successful
echo "1";

 }

 else
 {
	
echo "0";

 }	


}
    mysqli_close($db);
  }	

?>