<div>
   <h4>Reviews:</h4>
     <?php
     // query to select all information from supplier table
        $query = "SELECT Restaurant.restaurant_ID, Restaurant.restaurant_name AS 'Restaurant', Review.rating AS 'Rating', Review.description AS 'Description', Item.item_name AS 'Item', Item.item_ID, date_added AS 'Date', review_ID as 'Delete' FROM Review INNER JOIN Item on Review.item_ID = Item.item_ID INNER JOIN Restaurant ON Restaurant.restaurant_ID = Review.restaurant_ID NATURAL JOIN Student WHERE Student.Account_ID = $aid";
     // Get results from query
        $result = mysqli_query($conn, $query);
        if (!$result) {
           die("Query to show fields from table failed");
        }
        $aid = $_GET['aid'];
     // get number of columns in table
        $fields_num = mysqli_num_fields($result);
        echo "<table class='table table-bordered table-hover table-condensed' id='t01' border='1'><tr>";

     // printing table headers
        for($i=0; $i<$fields_num; $i++) {
           $field = mysqli_fetch_field($result);
           if($field->name != "restaurant_ID" && $field->name != "item_ID" && $field->name != "Delete"){
               echo "<td><b>$field->name</b></td>";
           }
        }
        echo "</tr>\n";
        while($row = mysqli_fetch_row($result)) {
           echo "<tr>";
           echo "<td>$cell<a href='singleRestaurant.php?rid=$row[0]&uid=$uid_in&uname=$uname_in'>$row[1]</a></td>";
           echo "<td>$cell<a>$row[2]</a></td>";
           echo "<td>$cell<a>$row[3]</a></td>";
           echo "<td>$cell<a href='item.php?itemid=$row[5]&uid=$uid_in&uname=$uname_in'>$row[4]</a></td>";
           echo "<td>$cell<a>$row[6]</a></td>";
           if (!$aid) {
            echo "<td><a href = 'delete.php?review_id=$row[7]&uid=$uid_in&uname=$uname_in&rid=$row[0]'</a>Delete Review</td>";
           }
            echo "</tr>\n";
        }
        echo "</table>";

        mysqli_free_result($result);
     ?>
                                                                                                                                                                                                                                                            