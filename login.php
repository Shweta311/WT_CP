<!DOCTYPE html>
<html>
  <head>
    <title>Login Page</title>
    <link rel="stylesheet" href="css/login.css" />
  </head>
  <body>
    <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // validate input fields
            $username = $_POST['username'];
            $password = $_POST['password'];
            $errors = [];
            if (empty($username)) {
                $errors[] = 'Please enter your username.';
            }
            if (empty($password)) {
                $errors[] = 'Please enter your password.';
            }
            
            // if no validation errors, check login credentials against database
            if (empty($errors)) {
              $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "nba";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
                $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
                $result = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($result);
                if ($count == 1) {
                    // login successful, redirect to home page
                    header('Location: home.html');
                    exit;
                } else {
                    // login failed, show error message
                    $error = 'Invalid login credentials.';
                }
                mysqli_close($conn);
            }
        }
    ?>
    <div class="container">
      <div class="login-box">
        <h2>Login</h2>
        <?php if (isset($error)) { ?>
        <p><?php echo $error; ?></p>
        <?php } ?>
        <?php if (!empty($errors)) { ?>
        <ul>
            <?php foreach ($errors as $error) { ?>
            <li><?php echo $error; ?></li>
            <?php } ?>
        </ul>
        <?php } ?>
        <form method="POST" action="">
          <div class="user-box">
            <input type="text" name="username" required />
            <label>Username</label>
          </div>
          <div class="user-box">
            <input type="password" name="password" required />
            <label>Password</label>
          </div>
          <button type="submit" name="submit">Login</button>
        </form>
        <p>Don't have an account? <a href="signup.html">Sign up</a></p>
      </div>
    </div>
  </body>
</html>
