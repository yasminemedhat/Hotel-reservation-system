<?php
session_start();
require_once "server.php";  //produces fatal error  //store information (in variables) to be used across multiple pages.
if (isset($_POST['request_id']))
{

	$id=mysqli_real_escape_string($db,$_POST['request_id']); //skips characters like null and \n
    $query="DELETE from reservation_requests where request_id='$id'";
$result= mysqli_query($db,$query);

if ($result == TRUE)
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
	

?>