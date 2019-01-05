<?php

require_once "server.php";  //produces fatal error 
//store information (in variables) to be used across multiple pages.
session_start();
if (!empty($_POST['id']))
{

	$id=mysqli_real_escape_string($db,$_POST['id']); //skips characters like null and \n
    $query="DELETE from reservations where id='$id';";
$result= mysqli_query($db,$query);

if ($result === TRUE)
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