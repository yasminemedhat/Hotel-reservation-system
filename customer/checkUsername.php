<?php
session_start();
require_once "server.php";  //produces fatal error 
//store information (in variables) to be used across multiple pages.
if (!empty($_POST['username']))
{

	$username=mysqli_real_escape_string($db,$_POST['username']); //skips characters like null and \n
    $query="SELECT * from customers where username='$username';";
     $result= mysqli_query($db,$query);

if (mysqli_num_rows($result) == 1)
{
	//username exists
echo "1";

 }

 else
 {
	//username exists
echo "0";

 }	


}
    mysqli_close($db);
	

?>