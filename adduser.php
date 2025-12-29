<?php 
 require('conn.php');

   session_start();
   
   $ufn = $_SESSION['userfirstname'];
   $uln = $_SESSION['userlastname'];
  
     if (!isset($_SESSION['userfirstname'], $_SESSION['userlastname'])){
       header('Location:adduser.php');
       exit;
     }

    $message = "";

    if($_SERVER['REQUEST_METHOD']  ==='POST'){
      $ufn = trim($_POST['ufn']);
      $uln = trim($_POST['uln']);
      $ue = trim($_POST['ue']);
      $up = $_POST['up'];

      if (
          empty($ufn)  ||
          empty($uln) ||   // || or
          empty($ue) ||
          empty($up)
      ){
        $message  = "all fields are requested";
      }else {
        $hp = password_hash($up, PASSWORD_DEFAULT);

          $sql = "INSERT INTO users (userfirstname,userlastname,useremail,userpassword) VALUES (:fna, :lna,:email,:pass)";

          $stmt = $conn->prepare($sql);  // Prepared Statement Object .এটি SQL query-টি hold করে

          $stmt->bindParam(':fna',$ufn);
          $stmt->bindParam(':lna',$uln);
          $stmt->bindParam(':email',$ue);
          $stmt->bindParam(':pass',$hp);

         try
         {  
          $stmt->execute();
            header('location:lius.php');
          } catch (PDOException $e) {
            $message = "failed: " . $e->getMessage();
          }
      }

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
          <p><?php echo htmlspecialchars($message); ?></p>

          <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">

         <label for=""> user first name 
          <input type="text" name="ufn" >
        </label>
        <label for=""> user last name:
          <input type="text" name="uln">
        </label>
        <label for="">email
          <input type="text" name="ue">
        </label>
         <label for=""> user password
          <input type="password" name="up">
         </label>
         <label for=""> sub
         <button type="submit" >sumi</button>
         </label>
         
          </form>
          <a href="lius.php">userlist</a>
        </body>
        </html>


