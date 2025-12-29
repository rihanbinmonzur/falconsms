<?php
require('conn.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store product create</title>
</head>
<body>
    <?php 
    if(isset($_GET['stproductname'])){
        try{
            $spprona = $_GET['stproductname'];
            $spprqu  = $_GET['stproductquentity'];
            $spprenda = $_GET['stprda'];

          $sql = " insert into spendproduct (spprona,spprqu,spprenda) VALUES ('$spprona','$spprqu','$spprenda')";

            $conn->exec($sql);
            echo "new recoded created successfully";
        } catch (PDOException $e){
            echo $sql . "<br>" . $e->getMessage(); 
        }
        header("Location:spenprli.php");
    }
    ?>
    <?php
      $sql1= "SELECT * FROM product";
      $query = $conn->query($sql1);
    ?>
      
      <h1> spend product </h1>
        <form action="spenprcr.php" method="GET">
            <label for="">product name</label>
             <select name="stproductname" id="">
               <option value="">select product</option>
                <?php
                  while ($data =$query->fetch(PDO::FETCH_ASSOC)){
                    $prid = $data['product_id'];
                    $prna  = $data['product_name'];
                    echo "<option value='$prid'>$prna </option>";
                 }
                ?>
             </select> <br><br>
             <label for="">
              spend product quantity:
              <input type="number" name="stproductquentity">
             </label> <br> <br>
            <label for="">
            product entry date:
            <input type="date" name="stprda"> <br>
            </label>
          <input type="submit" value="ADD">    
        </form>
</body>
</html>