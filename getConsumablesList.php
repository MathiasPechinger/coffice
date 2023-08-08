<!DOCTYPE html>
<html>

<?php include 'db_connection.php'; ?>

<body>

    <?php

    $con = OpenCon();
    if (!$con) {
        echo "Something went wrong opening the MySQL Database";
    } else {
        // echo "success";
    }

    $sql = "SELECT id, name, price FROM Consumables";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
      // output data of each row
      while ($row = $result->fetch_assoc()) {
        $columnIter = $columnIter + 1;
        echo "<tr><th><input type='radio' name='product' value=" . $row["name"] . ">
                              <th>" . $row["name"] . " (" . $row["price"] . "€)</th></th></tr>";
      }
    } else {
      echo "0 results";
    }

    CloseCon($con);



    ?>
</body>

</html>