 <?php
include '../backend/src/routes/db.php'; // database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        $error = "❌ Passwords do not match!";
    } else {
        // Check if email already exists
        $checkSql = "SELECT id FROM users WHERE email = ?";
        $checkStmt = $conn->prepare($checkSql);
        $checkStmt->bind_param("s", $email);
        $checkStmt->execute();
        $checkStmt->store_result();

        if ($checkStmt->num_rows > 0) {
            $error = "❌ Email already registered! Try another one.";
        } else {
            // Insert new user
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (fullname, email, password) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $fullname, $email, $hashed_password);

            if ($stmt->execute()) {
                $success = "✅ Registration successful! <a href='login.php'>Login here</a>";
            } else {
                $error = "❌ Error: " . $stmt->error;
            }
        }
    }
}
?>
 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <title>Register</title>
     <link rel="stylesheet" href="../assets/css/register.css">
 </head>

 <body>
     <div class="container">
         <h2>Create Account</h2>
         <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
         <?php if (!empty($success)) echo "<p style='color:green;'>$success</p>"; ?>
         <!-- Register Form -->
         <form action="register.php" method="POST">
             <input type="text" name="fullname" placeholder="Full Name" required>
             <input type="email" name="email" placeholder="Email" required>
             <input type="password" name="password" placeholder="Password" required>
             <input type="password" name="confirm_password" placeholder="Confirm Password" required>
             <button type="submit">Register</button>
         </form>

         <!-- Link to Login -->
         <p>Already have an account? <a href="../auth/login.php">Login here</a></p>

         <h3>or</h3>
         <a href="../auth/wlcm.php" class="social-btn google">Exit</a>
     </div>
 </body>

 </html>