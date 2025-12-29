<?php 
require ('conn.php');

$sql1 = "SELECT * FROM category ";

$query1 = $conn->query($sql1);

$datalist = array();

while ($data1 = $query1->fetch(PDO::FETCH_ASSOC)){
        $caid = $data1['id'];
        $cana = $data1['category_name'];
        $datalist[$caid] = $cana;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product list</title>
</head>
<body>
    <?php 
    $sql = "SELECT * FROM product ";
    $query = $conn->query($sql); //this command send to server.


    echo "<a href='addproduct.php'>add product</a>";
   echo "<h3> product list:</h3>";
    echo "<table border='1' cellspacing='0'> <tr><th>id</th><th>SL</th><th>product name</th><th>product category</th><th>product code</th><th>product entry date </th><th>Action</th></tr>";

    $sl = 1;

    while($data = $query->fetch(PDO::FETCH_ASSOC)){
        $prid = $data['product_id'];
        $prna = $data['product_name'];
        $prca = $data['product_category'];
        $prco = $data['product_code'];
        $prda = $data['product_entry_date'];
           
           $procate = $datalist[$prca] ?? "unknown" ; 
    
        echo "<tr><td>$prid</td><td>$sl</td><td>$prna</td><td> $procate  </td><td>$prco</td><td>$prda</td><td><a href='editproduct.php?id=$prid' <!-- ? this tell querry string. This is the way to send data through  the URL -->EDIT</a>|<a href='deleteproduct.php?id=$prid' onclick='return confirm(\"are you sure ?\")'>DELETE</a>  </td></tr>";
        $sl++;  
    }
    //<!-- $datalist[$prca] to show category name -->
    echo "</table>";
    ?>
    <!-- ?? is called the Null Coalescing Operator.“If the left value exists and is not NULL, use it. Otherwise use the right value.” -->
</body>
</html>