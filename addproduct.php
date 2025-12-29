<?php 
 require('conn.php');
 session_start();
 $ufn = $_SESSION['userfirstname'];
 $uln = $_SESSION['userlastname'];
  if(!empty($ufn) && !empty($uln)){

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> add Product</title>
</head>
<body>
    <?php 
    if(isset($_GET['product_name'])){
        try{
            $product_name = $_GET['product_name'];
            $prca = $_GET['product_category'];
            $prco = $_GET['product_code'];
            $prenda = $_GET['product_entry_date'];

            $sql = "insert into product (product_name,product_category,product_code,product_entry_date) VALUES ('$product_name','$prca','$prco','$prenda') ";

            $conn->exec($sql);
             echo "new recorded created successfully";
        } catch (PDOException $e ){
            echo $sql . "br" . $e-> getMessage();
        }
        header("Location:productlist.php");
        //  $conn = null;
    }
    ?>
    <?php 
        $sql = "SELECT * FROM category";
        
        $query = $conn->query($sql);
    ?>

    <h1>Add Product</h1>
    <form action="addproduct.php" method="GET">
    <label for="prna">product name:</label>
    <input type="text" name="product_name" id="prna"><br> <br>
    <label for="prca">product category:</label>
    <select name="product_category" id="">
         echo "<option value=''>  select product</option> ";
        <?php 
               while  ($data = $query->fetch(PDO::FETCH_ASSOC)){
                    $caid = $data['id'];
                    $cana = $data['category_name'];
                    echo  "<option value='$caid'> $cana  </option>" ;
               }
        ?>
       
    </select> <br> <br>
    <label for="prco">product code:</label>
    <input type="number" name="product_code" id="prco"> <br> <br>
    <label for="prda">product entry date:</label>
    <input type="date" name="product_entry_date" id="prda" ><br><br>
    <input type="submit" value="ADD">
    </form>
</body>
</html>
<?php 
  }else{
    header('location:login.php');
  }
?>