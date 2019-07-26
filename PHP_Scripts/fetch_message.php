<?php

include '../config.php';
session_start();

$user_id  = $_SESSION['user_id'];
$to_user_id = $_POST['to_user_id'];

$select = "select  chat_message.message, chat_message.* , users.name 
                from chat_message 
                JOIN users
                on chat_message.from_user_id = users.user_id
                where (chat_message.to_user_id='$to_user_id' AND chat_message.from_user_id='$user_id') 
                or (chat_message.to_user_id='$user_id' AND chat_message.from_user_id='$to_user_id') 
                ORDER BY chat_message.timestamp";
$select_responce = $con->query($select);
if($select_responce->num_rows >= 1)
{
    $output = '<ul class="list-group">';
    while($row = $select_responce->fetch_assoc())
    {   
        // Check User
        if($row['from_user_id'] == $user_id )
        {
            $user = '<b class="float-right text-success"> - You </b>';
            $class = 'success';
        }
        else
        {
            $user = '<b class="float-right text-primary"> - '.ucwords($row['name']).'</b>';
            $class = 'primary';
        }
        $time = '<br><small class="float-right text-secondary">  '.$row['timestamp'].'</small>';
        $output .= '<li class="list-group-item list-group-item-'.$class.'" >'.$row['message'].$user.$time.'
                        <button class="badge badge-danger badge-pill delete-msg" data-msgid="'.$row['id'].'" >X</button>
                    </li>';
    }
    $output .= '</ul>';
}
else
{
    $output = "new conversation";
}

echo $output;