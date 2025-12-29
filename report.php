<?php 
   require('conn.php');
   
   session_start();
     
   $ufn = $_SESSION['userfirstname'];
   $uln  = $_SESSION['userlastname'];
    
   if(!empty($ufn) && !empty($uln)){
    
      $sql1 = "SELECT * FROM product";
        $query1 = $conn->query($sql1);
        $datalist = array(); // its used for show $spn name
       
      while ($data1 = $query1->fetch(PDO::FETCH_ASSOC)){
              $prid = $data1['product_id'];
                $prna = $data1['product_name'];
      
          $datalist[$prid] =  $prna;  // its used for array()
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
             <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET" >
               select  product name :
                        <select name="pronam" id="">
                           <?php  
                             $sql1 = "SELECT * FROM product";
                              $query1 = $conn->query($sql1);
                              while($data = $query1->fetch(PDO::FETCH_ASSOC)){
                                    $prid  = $data['product_id'];
                                    $prna   = $data['product_name'];
                                    ?>

                              <option value="<?php echo $prid ?>"><?php echo $prna ?></option>
                              <?php } ?>
                        </select>
               <input type="submit" value="generate report">
        </form>

        <h1>store product</h1>
          <?php
            // Report store product data show
            
            if(isset($_GET['pronam'])){
               $pronam = $_GET['pronam'];
                 $sql2 = "SELECT * FROM storeproduct WHERE stproductname = '$pronam' ";
                 $query2=$conn->query($sql2);
                 
                 while ($data2 = $query2->fetch(PDO::FETCH_ASSOC)){
                   $sped = $data2['stprda'];
                    $spn  = $data2['stproductname'];
                    $spq = $data2['stproductquentity'];
                     
                    echo "<h2>  $datalist[$spn]</h2>" ;
                   echo "<table border='1'> <tr><td>store date </td> <td>amount</td><tr>";
                     echo "<tr><td> $sped</td><td> $spq</td></tr> ";
                   echo "</table>";
                 }  
            }
            ?>

            <h1> spend product show </h1>
            <?php 
              // spend product show 
               if(isset($_GET['pronam'])){
                $pronam  = $_GET['pronam']; 
                $sql4 = "SELECT * FROM spendproduct where spprona = '$pronam' ";
                 $query4 = $conn->query($sql4);
                  
                 while($data4= $query4->fetch(PDO::FETCH_ASSOC)){
                  $spn = $data4['spprona'];
                  $spq = $data4['spprqu'];
                  $spd = $data4['spprenda'];

                  echo "<h2>$datalist[$spn]</h2>";
                   echo "<table border='1'> <tr><th>spendd date</th><th>spendd product quantity</th></tr>";
                   echo "<tr><td>$spd</td><td>$spq</td></tr>";
                   echo "</table>" ;
                 }
               }
               ?>
         </body>
         </html>
    <?php
    }else{
      header('location:login.php');
   } 
   ?> 
