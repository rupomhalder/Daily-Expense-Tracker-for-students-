 <?php
session_start();
include "../backend/src/routes/db.php"; // database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            // ✅ Store all user data into session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['name'] = $user['name'];   // 👈 this fixes your warning
            $_SESSION['email'] = $user['email']; // 👈 this fixes your warning

            header("Location: ../public/index.php"); // redirect to dashboard
            exit();
        } else {
            echo "Invalid password!";
        }
    } else {
        echo "User not found!";
    }
}
?>

 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <title>Login</title>
     <link rel="stylesheet" href="../assets/css/login.css">
 </head>

 <body>
     <div class="container">
         <h2>Login</h2>

         <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

         <!-- Login Form -->
         <form action="login.php" method="POST">
             <input type="email" name="email" placeholder="Enter Email" required>
             <input type="password" name="password" placeholder="Enter Password" required>
             <button type="submit">Login</button>
         </form>

         <!-- Link to Register -->
         <p>Don’t have an account? <a href="../auth/register.php">Register here</a></p>

         <h3>or</h3>
         <a href="../auth/wlcm.php" class="social-btn google">Exit</a>
     </div>
 </body>

 </html>