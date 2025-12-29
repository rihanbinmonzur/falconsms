<?php 
require('conn.php');
session_start();
 $usfina = $_SESSION['userfirstname'];
 $uslina  =$_SESSION['userlastname'];

 if(!empty($usfina)  && !empty($uslina)){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="icon"  href="favicon.ico">
    <title>felcon/add_category</title>
  
</head>
<body>
 <?php  
        if (isset($_GET['category_name'])){
        try{

            $category_name = $_GET['category_name'];
            $category_date = $_GET['categoryentry_date'];
        $sql = "insert into category (category_name, categoryentry_date) VALUES ('$category_name', '$category_date')";

        $conn->exec($sql);
        echo "new recorded created successfully";
    } catch (PDOException $e ){
        echo $sql . "br" . $e->getMessage();
    }
     
    $conn = null;
}
    ?> 
    <h1>create category</h1>
    <form action="add_category.php">
        <label for="category">category nameee:</label>
        <input type="text" id="category" name="category_name"><br> <br>
        <label for="categorydate">category entry date:</label>
        <input type="date" id="categorydate" name="categoryentry_date"> <br>
        <input type="submit" value="please submit">
    </form>
    <p><a href="category_list.php">show category list</a></p>
</body>
</html>
<?php  
}else{
    header('location:login.php');
}
?>