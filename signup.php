<!-- PHP Script -->
<?php

require './config.php';

session_start();

if(isset($_SESSION['user_name']))
{
    header("location:index.php");
}


if(isset($_POST['signup']))
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $insert = "insert into users(name,email,password) values('$name','$email','$password')";
    // echo $insert;
    $responce  = $con->query($insert);
    if($responce)
    {
        
        $msg = "<div class='alert alert-success'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden=true>&times;</button>
                    <strong>SignUp Successfuly :) </strong> 
                </div>";
        echo $msg;

    }
    else
    {
        $msg = "<div class='alert alert-danger'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden=true>&times;</button>
                    <strong>SignUp Unsuccessfuly :( </strong> 
                </div>";
        echo $msg;
    }
}
?>

<!-- HTML -->
<!DOCTYPE html>
<html lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Chat - Signup</title>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    </head>
    <body>

        <!-- include navbar -->
        <?php include "navbar.php"; ?>

        <div class="container">
            <h1 class="text-center">Chat</h1>
            <br>
            <div class="col-8 m-auto">
                <!-- card start -->
                <div class="card">
                    <div class="card-header">
                        Signup
                    </div>
                    <div class="card-body">
                    <!-- Form -->
                    <form action="#" method="post" name="signup" class="shadow-lg p-4 bg-light" onSubmit="return validation()">

                        <div class="form-group">
                            <label for="">Name : </label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Name" onkeyup="name_validation(this)" require>
                            <small id="valid_name" class="text-muted"></small>
                        </div>  

                        <div class="form-group">
                            <label for="email">Email : </label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Email" onkeyup="email_validation(this)" require>
                            <small id="valid_email" class="text-muted"></small>
                        </div>

                        <div class="form-group">
                            <label for="password">Password : </label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password" onkeyup="password_validation(this)" require>
                            <small id="valid_password" class="text-muted"></small>
                        </div>

                        <div class="form-group">
                            <button type="submit" name=signup class="btn btn-primary form-control">SignUp</button>
                        </div>
                    </form>
                    </div>
                </div>  
            </div>
        </div>

    </body>

    <!-- include JS file -->
    <script src="./js/signup_validation.js" language="javascript" type="text/javascript"></script>
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Bootstrap JavaScript -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


</html>
