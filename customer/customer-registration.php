<!DOCTYPE html>
<html>
<head>
<title>Hotels Hub</title>
<!--Metadata is data (information) about data.
page descriptions, keywords, author
can be used by browsers-->
<meta charset="utf-8">
<!-- To ensure proper rendering and touch zooming,
add the following <meta> tag inside the <head> element: -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!--Tells microsoft edge to view it in the highest available mode-->
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">


<!-- <style type="text/css">
body {  background-color: #92a8d1 !important; } /* Adding !important forces the browser to overwrite the default style applied by Bootstrap */
</style>-->
</head>
<body>
 <div class="reg">  
<div class="container" style="background-color: #eaeaea;">

<form method="post">
<!--HTML form for user input-->
<!--POST:  data is not shown is in URL-->
<p></p>
<h2 style="margin-bottom: 40px;">Sign Up</h2>
<p></p>
<div id="register-error"></div>
	<div class="form-group">
		<p></p>
		<div class="row">
			<div class="col-sm-1" ><h6 style="margin-right: 20px;">Name:</h6></div>
			<div class="col-sm-7" >
			<div class="input-group mb-3">
				<input type="text" class="form-control" id="firstName" name="firstName" required placeholder="first name" onmouseleave="checkEmptyFields();" >
				<input type="text" class="form-control" id="lastName"  name="lastName" required placeholder="surname" onmouseleave="checkEmptyFields();">
			</div>
		</div>
	</div>

	<div class="form-group">
		<div class="row">
			<div class="col-sm-1" ><h6  style="margin-right: 20px;" >Username:</h6></div>
			<div class="col-sm-10" >
				<input type="text" class="form-control" id="username" name="Username" required placeholder="username" onkeyup="checkUsername();" onmouseleave="checkEmptyFields();">
			   <span id='messageUsername'></span>

			</div>
		</div>
	</div>

	<div class="form-group">
		<div class="row">
			<div class="col-sm-1" ><h6  style="margin-right: 20px;">Email:</h6></div>
			<div class="col-sm-10" >
				<input type="Email" class="form-control" id="email" name="email" required placeholder="email@email.com" onmouseleave="checkEmptyFields();" >
			</div>
		</div>
	</div>

	<div class="form-group">
		<div class="row">
			<div class="col-sm-1" ><h6  style="margin-right: 20px;">Password:</h6></div>
			<div class="col-sm-10" >
				<input type="Password" class="form-control" id="pwd" name="pwd" required placeholder="password" onkeyup='checkPassword();'  onmouseleave="checkEmptyFields();" />
			</div>
		</div>
	</div>

	<div class="form-group">
		<div class="row">
			<div class="col-sm-1" ><h6  style="margin-right: 20px;">Retype Password:</h6></div>
			<div class="col-sm-10" >
				<input type="Password" class="form-control" id="pwd2" name="pwd2" required placeholder="retype password" onkeyup='checkPassword();'/>
			    <span id='message'></span>
			</div>

		</div>
	</div>

	<div class="form-group">
		<div class="row">
			<div class="col-sm-1" ><h6  style="margin-right: 20px;">Phone Number:</h6></div>
			<div class="col-sm-10" >
				<input type="tel" id="phone" class="form-control" name="phone" required placeholder="phone number"  onmouseleave="checkEmptyFields();">
			</div>
		</div>
	</div>

<div class="form-group">
		<div class="row">
			<div class="col-sm-1" ></div>
			<div class="col-sm-10"  >
				<button style="width: 130px;"type="submit" id="Submit" name="submitbtn" class="btn btn-primary" disabled="true" onclick="register()" >Submit</button>
			    <span id='submitmsg'></span>
			</div>
			
		</div>

    </div>
    <div class="row">
    <div class="col-sm-1" ></div>
			<div class="col-sm-10"  >

			Have an account? <a href="../index.php">log in</a>
			instead!
        </p>
</div>
</div>
</div>



</form>
</div>
</div>
 <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
   
<script>
	var errorsUsername=0;
	var errorPassword=0;
	function checkPassword()
	{

 if (document.getElementById('pwd').value ==
    document.getElementById('pwd2').value) {
    document.getElementById('message').style.color = 'green';
    document.getElementById('message').innerHTML = 'matching';
    errorPassword=0;


  } else {
    document.getElementById('message').style.color = 'red';
    document.getElementById('message').innerHTML = 'not matching';
    errorPassword=1;
  }	}


   function checkUsername()
   {

jQuery.ajax({
url: "checkUsername.php",
data:'username='+$("#username").val(),
type: "POST",
success:function(data){
if(data == 1) {
$("#messageUsername").html("Username Not Available.");
errorsUsername=1;
} else {

$("#messageUsername").html("Username Available.");
errorsUsername=0;

}

},
error:function (){}
});

}

function checkEmptyFields()
{

	var a=document.getElementById('firstName').value;
	var b=document.getElementById('lastName').value;
	var c=document.getElementById('username').value;
	var d=document.getElementById('pwd').value;
	var e=document.getElementById('email').value;
	var f=document.getElementById('phone').value;
	if (a==null || a=="" ||b==null || b==""||c==null || c==""||
		d==null || d=="" ||e==null || e==""||f==null || f==""||errorPassword==1||errorsUsername==1)
	{
		  document.getElementById('Submit').disabled=true;
		// document.getElementById('submitmsg').style.color = 'red';
        // document.getElementById('submitmsg').innerHTML = 'Fill all fields please!';

	}
	else
		 document.getElementById('Submit').disabled=false;
		// document.getElementById('submitmsg').style.color = 'green';
        // document.getElementById('submitmsg').innerHTML = 'Let\'s go!';

}
//function for the registration 
function register(){
    var firstName=$('#firstName').val();
    var lastName=$('#lastName').val();
    var username= $('#username').val();
    var password= $('#pwd').val();
    var email=$('#email').val();
    var phone=$('#phone').val();

        
    $.ajax({
        url:"register.php",
        method: "POST",
        data: {
            username: username,
            password: password,
            firstName: firstName,
            lastName: lastName,
            email: email,
            phone: phone
        },
        cache:false,
        success: function (response){
            
            //if login is successful and type is a customer
            if(response == "success"){
                  //pass the user name to the customer-index
                    window.location = "customer-index.php";
                }
                else {
                    $('#register-error').html("<h6 class='text-danger'>something went wrong please try again!</h6>");
                    return false;
                }
            }
        
    });
}

</script>



</body>
</html>