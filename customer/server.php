<?php

$db=mysqli_connect('localhost','root','','hotels');
if(!$db)
{
	echo " unsuccessful connection";
	die("Connection unsuccessful: " . mysqli_connect_error());

}

?>