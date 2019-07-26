<?php

include '../config.php';
session_start();

$output = '';

$select = "select * from users where user_id != '".$_SESSION['user_id']."'";
$responce = $con->query($select);

if($responce->num_rows > 1)
{
    while($row = $responce->fetch_assoc())
    {
        if($row['status'] == 0)
        {
            // Offline
            $status = "<span class='badge badge-danger text-wrap'>Offline</span>";
        }
        else
        {
            // Online
            $status = '<span class="badge badge-success text-wrap">Online</span>';
        }

        // Disply is typing message
        if($row['is_typing'] == 1)
        {
            $is_typing = ' - <small class="text-success">typing..</small>';
        }
        else
        {
            $is_typing = '';
        }

        // Disply Notification
        $count_unseen_msg = "select COUNT(message) as count FROM chat_message WHERE (to_user_id = '".$_SESSION['user_id']."' AND from_user_id = '".$row['user_id']."') and is_seen = 0";
        $count_responce = $con->query($count_unseen_msg);
        $count = $count_responce->fetch_assoc();
        if($count['count'] >= 1)
        {
            $notification = ' - <small class="badge badge-success badge-pill">'.$count['count'].'</small>';
        }
        else
        {
            $notification = '';
        }
 
        $output.="<tr>
                    <td>".$row['name'].$is_typing.$notification."</td>
                    <td>".$status."</td>
                    <td>
                        <button type='button' class='btn btn-info text-wrap btn-xs start_chat' data-touserid='".$row['user_id']."' data-tousername='".$row['name']."' data-status=''><i class='fas fa-comments'></i></button>
                    </td>
                </tr>";
    }
}
echo $output;




