<?php 

require './config.php';
session_start();

//Change Login Status (0 = offlone) & (1 = online)
$update = "update users set status = 0 where email = '".$_SESSION['user_email']."'";
if($con->query($update))
{
    echo "logout";
}
else
{
    echo "error";
}
session_destroy();

header("location:login.php");

?>