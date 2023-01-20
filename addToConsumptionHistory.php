<!DOCTYPE html>
<html>

<?php include 'db_connection.php'; ?>

<body>

    <?php

    $con = OpenCon();
    if (!$con) {
        echo "Something went wrong opening the MySQL Database";
    } else {
        echo "success";
    }

    $userName = $_GET['userName']; // name of the user that buys something
    $userProduct = $_GET['userProduct']; // name of the product that is being bought

    // setup input variables
    $consumer_id = -1;
    $product_name = "blank";
    $price = -1;
    $date_time = "2020-01-01 12:01:01";
    $product_id = -1;
    $consumer_name = $userName; // duplicate, but nvm.

    // get userId by userName
    $sql = "SELECT id FROM Users WHERE name='" . $userName . "';";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            //   echo "id of user: " . $row["id"];
            $consumer_id = $row["id"];
        }
    } else {
        echo "0 results"; // should not happen!
    }

    // get product info by productName
    $sql = "SELECT id,name,price FROM Consumables WHERE name='" . $userProduct . "';";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            //   echo "id of user: " . $row["id"];
            $product_id = $row["id"];
            $product_name = $row["name"];
            $price = $row["price"];
        }
    } else {
        echo "0 results"; // should not happen!
    }


    $sql = "INSERT INTO ConsumptionHistory (consumer_id,product_name,price,date_time,product_id,consumer_name) 
        VALUES (" . $consumer_id . ",'" . $product_name . "'," . $price . ",'" . $date_time . "'," . $product_id . ",'" . $consumer_name . "');";
    $result = $con->query($sql);



    CloseCon($con);



    ?>
</body>

</html>