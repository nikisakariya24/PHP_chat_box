<?php

include '../config.php';
session_start();

$msg_id = $_POST['msg_id'];


$delete = "delete from chat_message where id = ".$msg_id."";
$responce = $con->query($delete);

if($responce)
{
}
