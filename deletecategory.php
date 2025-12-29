<?php 
require('conn.php');
if (isset($_GET['id'])){
    $id = $_GET['id'];

    $sql = "DELETE FROM category where id = :id";
     $stmt = $conn->prepare($sql);
     $stmt->bindParam(':id',$id);

     if($stmt->execute()){
        header("Location:category_list.php");
        exit;
     } else {
        $error = $stmt->errorInfo();
        echo "Delete failed: " . $error[2];
     }
}

?>