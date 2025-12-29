<?php 
    require('conn.php');
    session_start();
    $ufn  =  $_SESSION['userfirstname'];
    $uln  = $_SESSION['userlastname'];

    if(!empty($ufn) && !empty($uln)){

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="icon"  href="favicon.ico">
    <title>felcon/Edit_category</title>
  
</head>
<body>
 <?php  
        if (isset($_GET['id'])){
        $getid = $_GET['id'];

        $sql = "SELECT * FROM category WHERE id=$getid";

        $query = $conn->query($sql);

        $data = $query->fetch(PDO::FETCH_ASSOC);

        $caid = $data['id'];
        $cana  = $data['category_name'];
        $caen  = $data['categoryentry_date']; 
            
    }   
        
        if (isset($_GET['category_name'])){
                    $necaid  = $_GET['caid'];
                     $necana   = $_GET['category_name'];
                     $necada   = $_GET['categoryentry_date'];

            $sql1 = "UPDATE category SET category_name= :name,categoryentry_date = :entrydate WHERE id= :id ";

               $stmt1 = $conn->prepare($sql1);
                $stmt1->bindParam(':name',$necana);
                $stmt1->bindParam(':entrydate',$necada);
                $stmt1->bindParam(':id',$necaid);

                try {
                    $stmt1->execute();
                    header("Location:category_list.php");
                    exit();
                echo $stmt1->rowCount() . "records updateed successfully";
                    } catch(PDOException $e){
                        echo $sql1 . "<br>" . $e->getMessage();
                    }
  
        }
        $conn= null;
       
    ?> 
    <h1>create category</h1>
    <form action="editcategory.php?id=<?php echo $caid; ?>" method="GET">
        <label for="category">category nameee:</label>
        <input type="text" id="category" name="category_name" value="<?php echo $cana ?>" ><br> <br>
        <label for="categorydate">category entry date:</label>
        <input type="date" id="categorydate" name="categoryentry_date" value="<?php echo $caen  ?>"  > <br>
        <input type="hidden" name="caid"  value="<?php echo $caid ?>">
        <input type="submit" value="update">
    </form>
    <a href="category_list.php">list category page</a>
</body>
</html>
  <?php
    }else{
       header('location:login.php');
    }
  ?>