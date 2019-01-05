<?php
   $conn = new mysqli('localhost', 'root', '', 'hotels');
   $filter=$_POST['filters'];
   $country=$_POST['country'];
   $preQuery='';
   $moreThanOne=0;
   $allCities=1;
   //stars
   if($filter[0][1]!=-1){
       $val=$filter[0][1];
       $preQuery.=" AND ";
       $preQuery.="stars='$val'";
       $moreThanOne=1;
   }
   //price
   if($filter[1][1]!=-1){
     $preQuery.=" AND ";
     $val=$filter[1][1];
    $preQuery.="$val";
    $moreThanOne=1;
    }
   //room type
   if($filter[2][1]!=-1){

    $preQuery.=" AND ";
    $val=$filter[2][1];
    $preQuery.="room_type='$val'";
    $moreThanOne=1;
  }
   //rating
    if($filter[3][1]!=-2){
    $preQuery.=" AND ";
    $val=$filter[3][1];
    $preQuery.="$val";
    $moreThanOne=1;
}
//city
  /*  if($filter[4][1]!=-1){
        if($filter[4][1]!=-2){
            $moreThanOne=1;
            $allCities=0;
            $preQuery.=" AND ";
            $val=$filter[4][1];
            $preQuery.="city='$val'";
        }else if($filter[4][1]==-2){
            $allCities=1;
        }
    }
    */
    //city
    if($filter[4][1]!=-1){
        $preQuery.=" AND ";
        $val=$filter[4][1];
        $preQuery.="city='$val'";
        $moreThanOne=1;
    } 
     // if($allCities==1 && $moreThanOne==0){
        //$query = "SELECT hotels.hname,address,city,stars,email,room_type,price,facilities,image,rating FROM hotels JOIN hotel_rooms ON hotels.hname=hotel_rooms.hname WHERE country='$country'";
      // }
      // else{
        $query = "SELECT hotels.hname,address,city,stars,email,room_type,price,facilities,image,rating FROM hotels JOIN hotel_rooms ON hotels.hname=hotel_rooms.hname WHERE country='$country'".$preQuery;

      // }
      $result = mysqli_query($conn,$query);
    
      $rows = mysqli_num_rows($result);
      $result_array=array();
      if($rows>=1){
        while($row = $result->fetch_assoc()) {
            if($row['rating']=="-1"){
                $row['rating']="No Ratings Yet";
            }
            array_push($result_array, $row);
    
        }
        echo json_encode($result_array);
      }
      else{
        echo json_encode($result_array);
      }
?>