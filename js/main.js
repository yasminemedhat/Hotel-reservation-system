
//function for the login 
$(document).ready(function(){
    $('#login-btn').click(function(){
    var username= $('#username').val();
    var password= $('#password').val();

   

    var radios = document.getElementsByName('optradio');
//check which usertype
for (var i = 0, length = radios.length; i < length; i++)
{
 if (radios[i].checked)
 {
  // do whatever you want with the checked radio
    var usertype = radios[i].value;

  // only one radio can be logically checked, don't check the rest
  break;
 }
}

    //var error= document.getElementById("login-error");
    if($.trim(username).length > 0 && $.trim(password).length > 0)
    {
        
    $.ajax({
        url:"login.php",
        method: "POST",
        data: {
            username: username,
            password: password,
            radiobtn: usertype
        },
        cache:false,
        success: function (response){
            
            //if login is successful and type is a customer
            if(response == "login-customer"){
                  //pass the user name to the customer-index
                    window.location = "customer/customer-index.php";
                
                    
                }
                //if login is successful and type is hotel owner
            else if(response =="login-hotel"){
                        window.location = "hotel/hotel-index.php";
                        
                    }
             //if login is successful and type is broker
             else if(response == "login-broker"){
                    window.location = "broker/broker-index.php";
                   
                }
                else {
                    $('#login-error').html("<h6 class='text-danger'>Invalid username and Password</h6>");
                    return false;
                }
            }
        
    });
}
});
});

