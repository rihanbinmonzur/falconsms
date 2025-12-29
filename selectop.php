<?php 
    function sellis($conn, $tablna, $column1,$column2){
      
   
      try{
            $sql = "SELECT * FROM $tablna";
                $query = $conn->query($sql);

                  while  ($data = $query->fetch(PDO::FETCH_ASSOC)){
                    $daid = $data[$column1];
                    $dana  =$data[$column2];

                    echo "<option value='$daid'>$dana</option>";
                  } 
      } catch (Exception $e) {
          echo "<option value=''>error loading </option>" ;
      }
    }
?>