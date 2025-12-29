<?php 
require('conn.php');

session_start();

$ufn = $_SESSION['userfirstname'];
$uln = $_SESSION['userlastname'];

if(!empty($ufn)  && !empty($uln)){

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>list of category</title>
</head>
<body>
   <?php 
    $sql = " SELECT * FROM category ";
    
    $query = $conn->query($sql); //this command send to database

    echo "<table border='1' cellspacing='0'> <tr><th>id</th><th>SL</th> <th>Category</th><th>Date</th><th>Action</th></tr>"; // variable parse no  in single quote and double quote yes

    $sl = 1;

    while ($data = $query->fetch(PDO::FETCH_ASSOC)){
     $cateid = $data['id'];   
    $cana = $data['category_name']; 
    $cada = $data['categoryentry_date'];

   echo "<tr><td>$cateid</td><td>$sl</td><td> $cana </td><td> $cada</td><td>  <a href='editcategory.php?id=$cateid'> Edit </a> | <a href='deletecategory.php?id=$cateid'>Delete</a> </td></tr>";

   $sl++;
}
echo "</table>";
   ?> 
</body>
</html>
<?php
    }else{
   header('location:login.php');
    }
>?