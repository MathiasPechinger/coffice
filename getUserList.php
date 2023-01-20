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

    $sql = "SELECT id, name FROM Users";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
      // output data of each row
      while ($row = $result->fetch_assoc()) {
        echo "
          <tr>
              <th><input type='radio' name='usrName' value=" . $row["name"] . "></th>
              <th>" . $row["name"] . "</th>
          </tr>
          ";
      }
    } else {
      echo "0 results";
    }

    CloseCon($con);



    ?>
</body>

</html>