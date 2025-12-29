<?php 
require('conn.php');

try{
    if(!isset($_GET['id'])){
        throw new Exception("missing product id");
    }

  $id = $_GET['id'];

  $sql = " DELETE FROM storeproduct WHERE spid = :id ";
  $stmt = $conn->prepare($sql);
   $stmt->execute([':id' => $id]);
 header("Location:prstlist.php");
  exit();
}  catch (Exception $e){
    echo "Delete failed:" . $e->getMessage();
}
?>