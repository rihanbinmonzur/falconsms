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
      if(isset($_GET['id'])){   //$_GET takes data to url.this id form edit button 
          $getid  = $_GET['id'];

          $sql = "SELECT * FROM storeproduct WHERE spid= $getid "; // storeproduct” table থেকে সেই row আনো যার spid = $getid
         $query = $conn->query($sql);
         $data = $query->fetch(PDO::FETCH_ASSOC);

           $sspid = $data['spid'];
           $sspn  = $data['stproductname'];
           $sstpq = $data['stproductquentity'];
           $ssped = $data['stprda'];
       } 
  ?>
          <?php 
           if(isset($_POST['stproductname'])){
              $uspn = $_POST['stproductname'];
              $uspq = $_POST['stproductquentity'];
              $uspda = $_POST['stprda'];
              $upspid = $_POST['spid']; //its connect with hidden button
              
              $sql2 = "UPDATE storeproduct SET stproductname = :spn,stproductquentity = :spq, stprda=:spd WHERE spid =:id ";
              /* bindParam() হলো PDO-তে prepared statement-এ value bind করার একটি function।এটি SQL Injectionথেকেবাঁচায় এবং ডাটাবেসে নিরাপদে value পাঠায়।bindParam() SQL query-র placeholder (:name, :id) এর সাথে PHP variable যুক্ত করে। */
                $sql3 = $conn->prepare($sql2);
                  $sql3->bindParam(':spn',$uspn);  
                  $sql3->bindParam(':spq',$uspq);
                  $sql3->bindParam(':spd',$uspda);
                  $sql3->bindParam(':id',$upspid);

              try {
                  $sql3->execute();
                  header("Location:prstlist.php");
                  exit();
                  echo $sql3->rowCount() . " records updated successfully " ; 
              } catch (PDOException $e){
                echo $sql . "<br>" .$e ->getMessage();
              }
           }
          ?>

             <?php
              $sql1 = " SELECT * FROM product ";
              $quer = $conn->query($sql1);
             ?>
             
   <h1>Edit store product </h1>
       <form action="prstedit.php" method="POST">0p0/
          <label for="">product name:</label>
              <select name="stproductname" id="">
                  <?php 
                    echo "<option value=''>select product</option>";              
                      while ($data = $quer->fetch(PDO::FETCH_ASSOC)){
                        $prid = $data['product_id'];
                        $prna = $data['product_name'];
                  ?>
                        <option value="<?php echo $prid ?>" <?php if ($prid == $sspn) echo'selected' ; ?>> <?php echo $prna ?> </option>
                  <?php } ?> 
              </select>
              <br><br>
              <label for="prco"> store product quantity:
                <input type="number" name="stproductquentity" value="<?php echo $sstpq ?>"><br><br>
              </label>
                <label for="">product entry date :
                  <input type="date" name="stprda" value='<?php echo  $ssped ?>' ><br><br>
              </label>
              <input type="hidden" name="spid" value="<?php echo $sspid ?> " >
                  <input type="submit" value="updated">
         </form>
</body>
</html>