<?php 
 require('conn.php');

  // session_start();
  //   if (!isset($_SESSION['ufn'], $_SESSION['uln'])){
  //     header('Location:adduser.php');
  //     exit;
  //   }

    $message = "";

    if(!isset($_GET['id'])){
      die("user id not found"); // STOP everything right now and show this message     
    }
          $id = (int)$_GET['id'];

      $sql = "SELECT * FROM users WHERE userid = $id ";
       $query = $conn->query($sql);
        $data = $query->fetch(PDO::FETCH_ASSOC);

           if(!$data){
          die("user not found");
         }

              $uid = $data['userid'];    	
              $fn = $data['userfirstname'];
              $ln = $data['userlastname'];
              $ue = $data['useremail'];
  
      

         if($_SERVER['REQUEST_METHOD']=== 'POST') {

      $ufn = trim($_POST['ufn']);
      $uln = trim($_POST['uln']);
      $ue = trim($_POST['ue']);

      if (empty($ufn) || empty($uln) ||
           empty($ue)){ 
        $message  = "all fields are requested"; 
        // || or
      }else { 
          $sql = "UPDATE users  SET userfirstname =:fna ,userlastname = :lna,useremail=:email WHERE userid= :id";

          $stmt = $conn->prepare($sql);  // Prepared Statement Object .এটি SQL query-টি hold করে

          $stmt->bindParam(':fna',$ufn);
          $stmt->bindParam(':lna',$uln);
          $stmt->bindParam(':email',$ue);
          $stmt->bindParam(':id',$id);

          try {
              $stmt->execute();
              $message = "user address successfully!";
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

          <form method="POST">

         <label for=""> user first name 
          <input type="text" name="ufn" value="<?php echo $fn ?>">
        </label>
        <label for=""> user last name:
          <input type="text" name="uln" value="<?php echo $ln ?>">
        </label>
        <label for="">email
          <input type="text" name="ue" value="<?php echo $ue ?>">
        </label>
         <label for=""> sub
          <button type="submit" >sumi</button>
         </label>
         
          </form>
        </body>
        </html>


