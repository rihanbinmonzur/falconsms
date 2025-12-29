<?php 
$serna = "localhost";
$usernam = "root";
$pass ="";
$dbn = "falcon";
try {
    $conn = new PDO("mysql:host=$serna;dbname=$dbn", $usernam, $pass );

    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
   
} catch(PDOException $e){
    echo "Connection failed: " .$e->getMessage();
}
?>