<!DOCTYPE html>
<html>

<?php include 'db_connection.php'; ?>

<body>

  <?php

  // open database
  $con = OpenCon();
  if (!$con) {
    echo "Something went wrong opening the MySQL Database";
  } else {
    // echo "success";
  }

  // setup arrays
  $userNameList = array();
  $productNameList = array();
  $userIdList = array();
  $productIdList = array(); // id list is used for unique product identification, in the case that the name was changed for some reason
  // get all users
  $sql = "SELECT id, name FROM Users";
  $result = $con->query($sql);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      array_push($userNameList, $row["name"]);
      array_push($userIdList, $row["id"]);
    }
  } else {
    echo "0 results";
  }

  // get product list
  $sql = "SELECT id, name FROM Consumables";
  $result = $con->query($sql);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      array_push($productNameList, $row["name"]);
      array_push($productIdList, $row["id"]);
    }
  } else {
    echo "0 results";
  }


  // ---------------------------------
  // here starts the actual table!
  // ---------------------------------

  echo "<table class=UserDataTable>";

  // first row
  echo "
  <tr> 
    <th> Name </th> ";

  for ($i = 0; $i < count($productNameList); $i++) {
    echo "<th>" . $productNameList[$i] . " [#] </th>";
  }
  echo "
    <th> Overall [€]  </th>
  </tr>";

  // starting second row and all other user rows

  // row loop
  for ($i = 0; $i < count($userNameList); $i++) {
    echo "<tr>";

    // first column -> user name
    echo "<th>" . $userNameList[$i] . "</th>";

    // now we iterate over the product history and generate the user consumption
    // -------> specific item consumption list here

    for ($productCnt = 0; $productCnt < count($productIdList); $productCnt++) {

      $currProductId = $productIdList[$productCnt];

      echo "<th>";

      $sql = "SELECT COUNT(*) FROM ConsumptionHistory WHERE consumer_id = " . $userIdList[$i] . " AND product_id = " . $currProductId  . " ;";
      $result = $con->query($sql);
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo round($row["COUNT(*)"], 2);
        }
      } else {
        echo "0 results";
      }

      echo "</th>";
    }




    // Overall price from all user consuptions per user/row
    echo "<th>";
    $sql = "SELECT SUM(price) FROM ConsumptionHistory WHERE consumer_id = " . $userIdList[$i] . ";";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo round($row["SUM(price)"], 2);
      }
    } else {
      echo "0 results";
    }

    echo "</th>";

    // NEXT STEP HERE

    echo "</tr>";
  }

  echo "</table>";

  CloseCon($con);



  ?>
</body>

</html>