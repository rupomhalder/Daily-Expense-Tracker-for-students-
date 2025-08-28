 <?php
session_start();
require_once "../backend/src/routes/db.php"; // this gives you $pdo

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        if (password_verify($password, $user['password'])) {
            // ✅ Store user info in session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['name']   = $user['name'];
            $_SESSION['email']  = $user['email'];

            header("Location: ../public/index.php");
            exit();
        } else {
            $error = "Invalid password!";
        }
    } else {
        $error = "User not found!";
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