<?php
session_start();
if(isset($_SESSION['username'])){
     $username=$_SESSION['username'];
}
 else {echo "no username";
 }
?>   
              
             

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../styles/main.css">
    <title>Hotel Hub</title>

</head>
<body>
  
    <div class="container">

           <div class="col-12 text-right">
              <div class="dropdown" style="margin: 20px;">
                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">My Account</button>
                <div class="dropdown-menu">
                <a class="dropdown-item"  href="../customer/customerReservationHistory.php">My Reservations</a>
                 <a class="dropdown-item" href="customer-logout.php">Logout</a>
              </div>
            </div>
          </div>
        <hr>
        <div class="container">
             <div class="row justify-content-md-center align-items-center" style="margin-top: 200px;">
               <div class="col-md-12" style="text-align:center;">
                 <h1 style="margin-bottom: 40px;" >Find your ideal hotel</h1>
                 <div class="search-error" id="search-error"></div>
                </div>
               
                 <div class="input-group col-md-6">
                   <input type="text" class="form-control form-control-lg" id="country" placeholder="Where are you heading to? e.g. Egypt" aria-describedby="basic-addon1">
                      <div class="input-group-append">
                      <button type="button" class="btn btn-primary" id="search-btn" onclick="search()">Search</button>
                      
                    </div>
                   </div>
            </div>
        </div>



</div>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script>
        //function for the search location to check availability of hotels in that country
        function search(){
            var country= $('#country').val();
            //var error= document.getElementById("login-error");
            if($.trim(country).length > 0 )
            {
            $.ajax({
                url:"search-location.php",
                method: "POST",
                data: {
                    country: country
                },
                cache:false,
                success: function (response){
                    
                    //if there are hotels in this country
                    if(response == "available"){

                        window.location.href = "../customer/customer-main-page.php?country="+country;
                    
                        
                    }
                    else {
                        $('#search-error').html("<h6 class='text-danger'>We don't deal with hotels in this country</h6>");
                    }
                
                }
                    
                
            });
        }
        };
        
  </script>

</body>
</html>