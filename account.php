<?php
   include "header.php";

?>

      <div class="container">
      <div class="row">
      <div class="col-lg-1">
      </div>
      <div class="col-lg-3">
      <br>
      <?php
      // change the value of $dbuser and $dbpass to your username and password
          include 'connectvars.php';
          if (!$_GET["aid"]) {
            $aid = $uid_in;
          }
          else {
            $aid = $_GET["aid"];
          }
           $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
           if (!$conn) {
              die('Could not connect: ' . mysql_error());
           }
          $query = "SELECT Student.sID, Student.sname AS Name, Account.Username AS Username FROM Student INNER JOIN Account ON Student.Account_ID = Account.Account_ID WHERE Account.Account_ID = $aid";
         $student = mysqli_query($conn, $query);
         if (!$student) {
            echo "<script>window.location = 'login.php'</script>";
         }

         $oquery = "SELECT Owner.Owner_ID, Owner.Owner_name AS Name, Account.Username AS Username FROM Owner INNER JOIN Account ON Owner.Account_ID = Account.Account_ID WHERE Account.Account_ID = $aid";
        $owner = mysqli_query($conn, $oquery);
        if (!$owner) {
           die("Query to show fields from table failed");
        }
        // get number of columns in table
          $fields_num = mysqli_num_fields($student);
          while($row = mysqli_fetch_array($student)){
             //echo "<td>$cell<a href='singleRestaurant.php?rid=$row[0]&rname=$row[1]&uid=$uid_in&uname=$uname_in'>".$row[1]."</a></td>";
             //echo "<td>$cell<a href='singleRestaurant.php?rid=$row[0]&rname=$row[1]&uid=$uid_in&uname=$uname_in'>".$row[2]."</a></td>";
             //echo "<td>$cell<a href='singleRestaurant.php?rid=$row[0]&rname=$row[1]&uid=$uid_in&uname=$uname_in'>".$row[3]."</a></td>";
             $sid = $row[0];
             $sname = $row[1];
             $uname = $row[2];
          //echo "</tr>\n";
          }
         if ($aid == $uid_in) {
             $fields_num = mysqli_num_fields($owner);
             while($row = mysqli_fetch_array($owner)){
                //echo "<td>$cell<a href='singleRestaurant.php?rid=$row[0]&rname=$row[1]&uid=$uid_in&uname=$uname_in'>".$row[1]."</a></td>";
                //echo "<td>$cell<a href='singleRestaurant.php?rid=$row[0]&rname=$row[1]&uid=$uid_in&uname=$uname_in'>".$row[2]."</a></td>";
                //echo "<td>$cell<a href='singleRestaurant.php?rid=$row[0]&rname=$row[1]&uid=$uid_in&uname=$uname_in'>".$row[3]."</a></td>";
                $oid = $row[0];
                $oname = $row[1];
                $uname = $row[2];
             //echo "</tr>\n";
             }
         }

          echo "<div class='border rounded' style='padding:5px'>";
             if (!$_GET["aid"]) {
                 echo "<h2>Your Account</h2>";
             }
             else {
                echo "<h2>$uname's Account</h2>";
             }
         echo "</br>";
         echo "<h6>Username: $uname</h6>";
          if ($sname) {
             echo "<h6>Student Name: $sname</h6>";
          }
          if ($oname) {
             echo "<h6>Owner Name: $oname</h6>";
          }
          if($sid) {
             echo "<h6>Student ID: $sid</h6>";
          }
          if ($oid) {
             echo "<h6>Owner ID: $oid</h6>";
          }
          echo "</div></div></br>";
          echo "<div class='col-lg-5'><br>";

           ?>


       <?php
          if ($sid) {
            include "studentReviews.php";
          }

          if ($oid) {
            echo "<h4>Your Restaurants:</h4>";
            include "ownerRestaurants.php";
            mysqli_close($conn);
            echo "<button class='btn btn-secondary'><a style='color:white;' href='addRestaurant.php?rid=$rid&uid=$uid_in&uname=$uname_in'>Add Restaurant<a></button>";
          }

          mysqli_free_result($owner);
          mysqli_free_result($student);
       ?>
       </div>
       </div>
       </div>
    </body>
</html>
                                                                                                          