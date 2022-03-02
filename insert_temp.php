<?php

if(isset($_GET["watervalue"])) {
   $watervalue = $_GET["watervalue"]; // get water value from HTTP GET
   $servername = "localhost";
   $username = "root";
   $password = "";
   $dbname = "db_arduino";

   // Create connection
   $conn = new mysqli($servername, $username, $password, $dbname);
   // Check connection
   if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
   }

   $sqli = "INSERT INTO tbl_temp (watervalue) VALUES ('$watervalue')";
   

   if ($conn->query($sqli) === TRUE) {
      echo "New record created successfully";
      if ($watervalue<0.50){
      $result ="INSERT INTO tbl_temp (situation) VALUES ('Safe')";
   }
   else if ($watervalue>=0.5 && $watervalue<1.0){
      $result ="INSERT INTO tbl_temp (situation) VALUES ('Alert level')";
   }
   else if ($watervalue>=1.0) {
      $result ="INSERT INTO tbl_temp (situation) VALUES ('Danger level')";
   }
   else {
      echo "Error: " . $sqli . " => " . $conn->error;
   }
   } 
   

} 

   else {
      echo "value is not set";
   }
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>
    <table class="table" >
        <tr>
            <th>temp_id</th>
            <th>Water Value</th>
            <th>Condition</th>

        </tr>
        
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "db_arduino";
     
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
         $sql ="SELECT * FROM tbl_temp;";
         $result = mysqli_query($conn, $sql);
         $resultCheck = mysqli_num_rows($result);
         
         if ($resultCheck > 0){
            while ($row = mysqli_fetch_assoc($result)){
               echo "<tr>";
               echo "<td>".$row['temp_id']."</td>";
               echo "<td>".$row['watervalue']."</td>";
               echo "<td>".$row['situation']."</td>";
            }
         }
                
        ?>

        <?php    
                echo "</tr>";
        ?>
    </table>
</body>
</html>