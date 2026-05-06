<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Refugee Sign In – SAFR Refugee Aid Platform">
    <title>Refugee Portal – SAFR</title>
    <style>
        body { font-family: Georgia, serif; background: #f0f4f8; margin: 0; padding: 0; }
        .topbar { background: #111d2b; color: white; padding: 16px 30px; display: flex; justify-content: space-between; align-items: center; }
        .topbar h1 { margin: 0; font-size: 22px; }
        .topbar h1 a { color: #e07b4a; text-decoration: none; }
        .nav { background: #224a73; padding: 10px 30px; display: flex; gap: 20px; }
        .nav a { color: #cce5ff; text-decoration: none; font-size: 15px; padding: 6px 14px; border-radius: 4px; }
        .nav a.active { background: #1a6fb5; color: white; }
        .container { max-width: 600px; margin: 40px auto; background: white; padding: 30px; border-radius: 8px; border: 1px solid #c8d8e8; box-shadow: 0 2px 10px rgba(0,0,0,0.08); }
        h2 { color: #1a3a5c; margin-top: 0; border-bottom: 2px solid #e0eaf4; padding-bottom: 10px; }
        .msg-error { background: #f8d7da; color: #721c24; border: 1px solid #f0b8bc; padding: 12px 16px; border-radius: 5px; font-size: 14px; margin-bottom: 18px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; color: #333; font-size: 14px; }
        input[type="text"], input[type="password"] { width: 100%; padding: 10px 12px; margin-bottom: 18px; border: 1px solid #bbb; border-radius: 5px; font-size: 15px; box-sizing: border-box; font-family: Georgia, serif; }
        input:focus { outline: none; border-color: #1a6fb5; }
        button[type="submit"] { background: #1a6fb5; color: white; padding: 11px 28px; border: none; border-radius: 5px; font-size: 16px; cursor: pointer; width: 100%; font-family: Georgia, serif; }
        .note { text-align: center; margin-top: 16px; font-size: 14px; color: #666; }
        .note a { color: #1a6fb5; text-decoration: none; }
    </style>
</head>
<body>

<div class="topbar">
    <h1><a href="../home.php">SAFR &mdash; Refugee Portal</a></h1>
</div>

<div class="nav">
    <a href="login.php" class="active">Sign In</a>
    <a href="add_refugee.php">Register</a>
</div>

<div class="container">
    <h2>Refugee Sign In</h2>

    <?php
    if(isset($_GET['error'])){
        if($_GET['error'] === 'invalid'){
            echo '<div class="msg-error">Invalid SAFR ID or password. Please try again.</div>';
        } elseif($_GET['error'] === 'empty'){
            echo '<div class="msg-error">Please fill in both your SAFR ID and password.</div>';
        }
    }
    ?>

    <form action="signin.php" method="post">
        <label for="refugee-id">SAFR ID</label>
        <input type="text" id="refugee-id" name="Sid" placeholder="Enter your SAFR ID" required>

        <label for="refugee-pass">Password</label>
        <input type="password" id="refugee-pass" name="pass" placeholder="Enter your password" required>

        <button type="submit">Sign In</button>
    </form>
    <div class="note">Not registered? <a href="add_refugee.php">Sign up here</a></div>
</div>

</body>
</html>
