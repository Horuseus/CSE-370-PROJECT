<?php
//session starts after logging in
session_start();

$host   = "localhost";
$dbname = "safr_project_final";
$user   = "root";
$pass   = "";

//db connection
$conn = mysqli_connect($host, $user, $pass, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$message = "";

//logout session
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: donor.php");
    exit();
}

function validateDonation(array $data): array {
    $errors = [];

    //donor name
    if (empty(trim($data["name"]))) {
        $errors[] = "Name is required.";
    } elseif (strlen($data["name"]) > 100) {
        $errors[] = "Name must be under 100 characters.";
    }

    //email
    if (empty(trim($data["email"]))) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($data["email"], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email is not valid.";
    } elseif (strlen($data["email"]) > 100) {
        $errors[] = "Email must be under 100 characters.";
    }

    //amount
    if (empty(trim($data["amount"]))) {
        $errors[] = "Amount is required.";
    } elseif (!is_numeric($data["amount"]) || $data["amount"] <= 0) {
        $errors[] = "Amount must be a positive number.";
    }

    return $errors;
}

//sign up
if (isset($_POST['signup'])) {
    $name     = $_POST['name'];
    $email    = $_POST['email'];
    $phone    = $_POST['phone'];
    $password = $_POST['password'];
    $confirm  = $_POST['confirm_password'];

    if ($password != $confirm) {
        $message = "ERROR: Passwords do not match!";
    } else {
        // Check if name already exists
        $check = mysqli_query($conn, "SELECT Name FROM donor WHERE Name = '$name'");

        if (mysqli_num_rows($check) > 0) {
            $message = "ERROR: This name is already registered!";
        } else {
            // Add to donor table
            mysqli_query($conn, "INSERT INTO donor (Name, Phone, Email, Total_Amount) VALUES ('$name', '$phone', '$email', 0)");
            // Add to donor_credential table
            mysqli_query($conn, "INSERT INTO donor_credential (Full_name, Password) VALUES ('$name', '$password')");

            $_SESSION['donor_name'] = $name;
            $message = "SUCCESS: Account created! Welcome, $name!";
        }
    }
}

//login
if (isset($_POST['login'])) {
    $name     = $_POST['name'];
    $password = $_POST['password'];

    $result = mysqli_query($conn, "SELECT Full_name FROM donor_credential WHERE Full_name = '$name' AND Password = '$password'");

    if (mysqli_num_rows($result) == 1) {
        $_SESSION['donor_name'] = $name;
        $message = "SUCCESS: Welcome back, $name!";
    } else {
        $message = "ERROR: Wrong name or password!";
    }
}

//selecting ngo
$ngos = mysqli_query($conn, "SELECT NGO_name FROM ngo ORDER BY NGO_name");

//getting donor info after logging in
$donor_info = null;
if (isset($_SESSION['donor_name'])) {
    $name       = $_SESSION['donor_name'];
    $donor_info = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM donor WHERE Name = '$name'"));
}

if (isset($_POST['donate'])) {
    $donor_name     = $_SESSION['donor_name'];
    $ngo_name       = $_POST['ngo_name'];
    $amount         = $_POST['amount'];
    $payment_method = $_POST['payment_method'];

    $errors = validateDonation([
        "name"   => $donor_name,
        "email"  => $donor_info['Email'] ?? "",
        "amount" => $amount
    ]);

    if (!empty($errors)) {
        $message = "ERROR: " . implode(" | ", $errors);
    } else {
        mysqli_query($conn, "UPDATE donor SET Total_Amount = Total_Amount + $amount, Payment_Method = '$payment_method' WHERE Name = '$donor_name'");

        $check_link = mysqli_query($conn, "SELECT * FROM donor_ngo WHERE NGO_name = '$ngo_name' AND Donor_Name = '$donor_name'");

        if (mysqli_num_rows($check_link) == 0) {
            mysqli_query($conn, "INSERT INTO donor_ngo (NGO_name, Donor_Name) VALUES ('$ngo_name', '$donor_name')");
        }

        $message = "SUCCESS: Thank you! $$amount has been donated to $ngo_name.";
    }
}

$page = "login";

