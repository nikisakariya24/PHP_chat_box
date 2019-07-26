<?php

include '../config.php';
session_start();

$to_user_id = $_POST['to_user_id'];
$is_typing = $_POST['is_typing'];


$update = "update  users set is_typing = ".$is_typing." where user_id = ".$_SESSION['user_id']."";
$responce = $con->query($update);

if($responce)
{
    print($update);
}
