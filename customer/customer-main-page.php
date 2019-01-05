<?php
session_start();
  $country=$_GET['country'];
  
  if(isset($_SESSION['username'])){
    $username=$_SESSION['username'];
}
$conn = new mysqli('localhost', 'root', '', 'hotels');
  //get all hotles in this country
  $query = "SELECT hotels.hname,city,address,stars,email,room_type,facilities,price,image,rating FROM hotels JOIN hotel_rooms ON hotels.hname=hotel_rooms.hname WHERE lower(country)='$country'";
    $result = mysqli_query($conn,$query); 
    //get all cities in this country
  $query2 = "SELECT city FROM hotels WHERE lower(country)='$country' GROUP BY city";
  $cities = mysqli_query($conn,$query2); 
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
    <title>Hotels Hub</title>
   
</head>
<body>
    

<div class="container-fluid" style="margin: 10px">
    <!-- Modal -->
        <div id="Modal-wrapper" class="modal" role="dialog">
        <div class="modal-dialog" role="document">

            <!-- Modal content-->
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" >&times;</button>
            </div>
            <div class="modal-body mx-3">
                <h6>Do you want to book this room?</h6>  
           </div>            
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="reserve()">Book now</button>
            </div>
            </div>

        </div>
        </div>
        <div class="col-12 text-right">
              <div class="dropdown" style="margin: 20px;">
                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">My Account</button>
                <div class="dropdown-menu">
                <a class="dropdown-item"  href="../customer/customerReservationHistory.php">My Reservations</a>
                 <a class="dropdown-item" href="customer-logout.php">Logout</a>
                 <a class="dropdown-item" href="customer-index.php">back to explore</a>
              </div>
            </div>
          </div>
        <hr>
  <div class="row">

  <div class="col-sm-9" id="hotels_table_div">
   <table class="table table-hover" id="hotels_table" style="height:auto;width:auto;" >

            <tr style="font-weight: bold;height:auto;max-height:100px;">
            <th>Room image</th>
            <th>Hotel</th>
            <th>City</th>
            <th>Stars</th>
            <th>Address</th>
            <th>Room Type</th>
            <th>Facilities</th>
            <th>Price per night</th>
            <th>Hotel Rating</th>
            </tr>
        <tbody id="tableBody">
            <?php
                while($row= mysqli_fetch_assoc($result)){
                    ?><tr style="max-height:310px;height:auto;"onclick="rowClick()"><div id="table-row">
                    <td><?php echo "<img style='max-width:300px; max-height:300px;' src='../images/".$row['image']."'>";?></td>   
                    <td style="white-space: pre;"><?php echo $row['hname']; ?></td>
                    <td><?php echo $row['city']; ?></td>
                    <td><?php echo $row['stars']; ?></td>
                    <td><?php echo $row['address']; ?></td>
                    <td><?php echo $row['room_type']; ?></td>
                    <td><?php echo $row['facilities']; ?></td>
                    <td><?php echo $row['price']; ?></td>
                    <td><?php if($row['rating']!="-1")
                                echo $row['rating'];
                                else
                                echo "No Ratings Yet."; ?></td>

                </div>
                    </tr>
                    <?php
                }
            ?> 
        </tbody>
    </table>
  </div>
  <div class="col-sm-3" >
       <div class="container" style="background-color: #428bca; ">
       <h3 style="margin-bottom:20px;">  Filter hotels by  </h3>
          <div id="filter-stars">
               <div class="row" >

                    <div class="col-sm-3">
                        <h6 style="margin-right:15px;">STARS</h6>
                    </div>
                    <div class="col-sm-9">
                        <div class="form-check" style="margin:0px;">
                            <label><input type="radio" name="star-check" value="1" onclick="starOnCheck()"> 1 Star</label>
                        </div>
                        <div class="form-check">
                            <label><input type="radio" name="star-check" value="2" onclick="starOnCheck()"> 2 Stars</label>
                        </div>
                        <div class="form-check">
                            <label><input type="radio" name="star-check" value="3" onclick="starOnCheck()"> 3 Stars</label>
                        </div>
                        <div class="form-check">
                            <label><input type="radio" name="star-check" value="4" onclick="starOnCheck()"> 4 Stars</label>
                        </div>
                        <div class="form-check">
                            <label><input type="radio" name="star-check" value="5" onclick="starOnCheck()"> 5 Stars</label>
                        </div>
                        <div class="form-check">
                            <label><input type="radio" name="star-check" value="all" onclick="starOnCheck()" checked> show All</label>
                        </div>
                    </div>
                </div>
                <hr>
                <div id="filter-price">
               <div class="row" >

                    <div class="col-sm-3">
                        <h6 style="margin-right:15px;">PRICE</h6>
                    </div>
                    <div class="col-sm-9">
                        <div class="form-check" style="margin:0px;">
                            <label><input type="radio" name="price-check" value="price >= 50 and price <= 99" onclick="priceOnCheck()"> $50-$99</label>
                        </div>
                        <div class="form-check">
                            <label><input type="radio" name="price-check" value="price >= 100 and price <= 149" onclick="priceOnCheck()"> $100-$149</label>
                        </div>
                        <div class="form-check">
                            <label><input type="radio" name="price-check" value="price >= 150 and price <= 199" onclick="priceOnCheck()"> $150-$199</label>
                        </div>
                        <div class="form-check">
                            <label><input type="radio" name="price-check" value="price >= 200 and price <= 249" onclick="priceOnCheck()" > $200-$249</label>
                        </div>
                        <div class="form-check">
                            <label><input type="radio" name="price-check" value="price >= 250" onclick="priceOnCheck()"> $250 and up</label>
                        </div>
                        <div class="form-check">
                            <label><input type="radio" name="price-check" value="all" onclick="priceOnCheck()" checked> show All</label>
                        </div>
                    </div>
                </div>
                <hr>
                <div id="filter-room-type">
               <div class="row" >

                    <div class="col-sm-3">
                        <h6 style="margin-right:15px;">ROOM TYPE</h6>
                    </div>
                    <div class="col-sm-9">
                        <div class="form-check" style="margin:0px;">
                            <label><input type="radio" name="room-type-check" value="single" onclick="roomTypeOnCheck()"> Single</label>
                        </div>
                        <div class="form-check">
                            <label><input type="radio" name="room-type-check" value="double" onclick="roomTypeOnCheck()"> Double</label>
                        </div>
                        <div class="form-check">
                            <label><input type="radio" name="room-type-check" value="quad"onclick="roomTypeOnCheck()" > Quad</label>
                        </div>
                        <div class="form-check">
                            <label><input type="radio" name="room-type-check" value="king" onclick="roomTypeOnCheck()"> King</label>
                        </div>
                        <div class="form-check">
                            <label><input type="radio" name="room-type-check" value="all" onclick="roomTypeOnCheck()" checked> Show all</label>
                        </div>                      
                    </div>
                </div>
                <hr>
                <div id="filter-rating">
               <div class="row" >

                    <div class="col-sm-3">
                        <h6 style="margin-right:15px;">RATINGS</h6>
                    </div>
                    <div class="col-sm-9">
                        <div class="form-check" style="margin:0px;">
                            <label><input type="radio" name="rating-check" value="rating >=1 and rating <=5" onclick="ratingOnCheck()"> 1-5</label>
                        </div>
                        <div class="form-check">
                            <label><input type="radio" name="rating-check" value="(rating =6 or rating =7)" onclick="ratingOnCheck()"> 6-7</label>
                        </div>
                        <div class="form-check">
                            <label><input type="radio" name="rating-check" value="(rating =8 or rating =9)" onclick="ratingOnCheck()"> 8-9</label>
                        </div>
                        <div class="form-check">
                            <label><input type="radio" name="rating-check" value="rating = 10"onclick="ratingOnCheck()" > 10</label>
                        </div>
                        <div class="form-check">
                            <label><input type="radio" name="rating-check" value="all" onclick="ratingOnCheck()" checked> show All</label>
                        </div>
                    </div>
                </div>
                <hr>
                <div id="city-rating" >
                   <div class="row"  >
                       <select id="select_city" style="margin-bottom:20px;" onchange="cityOnSelect()">
                           <option >All Cities</option>
                           <?php
                            while($city=mysqli_fetch_assoc($cities)){ ?>
                                  <option value="<?php echo $city['city']; ?>"><?php echo $city['city'];?></option>
                              <?php
                            } ?>
                        </select>
                    </div>
                </div>
            </div>
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
        //initialize value of filters 1=stars 2=price 3=room type 4=rating 5=city
        var filters = [[1, -1],[2, -1],[3, -1],[4, -2],[5,-1]];
        //making the modal hidden unless triggered
       // $('#Modal-wrapper').modal({ show: false});
        //on choosing to filter on Stars
        function starOnCheck() {
         // Get the form-check
         var box = document.getElementsByName('star-check');
          for (var i = 0, length = box.length; i < length; i++)
            {
                if (box[i].checked)
                 {
                // do whatever you want with the checked radio
                  var stars = box[i].value;
                  if(stars=="all"){
                    filters[0][1]=-1;
                  }
                  else{
                    filters[0][1]=stars;
                  }
                 // only one radio can be logically checked, don't check the rest
                 break;
                 }
            }
            viewData(filters);
        }
        //to update filters and hotles on choosing specific price
        function priceOnCheck() {
         // Get the form-check
         var box = document.getElementsByName('price-check');
          for (var i = 0, length = box.length; i < length; i++)
            {
                if (box[i].checked)
                 {
                // do whatever you want with the checked radio
                  var price = box[i].value;
                  if(price=="all"){
                    filters[1][1]=-1;
                  }
                  else{
                    filters[1][1]=price;
                  }
                  
                 // only one radio can be logically checked, don't check the rest
                 break;
                 }
            }
            viewData(filters);
        }

        //to update filters and hotles on choosing specific room type
        function roomTypeOnCheck() {
         // Get the form-check
         var box = document.getElementsByName('room-type-check');
          for (var i = 0, length = box.length; i < length; i++)
            {
                if (box[i].checked)
                 {
                // do whatever you want with the checked radio
                  var type = box[i].value;
                  if(type=="all"){
                    filters[2][1]=-1;
                  }
                  else{
                    filters[2][1]=type;
                  }
                 // only one radio can be logically checked, don't check the rest
                 break;
                 }
            }
            viewData(filters);
        }

        //to update filters and hotles on choosing specific rating
        function ratingOnCheck(value) {
         // Get the form-check
         var box = document.getElementsByName('rating-check');
          for (var i = 0, length = box.length; i < length; i++)
            {
                if (box[i].checked)
                 {
                    var rating = box[i].value;
                    if(rating=="all"){
                    filters[3][1]=-2;
                  }
                  else{
                    filters[3][1]=rating;
                  }
                 // only one radio can be logically checked, don't check the rest
                 break;
                 }
            }
            viewData(filters);
        }
        function cityOnSelect(){
            var select= document.getElementById("select_city");
            var city = select.options[select.selectedIndex].text;
            if(select.selectedIndex<=0){
                filters[4][1]=-1;
            }
            else{
            filters[4][1]=city;
            }
            viewData(filters);
        }
        

        function viewData(filters){
        var country ="<?php echo $country ?>";
            $.ajax({
        url:"../customer/update-search-hotels.php",
        method: "POST",
        dataType: "json",
        data: {
            filters: filters,
            country: country
        },
        success: function (response){
            //var tbdy = document.getElementById('tableBody');
            //var jcontent = JSON.parse(response);
            var htmlStr="";        //myObj[x].name
            for(var obj in response){
                htmlStr += '<tr style="min-height:200px; max-height=310px;" onclick="rowClick()"><div id="table-row">';
                htmlStr +="<td><img style='max-width:300px; max-height:300px;' src='../images/"+response[obj].image+"'></td>";   
                    
                htmlStr += '<td>'+ response[obj].hname+'</div></td>';
                htmlStr+= '<td>' +response[obj].city+'</div> </td>';
                htmlStr+= '<td>' +response[obj].stars+'</div> </td>';
                htmlStr+= '<td>' +response[obj].address+'</div> </td>';
                htmlStr+= '<td>' +response[obj].room_type+'</div> </td>';
                htmlStr+= '<td>' +response[obj].facilities+'</div> </td>';
                htmlStr+= '<td>' +response[obj].price+'</div> </td>';
                htmlStr+= '<td>' +response[obj].rating+'</div> </td>';
                htmlStr+= '</div></tr>';
            }
            $('#tableBody').html(htmlStr);
            }
        });
    }
    var row_hname;
    var row_room_type;
    //function to view a certain hotel room
    function rowClick(){
        var table = document.getElementById('hotels_table');
        for(var i = 1; i < table.rows.length; i++)
            {
                    table.rows[i].onclick = function()
                    {
                        //rIndex = this.rowIndex;
                         row_hname = this.cells[1].textContent;
                         row_room_type = this.cells[5].textContent;
                         row_price = this.cells[7].textContent;
                        $('#Modal-wrapper').modal();
                    }
            }

    }
   
    function reserve(){

        $.ajax({
        method: "POST",
        url:"checkBlackList.php",
        success: function (response){
            if(response=="blacklisted"){
                alert("Unfortunatly You are blacklisted!");
            }
            else{
                window.location.href = "../customer/customer-reservation.php?hname="+row_hname+"&roomType="+row_room_type+"&price="+row_price;
            }
    }
});
}
</script>
</body>
</html>