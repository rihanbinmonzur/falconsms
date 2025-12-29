<?php 
require('conn.php');
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
    if(isset($_GET['stproductname'])){
        try{
            $spn    = $_GET['stproductname'];
            $spq    = $_GET['stproductquentity'];
            $sped   = $_GET['stprda'];

            $sql = " insert into storeproduct (stproductname,stproductquentity,stprda) VALUES ('$spn','$spq','$sped') ";

            $conn->exec($sql);
            echo "new recorded created successfully";
        } catch (PDOException $e){
            echo $sql . "<br>" . $e->getMessage();
        }
        header("Location:prstlist.php");
    }
    ?>
    <?php 
        $sql1  = "SELECT * FROM product";
        $query  =$conn->query($sql1);
    ?>

        <h1>add store product name</h1>
        <form action="prstcreate.php" method="GET">
            <label for="">product name:</label>
            <select name="stproductname" id="">
                echo " <option value=''>select product</option> ";
                <?php 
                    while ($data = $query->fetch(PDO::FETCH_ASSOC)){
                        $prid = $data['product_id'];
                        $prna  = $data['product_name'];
                        echo "<option value='$prid'>$prna</option>" ;
                    }
                ?>
            </select> <br><br>
            <label for="">
                store product quantity:
                <input type="number" name="stproductquentity"><br>
            </label>
            <label for="">product entry date :
                <input type="date" name="stprda"><br>
            </label>
                <input type="submit" value="ADD">
        </form>
</body>
</html>