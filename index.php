<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="style.css">
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous"> -->
  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script> -->
</head>


<body>

  <div class="header">
    <div class="headerLogoContainer" id="bottom">
      <img src="images/hsa_logo.png" height="100%" alt="">
    </div>
  </div>

  <div class="maincontainer">
    <form action="index.php" method="post">
      <div class="formContainer">   
        <div class="formContainerLeft" id="leftTable">
          <table class="InputDataTable">
            <tr><th><input type="radio" name="Name" value="Julian"></th><th>Julian</th></tr>
            <tr><th><input type="radio" name="Name" value="Mathias"></th><th>Mathias</th></tr>
            <tr><th><input type="radio" name="Name" value="Armin"></th><th>Armin</th></tr>
            <tr><th><input type="radio" name="Name" value="Stephan"></th><th>Stephan</th></tr>
            <tr><th><input type="radio" name="Name" value="Robert"></th><th>Robert</th></tr>
          </table>
        </div>

        <div class="formContainerRight" id="rightTable">
          <table class="InputDataTable">
            <tr>
              <th><input type="radio" name="Produkt" value="Kaffee"><th>Kaffee</th></th>
              <th><input type="radio" name="Produkt" value="Bier"><th>Bier</th></th>
              <th><input type="radio" name="Produkt" value="VitaQuelle"><th>VitaQuelle</th></th>
            </tr>
            <tr>
              <th><input type="radio" name="Produkt" value="AdelHolz"><th>AdelHolz</th></th>
              <th><input type="radio" name="Produkt" value="Cider"><th>Cider</th></th>
              <th><input type="radio" name="Produkt" value="Ale"><th>Ale</th></th>
            </tr>
            <tr>
              <th><input type="radio" name="Produkt" value="KaffeeDoppelt"><th>KaffeeDoppelt</th></th>
            </tr>
          </table> 
        </div>
        <div class="buttoncontainer">
          <table class="InputDataTable">
            <tr>
              <th><input class="sendButton" type="submit" value="Drink!"></th>
            </tr>  
          </table> 
        </div>
      </div>
    </form>
  </div>
  
  <br><br><br>




  <!-- php scripts -->
  <?php
  if (isset($_POST["Name"])&&isset($_POST["Produkt"])){
    $name = $_POST["Name"];
    $produkt = $_POST["Produkt"];

    header("Location:index.php");

    // echo "<br>$name trinkt $produkt<br>";

    saveToCsv($name, $produkt);

  } elseif (isset($_POST["Name"]) || !isset($_POST["Produkt"])){
    // echo "Produktname fehlt!";
  } elseif (!isset($_POST["Name"]) || isset($_POST["Produkt"])){
    // echo "User fehlt!";
  } else {
    echo "Please enter Name and Produkt ";
  }    
  ?>


  <?php

    function saveToCsv($name, $produkt){      
      echo "<br><br>";
      $myfile = "C:\\xampp\\htdocs\\coffice\\user_data.csv";
      $fin = fopen($myfile, "r");
      $data = array();
      $data[] = fgetcsv($fin, 1000);

      // increase data logic
      while ($line = fgetcsv($fin, 1000)) {
        for($i = 1, $k = count($line); $i < $k; $i++) {
          if ($line[$i] == $produkt && $line[0]==$name) {
            $line[$i+1]++; // increase product count by 1
          }
        }
        $data[] = $line;
      }
      fclose($fin);
      //write to csv file
      $fout = fopen($myfile, 'w');
      foreach ($data as $line) {
        fputcsv($fout, $line);
      }
      fclose($fout);

    }

    function displayTable(){

      $price_coffee = 0.25;
      $price_beer = 1.0;
      $price_adelholz = 0.6;
      $price_coffee_double = 0.5;
      $price_cider = 1.6;
      $price_ale = 2.0;
      $price_vita = 0.4;

      $myfile = "C:\\xampp\\htdocs\\coffice\\user_data.csv";
      $fin = fopen($myfile, "r");
      $data = array();
      $data[] = fgetcsv($fin, 1000);
      while ($line = fgetcsv($fin, 1000)) {
        $data[] = $line;
      }

      //display data
      echo "<div class=\"UserData\">";
      echo "<table class=\"UserDataTable\">";

      echo "
        <tr> 
          <th> Name </th> 
          <th> Kaffee </th> 
          <th> Bier </th> 
          <th> VitaQu. </th> 
          <th> AdelHo. </th> 
          <th> Cider </th> 
          <th> Ale </th> 
          <th> KaffeeDoppelt </th> 
          <th> Gesamt  </th>
        </tr>";

      $iter = 0;
      foreach ($data as $line){
        $iter++;
        if ($iter == 1) continue;
        $temp_price = 
          $line[2]* $price_coffee 
          +$line[4]* $price_beer 
          +$line[6]* $price_vita
          +$line[8]*$price_adelholz
          +$line[10]*$price_cider
          +$line[12]*$price_ale
          +$line[14]*$price_coffee_double
          +$line[16];
        echo "
        <tr> 
          <th>$line[0]</th> 
          <th>$line[2]</th> 
          <th>$line[4]</th> 
          <th>$line[6]</th> 
          <th>$line[8]</th>  
          <th>$line[10]</th>  
          <th>$line[12]</th>  
          <th>$line[14]</th>  
          <th>$temp_price €</th> 
        </tr>";
      }

      echo "</table>";
      echo "</div>";
    }




  ?>
  

  <div class="tableContainer">
    <?php
      displayTable();
    ?>
  </div>



</body>
</html>