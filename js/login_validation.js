// Validation Script
function validation()
{   
        var email = document.login.email;
        var password = document.login.password;

    //---- Main Function Call
    if(email_validation(email))
        {
            if(password_validation(password))
            {
                    return true;
            }
        }
    alert("Some Data are Wrong !! ");
    return false;
}

//---- Sub Function


// Email Validation 
function email_validation(email)
{
    var pattern = /[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]$/;
    var email_length = email.value.length;
    var msg = document.getElementById('valid_email');
    // console.log(msg);
    
    if(email_length == 0)
    {
        email.style.border = "2px solid red";
        email.style.borderRadius = "5px";
        msg.innerHTML = "<p style='color:red;'>* Must Required</p>";
        return false;
    }
    else if(email.value.match(pattern))
    {
        email.style.border = "2px solid red";
		email.style.borderRadius = "5px";
		msg.innerHTML = "<p style='color:red;'>Enter valide </p>";
		return false;
    }
    else
    {
        email.style.border = "2px solid green";
		email.style.borderRadius = "5px";
		msg.innerHTML = "<p style='color:red;'><i class='far fa-check-circle'></i></p>";
		return true;
    }
}


// Password Validation 
function password_validation(password)
{
    var pass_length = password.value.length;
    var msg = document.getElementById('valid_password');

    if(pass_length == 0)
    {
        password.style.border = "2px solid red";
        password.style.borderRadius = "5px";
        msg.innerHTML = "<p style='color:red;'>* Must Required</p>";
        return false;
    }
    else if(pass_length < 6 )
    {
        password.style.border = "2px solid red";
		password.style.borderRadius = "5px";
		msg.innerHTML = "<p style='color:red;'> Required minimum 6 character </p>";
		return false;
    }
    else
    {
        password.style.border = "2px solid green";
		password.style.borderRadius = "5px";
		msg.innerHTML = "<p style='color:red;'><i class='far fa-check-circle'></i></p>";
		return true;
    }

}