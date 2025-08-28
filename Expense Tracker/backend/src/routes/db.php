 <?php
$host = "localhost";        // Database host
$dbname = "expense_tracker"; // Your database name
$user = "root";             // Your MySQL username (default in XAMPP is "root")
$pass = "";                 // Your MySQL password (default in XAMPP is empty)

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("DB Connection failed: " . $e->getMessage());
}
?>