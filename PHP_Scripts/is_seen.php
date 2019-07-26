<?php

include '../config.php';
session_start();

$to_user_id = $_POST['to_user_id'];


$update = "update  chat_message set is_seen = 1 where to_user_id = ".$_SESSION['user_id']." and from_user_id = ".$to_user_id."";
$responce = $con->query($update);

if($responce)
{
    print($update);
}
