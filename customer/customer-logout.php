<?php
session_start();
unset($_SESSION['username']);
// Destroying All Sessions
if(session_destroy())
{
// Redirecting To Home Page
header("Location: ../index.php");
}
?>