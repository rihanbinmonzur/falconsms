<?php 
require('conn.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>list of user</title>
</head>
<body>
    <?php 
    $sql = "SELECT * FROM users";
    $query = $conn->query($sql);
     echo "<table border='1'><tr><th>S/L</th><th>First name</th> <th>last name</th> <th>email</th><th>act</th> <th>action</th> </tr> "; 

     $sl= 1;

     while($data=$query->fetch(PDO::FETCH_ASSOC)){
        $usid = $data['userid'];
        $usfn =$data['userfirstname'];
        $usln =$data['userlastname'];
        $usem =$data['useremail'];
        $usp =$data['userpassword'];

         echo"<tr><td>$sl</td><td>$usfn</td><td>$usln</td><td> $usem</td><td>$usp</td> <td><a href='edituser.php?id=$usid'>EDIt</a></td></tr>"; 
         $sl++;
     }
     echo "</table>";
     
    
        ?>
</body>
</html>
