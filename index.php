<!doctype html>
<html class="index-page" lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="styles/main.css">
    
    <title>Home Page</title>
  </head>
  <body>

<div class="index">
  <div class="container">
    <h2>Login</h2>
    <div id="login-error" action="login.php"></div>
    <form method="post" id="login-form" onsubmit="return false;">
        <div class="form-group">
       
        <label for="username">Username:</label>
        <input type="text"  class="form-control" id="username" placeholder="Enter username" name="username" required>
        </div>
        <div class="form-group">
        <label for="pwd">Password:</label>
        <input type="password" class="form-control" id="password" placeholder="Enter password" name="password"required>
        </div>
        <div class="form-check-inline">
          <label class="form-check-label">
            <input type="radio" class="form-check-input" name="optradio"  value="usertype1" checked >Customer
            </label>
        </div>
        <div class="form-check-inline">
          <label class="form-check-label">
          <input type="radio" class="form-check-input" name="optradio"  value="usertype2" >Hotel Owner
         </label>
         </div>
         <div class="form-check-inline">
          <label class="form-check-label">
          <input type="radio" class="form-check-input" name="optradio"  value="usertype3" >Broker
          </label>
         </div>
       
         <br>

      
     <button type="submit" class="btn btn-primary" id="login-btn">Login</button>
     <br>
    </form>
  <p >Don't have an account? Register now:<br><a href="customer/customer-registration.php">customer</a><br><a href="hotel-owner-registration.php">Hotel owner</a></p>
  

</div>
</div>
    <!-- Optional JavaScript -->
    
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="js/main.js"></script>
  </body>
</html>