<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container">
         <h4>uptopbar</h4>
       <div class="container-fluid"> <!-- topbar -->
            <h1> store management system </h1>
       </div>
       <div class="container-fluid">
         <div class="row">
            <div class="col-sm-3 bg-light p-0 m-0"> <!-- left bar -->
               <h4 class="bg-success text-white px-2 py-1">category</h4>  <!-- x=left right -->
                <ul class="list-group">
                    <li class="list-group-item">
                        <a href="add_category.php" class="text-dark text-decoration-none">add category</a>
                    </li> 
                    <li class="list-group-item"> <a href="category_list.php" class="text-dark text-decoration-none">caategory list</a> </li>
                </ul>

                <h5 class="bg-info text-white px-2 py-1" >Product</h5>
                  <ul class="list-group">
                    <li class="list-group-item"><a href="addproduct.php" class="text-dark text-decoration-none">add product</a></li>
                    <li class="list-group-item"><a class="text-dark text-decoration-none" href="productlist.php">product list</a></li>
                  </ul>
                <h5 class="bg-secondary text-white px-2 py-1">store product</h5>
                <ul class="list-group">
                  <li class="list-group-item"><a href="prstcreate.php" class="text-decoration-none">product store create</a></li>
                  <li class="list-group-item"><a href="prstlist.php" class="text-dark text-decoration-none">product store list</a></li>
                </ul>
                <h5>spend product </h5>
                <ul class="list-group">
                  <li class="list-group-item"><a href="spenprlist.php" class="text-decoration-none">spend product list</a></li>
                </ul>
                <h3 class="bg-warning"><a href="report.php">report</a></h3>
            </div>  <!-- end of left -->
                <div class="col-sm-9"> <!-- right bar -->
                right
                </div> <!-- end of right -->
         </div>
       </div>
             <div class="container-fluid">
                bottom bar
             </div>
    </div>

    <h3><a href="logout.php">log out</a></h3>
</body>
</html>