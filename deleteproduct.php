<?php 
require('conn.php');

try {
   if (!isset($_GET['id'])){
      throw new Exception("missing product id"); // throw= stop code nE = create error object with message
   }

   $id = $_GET['id'];

   $sql   = "DELETE FROM product WHERE product_id = :id ";
   $stmt  = $conn->prepare($sql);
     $stmt->execute([':id' => $id]);
     
     header("Location:productlist.php"); //used to send a raw HTTP header.PHP-এর header() ফাংশন HTTP হেডার পাঠানোর জন্য ব্যবহার করা হয়। এটি পেজ লোড হওয়ার আগে কাজ করে
     exit;
   
} catch (Exception $e){
   echo "Delete failed: " . $e->getMessage();
}

?>