if (isset($_GET['page'])) {
    $page = $_GET['page'];
}
if (isset($_SESSION['donor_name']) && !isset($_GET['page'])) {
    $page = "donate";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Donor Portal – SAFR</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body {
            font-family: 'Inter', Georgia, serif;
            background: #f0f4f8;
            margin: 0;
            padding: 0;
        }
        .topbar {
            background: #111d2b;
            color: white;
            padding: 16px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #1e3048;
        }
        .topbar h1 { margin: 0; font-size: 20px; font-weight: 700; letter-spacing: 1px; }
        .topbar h1 a { color: #e07b4a; text-decoration: none; }
        .topbar a  { color: #7a95b0; text-decoration: none; font-size: 13px; }
        .topbar a:hover { color: #e8edf2; }

        .nav {
            background: #224a73;
            padding: 10px 30px;
            display: flex;
            gap: 20px;
        }
        .nav a {
            color: #cce5ff;
            text-decoration: none;
            font-size: 15px;
            padding: 6px 14px;
            border-radius: 4px;
        }
        .nav a:hover, .nav a.active {
            background: #1a6fb5;
            color: white;
        }

        .container {
            max-width: 600px;
            margin: 40px auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
            border: 1px solid #c8d8e8;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }

        h2 {
            color: #1a3a5c;
            margin-top: 0;
            border-bottom: 2px solid #e0eaf4;
            padding-bottom: 10px;
        }

        .message {
            padding: 12px 16px;
            margin-bottom: 20px;
            border-radius: 5px;
            font-size: 15px;
        }
        .message.success { background: #d4edda; color: #155724; border: 1px solid #b8dfc4; }
        .message.error   { background: #f8d7da; color: #721c24; border: 1px solid #f0b8bc; }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
            font-size: 14px;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="number"],
        select {
            width: 100%;
            padding: 10px 12px;
            margin-bottom: 18px;
            border: 1px solid #bbb;
            border-radius: 5px;
            font-size: 15px;
            box-sizing: border-box;
            font-family: Georgia, serif;
        }
        input:focus, select:focus {
            outline: none;
            border-color: #1a6fb5;
        }

        button[type="submit"] {
            background: #1a6fb5;
            color: white;
            padding: 11px 28px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
            font-family: Georgia, serif;
        }
        button[type="submit"]:hover { background: #124e82; }

        .info-box {
            background: #eef5fc;
            border: 1px solid #c0d8ee;
            border-radius: 6px;
            padding: 16px 20px;
            margin-bottom: 20px;
        }
        .info-box p { margin: 6px 0; font-size: 15px; color: #1a3a5c; }
        .info-box strong { display: inline-block; width: 140px; color: #555; }

        .note { text-align: center; margin-top: 16px; font-size: 14px; color: #666; }
        .note a { color: #1a6fb5; text-decoration: none; }
        .note a:hover { text-decoration: underline; }

        footer { text-align: center; padding: 20px; color: #888; font-size: 13px; }
    </style>
</head>
<body>

<div class="topbar">
    <h1><a href="../home.php">SAFR &mdash; Donor Portal</a></h1>
    <?php if (isset($_SESSION['donor_name'])): ?>
        <span>Hello, <?php echo $_SESSION['donor_name']; ?> &nbsp;|&nbsp; <a href="donor.php?logout=1">Logout</a></span>
    <?php else: ?>
        <span>Support Refugees Worldwide</span>
    <?php endif; ?>
</div>

<div class="nav">
    <?php if (!isset($_SESSION['donor_name'])): ?>
        <a href="donor.php?page=login"  class="<?php echo ($page == 'login')  ? 'active' : ''; ?>">Login</a>
        <a href="donor.php?page=signup" class="<?php echo ($page == 'signup') ? 'active' : ''; ?>">Sign Up</a>
    <?php else: ?>
        <a href="donor.php?page=donate"  class="<?php echo ($page == 'donate')  ? 'active' : ''; ?>">Donate</a>
        <a href="donor.php?page=profile" class="<?php echo ($page == 'profile') ? 'active' : ''; ?>">My Profile</a>
        <a href="donor.php?logout=1">Logout</a>
    <?php endif; ?>
</div>

<div class="container">

    <?php if ($message != ""): ?>
        <?php if (strpos($message, "ERROR") !== false): ?>
            <div class="message error"><?php echo $message; ?></div>
        <?php else: ?>
            <div class="message success"><?php echo $message; ?></div>
        <?php endif; ?>
    <?php endif; ?>

    <?php if ($page == "login" && !isset($_SESSION['donor_name'])): ?>

        <h2>Login</h2>
        <form method="POST" action="donor.php">
            <label>Full Name:</label>
            <input type="text" name="name" placeholder="e.g. John Smith" required>

            <label>Password:</label>
            <input type="password" name="password" placeholder="Your password" required>

            <button type="submit" name="login">Login</button>
        </form>
        <div class="note">Don't have an account? <a href="donor.php?page=signup">Sign Up here</a></div>

    <?php elseif ($page == "signup" && !isset($_SESSION['donor_name'])): ?>

        <h2>Create an Account</h2>
        <form method="POST" action="donor.php">
            <label>Full Name: <span style="color:#888; font-weight:normal;">(this will be your login name)</span></label>
            <input type="text" name="name" placeholder="e.g. Aisha Rahman" required>

            <label>Email:</label>
            <input type="email" name="email" placeholder="you@email.com">

            <label>Phone Number:</label>
            <input type="text" name="phone" placeholder="+880-171-...">

            <label>Password:</label>
            <input type="password" name="password" required>

            <label>Confirm Password:</label>
            <input type="password" name="confirm_password" required>

            <button type="submit" name="signup">Create Account</button>
        </form>
        <div class="note">Already have an account? <a href="donor.php?page=login">Login here</a></div>

    <?php elseif ($page == "donate" && isset($_SESSION['donor_name'])): ?>

        <h2>Make a Donation</h2>
        <p style="color:#555; margin-top:-8px; margin-bottom:20px; font-size:14px;">
            Your donation goes directly to NGOs helping refugees in camps across Syria, Somalia, Sudan, and Afghanistan.
        </p>

        <form method="POST" action="donor.php?page=donate">
            <label>Choose an NGO:</label>
            <select name="ngo_name" required>
                <option value="">-- Select an NGO --</option>
                <?php while ($row = mysqli_fetch_assoc($ngos)): ?>
                    <option value="<?php echo $row['NGO_name']; ?>">
                        <?php echo $row['NGO_name']; ?>
                    </option>
                <?php endwhile; ?>
            </select>

            <label>Donation Amount (USD $):</label>
            <input type="number" name="amount" min="1" step="0.01" placeholder="e.g. 500" required>

            <label>Payment Method:</label>
            <select name="payment_method" required>
                <option value="">-- Select --</option>
                <option value="Credit Card">Credit Card</option>
                <option value="Debit Card">Debit Card</option>
                <option value="MFS">Mobile Banking (bKash / Nagad)</option>
                <option value="Bank Transfer">Bank Transfer</option>
                <option value="Cash">Cash</option>
            </select>

            <button type="submit" name="donate">Donate Now</button>
        </form>

    <?php elseif ($page == "profile" && isset($_SESSION['donor_name'])): ?>

        <h2>My Profile</h2>

        <?php if ($donor_info): ?>
            <div class="info-box">
                <p><strong>Name:</strong> <?php echo $donor_info['Name']; ?></p>
                <p><strong>Email:</strong> <?php echo $donor_info['Email'] ? $donor_info['Email'] : "Not set"; ?></p>
                <p><strong>Phone:</strong> <?php echo $donor_info['Phone'] ? $donor_info['Phone'] : "Not set"; ?></p>
                <p><strong>Payment Method:</strong> <?php echo $donor_info['Payment_Method'] ? $donor_info['Payment_Method'] : "Not set"; ?></p>
                <p><strong>Total Donated:</strong> $<?php echo number_format($donor_info['Total_Amount'], 2); ?></p>
                <p><strong>Donor Type:</strong> <?php echo $donor_info['Donor_type'] ? $donor_info['Donor_type'] : "Not set"; ?></p>
            </div>

            <h3 style="color:#1a3a5c;">NGOs I Have Donated To:</h3>

            <?php
            $dn      = $_SESSION['donor_name'];
            $my_ngos = mysqli_query($conn, "SELECT NGO_name FROM donor_ngo WHERE Donor_Name = '$dn'");
            ?>

            <?php if (mysqli_num_rows($my_ngos) > 0): ?>
                <ul style="line-height:2; color:#1a3a5c; font-size:15px;">
                    <?php while ($row = mysqli_fetch_assoc($my_ngos)): ?>
                        <li><?php echo $row['NGO_name']; ?></li>
                    <?php endwhile; ?>
                </ul>
            <?php else: ?>
                <p style="color:#888;">You haven't donated yet. <a href="donor.php?page=donate" style="color:#1a6fb5;">Donate now</a>.</p>
            <?php endif; ?>
        <?php endif; ?>

    <?php else: ?>
        <p>Redirecting... <a href="donor.php">Click here</a> if not redirected.</p>
        <script>window.location = "donor.php";</script>
    <?php endif; ?>

</div>



</body>
</html>

<?php mysqli_close($conn); ?>