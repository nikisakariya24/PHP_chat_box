<!-- PHP Script -->
<?php

require './config.php';

session_start();

if(!isset($_SESSION['user_name']))
{
    header("location:login.php");
}
$user_name  = $_SESSION['user_name'];
?>

<!-- Html  -->
<!DOCTYPE html>
<html lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Chat - Home</title>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
        <!-- Datatable -->
        <link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
        <!-- Emoji area -->
        <link rel="stylesheet" href="https://cdn.rawgit.com/mervick/emojionearea/master/dist/emojionearea.min.css">

    
    </head>
    <body>
        <!-- include navbar -->
        <?php include "navbar.php"; ?>

        <div class="container">
            <br>
            <!-- header -->
            <div>
                <h2><?php echo ucwords($user_name);?></h2>
                <a href="logout.php" class=""> - Logout</a>
            </div>

        

            <div class="row">

                <!-- table -->
                <div class="table-responsive">
                    <table class="table table-striped " id="myTable">
                        <h3 align="center" >User List</h3>
                        <thead class="thead-dark">
                            <tr>
                                <th>User Name</th>
                                <th>Statu</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <!-- Display AJAX Responce Data in table body -->
                        <tbody id="user_details">
                            
                        </tbody>
                    </table>
                </div>

                <!-- Chat Modal  -->
                <div id="user_model_details" class=""></div>
            </div>
        </div>


    </body>

    <!-- include validation JS file -->
    <script src="./js/signup_validation.js" language="javascript" type="text/javascript"></script>

    <!-- Bootstrap JavaScript -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <!-- jQuery -->
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
  
    <!-- jQuery UI -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <!-- Datatable js -->
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

    <!-- Emoji area -->
    <script src="https://cdn.rawgit.com/mervick/emojionearea/master/dist/emojionearea.min.js"></script>


    <!-- ==================================================================== -->
    <script>
        $(document).ready(function(){

            $('#myTable').DataTable();

            // Get User
            fetch_user();

            // Data Refresh in 2 seconds
            setInterval(function() {
                fetch_user();
            }, 2000);

            // Get User Details Function
            function fetch_user()
            {
                $.ajax({
                    url:"PHP_Scripts/fetch_users.php",
                    method:"POST",
                    success:function(data){
                        $('#user_details').html(data);
                    }
                })
            }

            // Get Message Function
            function fetch_message(to_user_id)
            {
                $.ajax({
                    url:"PHP_Scripts/fetch_message.php",
                    method:"POST",
                    data:{to_user_id:to_user_id},
                    success:function(data){
                        $('#chat_history_'+to_user_id).html(data);
                    }
                })
            }

            // Make Chat Dialog Box Function
            function make_chat_dialog_box(to_user_id,to_user_name)
            {
                var modal_content = '<div id="user_dialog_'+to_user_id+'" class="user_dialog" title="You have chat with '+to_user_name+'">'+
                                        '<div style="height:400px; border:1px solid #ccc; overflow-y: scroll; margin-bottom:20px; padding:10px;" class="chat_history" data-touserid="'+to_user_id+'" id="chat_history_'+to_user_id+'">'+
                                        '</div>'+
                                        '<div class="form-group">'+
                                            '<textarea name="chat_message_'+to_user_id+'" id="chat_message_'+to_user_id+'" class="form-control chat_message" data-touserid="'+to_user_id+'"></textarea>'+
                                        '</div>'+
                                        '<div class="form-group" align="right">'+
                                            '<button type="button" name="send_chat" id="'+to_user_id+'" class="btn btn-info send_chat"><i class="fas fa-paper-plane"></i></button>'+
                                        '</div>'+
                                    '</div>';

                $('#user_model_details').html(modal_content);
                
                fetch_message(to_user_id);
                // $("#chat_message_"+to_user_id).emojioneArea();


                // Refresh Message
                setInterval(function() {
                    fetch_message(to_user_id);
                },2000);


                // Delete Message
                $(document).on('click', '.delete-msg', function(){
                    if(confirm("are you soure to delete !"))
                    {
                        $msg_id = $(this).data('msgid');
                        $.ajax({
                            url:"PHP_Scripts/delete_message.php",
                            method:"POST",
                            data:{
                                msg_id:$msg_id
                            },
                            success:function(data){

                            }
                        });
                    }
                });
            }

            // Open dialog box
            $(document).on('click', '.start_chat', function(){
                
                var to_user_id = $(this).data('touserid');
                var to_user_name = $(this).data('tousername');
            
                make_chat_dialog_box(to_user_id, to_user_name);
                
                $("#user_dialog_"+to_user_id).dialog({
                    autoOpen:false,
                    width:500
                });
                $('#user_dialog_'+to_user_id).dialog('open');

                // Seen Sender Message
                $.ajax({
                    url:"PHP_Scripts/is_seen.php",
                    method:"POST",
                    data:{
                        to_user_id:to_user_id,
                    },
                    success:function(data){

                    }
                });

            });
                
            // Send Message (insert)
            $(document).on('click', '.send_chat', function(){

                var to_user_id = $(this).attr('id');
                var chat_message = $('#chat_message_'+to_user_id).val();
                $.ajax({
                    url:"PHP_Scripts/send_message.php",
                    method:"POST",
                    data:{
                        to_user_id:to_user_id,
                        chat_message:chat_message
                    },
                    success:function(data){
                        $('#chat_message_'+to_user_id).val('');
                        // $('#chat_history_'+to_user_id).html(data);
                    }
                });
            });

            // Display is typing msg
            $(document).on('focus', '.chat_message', function(){

                var to_user_id = $(this).data('touserid');
                var is_typing = 1; // typing
     
                $.ajax({
                    url:'PHP_Scripts/is_typing.php',
                    method:'POST',
                    data:{
                        is_typing:is_typing,
                        to_user_id:to_user_id                        
                        },
                    success:function(){

                    }
                });
            });
            $(document).on('blur', '.chat_message', function(){

                var to_user_id = $(this).data('touserid');
                var is_typing = 0; //not typing

                $.ajax({
                    url:'PHP_Scripts/is_typing.php',
                    method:'POST',
                    data:{
                        is_typing:is_typing,
                        to_user_id:to_user_id                        
                    },
                    success:function(){

                    }
                });
            });
        });
    </script>


</html>
