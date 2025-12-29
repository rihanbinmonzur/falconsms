<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
        <?php 
          require('conn.php');
          session_start();
        ?>
          <?php 

            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                $usem  = trim($_POST['usem']);
                $uspa  = trim($_POST['uspas']);
                 
                if (empty($usem) || empty($uspa)){
                  echo "email and password দিতে mandatory";
                  exit(); 
                }
                
                $sql = "SELECT * FROM users WHERE  useremail='$usem'  "; //is only a string
                
              $query = $conn->query($sql);

              $data =$query->fetch(PDO::FETCH_ASSOC);
                   
                    $usfina = $data['userfirstname'];
                    $uslana = $data['userlastname'];
                
                $_SESSION['userfirstname'] =  $data['userfirstname'];
                $_SESSION['userlastname']  =  $data['userlastname'];

               if($data && password_verify($uspa,$data['userpassword'])) {
               header('location:lius.php'); //for passowrd matchin hash
               exit();
               }else{
                echo"email password wrong";
               }

            }
          ?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        user email: <br>
        <input type="text" name="usem"> <br><br>
        user password:
        <input type="password" name="uspas"> <br><br>
        <button type="submit">login</button>
    </form>
</body>
</html>