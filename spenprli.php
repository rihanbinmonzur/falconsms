<?php 
require('conn.php');

  $sql1 = "SELECT * FROM product";
   $query1 = $conn->query($sql1);
  $datalist = array();

  while($data1 = $query1->fetch(PDO::FETCH_ASSOC)){
     $prid = $data1['product_id'];
     $prna = $data1['product_name'];

    $datalist[$prid] = $prna;
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
      $sql = "SELECT * FROM spendproduct ";
      $query = $conn->query($sql);

      echo "<a href='spenprcr.php'> add spend product</a>" ;
       echo "<h3> product list :</h3>";
     echo"<table border='1'> <tr><th>id </th><th>s/L</th><th>product name</th><th> spend product qunatity</th><th>spend product date</th></tr>";
        
        $sl=1;

        while($data = $query->fetch(PDO::FETCH_ASSOC)){
            $spri = $data['spproid'];
            $spna   = $data['spprona'];
            $spq     = $data['spprqu'];
            $spda    = $data['spprenda'];

            $prna  = $datalist[$spna] ?? "unknown" ;
              echo "<tr><td>$spri</td><td>$sl</td><td>$prna</td><td>$spq</td><td>$spda</td></tr>";

            $sl++;
        }
     
     echo"</table>" 
    ?>
</body>
</html>