<?php 
    require('conn.php');

    $sql1 =  " SELECT * FROM product ";

    $query1 = $conn->query($sql1);
    $datalist = array();
 
    while($data1 = $query1->fetch(PDO::FETCH_ASSOC)){
        $prid = $data1['product_id'];
        $prna  =$data1['product_name'];
        
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
      $sql = " SELECT * FROM storeproduct ";
        $query = $conn->query($sql);
        
        echo "<a href='prstcreate.php'>ADD PRODUCT</a>";
        echo "<h3>PRODUCT list :</h3>";
      echo "<table border='1'><tr><th>ID</th><th>SL</th><th>store Product Name           </th><th>store product Quantity</th><th>store product entry date</th><th>Action</  th></tr>";

            $sl = 1;
            while($data = $query->fetch(PDO::FETCH_ASSOC)){
                    $spi  = $data['spid'];
                    $spn  = $data['stproductname'];
                    $spq  = $data['stproductquentity'];
                    $sped = $data['stprda'];

                    $prna = $datalist[$spn] ?? "unknown" ;

                    echo "<tr><td>$spi</td><td>$sl</td><td>$prna</td><td>$spq</td><td>$sped</td><td> <a href='prstedit.php?id=$spi'>EDIt</a> |  <a href='deletepstli.php?id=$spi' onclick='return confirm(\" are you sure ? \")'>DELETE</a> </td></tr>";
                    $sl++; 
                }  

       echo "</table>";
    
    ?>
</body>
</html>