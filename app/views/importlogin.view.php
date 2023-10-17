<!DOCTYPE html>
<html>
<head>
    <title>Sign In</title>
    <link rel="stylesheet" href="../public/assets/css/login.css">
</head>
<body>
    <div class="signin-container">
        <img src='../public/assets/images/SJC-logo.jpg' id='SJCImage' alt="San Jose Clinc logo">
        <h2>Sign In</h2>
        <form method="post" action="process_login.php">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br><br>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br><br>
            
            <input type="submit" value="Sign In">
        </form>
    </div>
</body>
</html>
