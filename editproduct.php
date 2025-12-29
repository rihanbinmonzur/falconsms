<?php 
    require('conn.php');

    session_start();    
    $ufn  = $_SESSION['userfirstname'];
    $uln   =$_SESSION['userlastname'];

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
    if(isset($_GET['id'])){

        $getid = $_GET['id'];

        $sql = "SELECT * FROM product WHERE product_id= $getid";// product” table থেকে সেই row আনো যার product_id = $getid

        $query = $conn->query($sql);
        $data = $query->fetch(PDO::FETCH_ASSOC);

        $prid  = $data['product_id'];
        $prna  = $data['product_name'];
        $prca  = $data['product_category'];
        $prco    = $data['product_code'];
        $prend     = $data['product_entry_date'];
    }

    ?>
    <?php  
     if(isset($_GET['product_name'])){
        $tprna   = $_GET['product_name'];
        $tprca   = $_GET['product_category'];
        $tprco   = $_GET['product_code'];
        $tprda   = $_GET['product_entry_date'];
        $tprid   = $_GET['product_id']; 
        
        $sql2 = "UPDATE product set product_name ='$tprna',
                    product_category =  '$tprca', product_code = '$tprco', 
                    product_entry_date = '$tprda' WHERE product_id = $tprid";
             
           if( $conn->query($sql2)  == TRUE ){
                    echo "update successfully";
           }else{
            echo "ERROR updating" . $conn->error;
           }
        header("Location:productlist.php");
        }
    ?>
        <?php
        $sqlcat = " SELECT * FROM category ";
        $querycat = $conn->query($sqlcat);
    
    ?>

    <h1>EDit Product</h1>
    <form action="editproduct.php" method="get">
    <label for="prna">product name:</label>
    <input type="text" name="product_name" id="prna" value="<?php echo $prna ?>"><br> <br>
    <label for="prca">product category:</label>
    <select name="product_category" >
        <?php 
          echo "<option value=''>  select category</option> "; 
                     while  ($data = $querycat->fetch(PDO::FETCH_ASSOC)){
                $caid = $data['id'];
                $cana = $data['category_name']; 
                ?>
              <option value="<?php echo $caid ?>" <?php if ($caid == $prca)  echo 'selected'  ; ?>>  <?php echo $cana ?> </option>
            <?php } ?>   
    </select>
     <br> <br>
    <label for="prco">product code:</label>
    <input type="text" name="product_code" id="prco" value="<?php echo $prco ?>" > <br> <br>
    <label for="prda">product entry date:</label>
    <input type="date" name="product_entry_date" id="prda"value="<?php echo $prend ?>" ><br><br>
    <input type="hidden" name="product_id"  value="<?php echo $prid ?>" >
    <input type="submit" value="UPDATED">
    </form>
</body>
</html>