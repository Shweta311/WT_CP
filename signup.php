<!DOCTYPE html>
<html>
  <head>
    <title>Signup Page</title>
    <link rel="stylesheet" href="css/signup.css" />
  </head>
  <body>
    <a href="signup.php">Login</a>
    <div class="signup-box">
      <h2>Signup</h2>
      <?php if (isset($error)) { ?>
      <p class="error"><?php echo $error; ?></p>
      <?php } ?>
      <form method="POST" action="">
        <div class="user-box">
          <input type="text" name="username" required />
          <label>Username</label>
        </div>
        <div class="user-box">
          <input type="email" name="email" required />
          <label>Email</label>
        </div>
        <div class="user-box">
          <input type="password" name="password" required />
          <label>Password</label>
        </div>
        <div class="user-box">
          <input type="password" name="confirm_password" required />
          <label>Confirm Password</label>
        </div>
        <button type="submit" name="signup">
          <a href="home.html"></a>Signup
        </button>
      </form>
    </div>

        <?php
if(isset($_POST['signup'])){
    // Connect to the database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "nba";
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Validate user input
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        $error = "Password and Confirm Password do not match";
    } else {
        // Insert user data into the database
        $sql = "INSERT INTO users (username, email, password)
                VALUES ('$username', '$email', '$password')";
        if (mysqli_query($conn, $sql)) {
            header("Location: home.html");
            exit();
        } else {
            $error = "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    mysqli_close($conn);
}
?>


  </body>
</html>


<!-- 
first create db nba

CREATE TABLE users (
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(30) NOT NULL,
  email VARCHAR(50) NOT NULL,
  password VARCHAR(255) NOT NULL
); -->