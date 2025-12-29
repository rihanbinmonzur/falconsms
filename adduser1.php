<?php
require('connection.php');

session_start();

/* ===== LOGIN CHECK ===== */
if (!isset($_SESSION['user_first_name'], $_SESSION['user_last_name'])) {
    header('Location: login.php');
    exit;
}

$message = "";

/* ===== FORM SUBMIT CHECK ===== */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // 1️⃣ Form data receive
    $user_first_name = trim($_POST['user_first_name']);
    $user_last_name  = trim($_POST['user_last_name']);
    $user_email      = trim($_POST['user_email']);
    $user_password   = $_POST['user_password'];

    // 2️⃣ Basic validation
    if (
        empty($user_first_name) ||
        empty($user_last_name) ||
        empty($user_email) ||
        empty($user_password)
    ) {
        $message = "All fields are required!";
    } else {

        // 3️⃣ Password hash
        $hashed_password = password_hash($user_password, PASSWORD_DEFAULT);

        // 4️⃣ PDO prepared statement
        $sql = "INSERT INTO users 
                (user_first_name, user_last_name, user_email, user_password)
                VALUES (:fname, :lname, :email, :password)";

        $stmt = $conn->prepare($sql);

        // 5️⃣ Bind values
        $stmt->bindParam(':fname', $user_first_name);
        $stmt->bindParam(':lname', $user_last_name);
        $stmt->bindParam(':email', $user_email);
        $stmt->bindParam(':password', $hashed_password);

        // 6️⃣ Execute
        if ($stmt->execute()) {
            $message = "User added successfully!";
        } else {
            $message = "Failed to add user!";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Users (PDO)</title>
</head>
<body>

<h2>Add User</h2>
<p style="color:green;"><?php echo $message; ?></p>

<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">

    User's First Name:<br>
    <input type="text" name="user_first_name"><br><br>

    User's Last Name:<br>
    <input type="text" name="user_last_name"><br><br>

    User's Email:<br>
    <input type="email" name="user_email"><br><br>

    User's Password:<br>
    <input type="password" name="user_password"><br><br>

    <input type="submit" value="Submit">

</form>

</body>
</html>
