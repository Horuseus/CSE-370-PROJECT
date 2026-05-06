<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SAFR - Refugee Aid and Support Platform. Login as Donor, Refugee, NGO, or Volunteer.">
    <title>Welcome to SAFR</title>
    <style>
        body {
            font-family: Georgia, serif;
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
        }
        .topbar h1 { margin: 0; font-size: 22px; }
        .topbar h1 a { color: #e07b4a; text-decoration: none; }
        .topbar span { color: #a8d8f0; font-size: 14px; }

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

        .role-list {
            list-style: none;
            padding: 0;
            margin: 24px 0 0 0;
        }
        .role-list li {
            border: 1px solid #c8d8e8;
            border-radius: 6px;
            margin-bottom: 14px;
            overflow: hidden;
        }
        .role-list li a {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 20px;
            text-decoration: none;
            color: #1a3a5c;
            font-size: 15px;
            background: #fff;
        }
        .role-list li a:hover {
            background: #eef5fc;
        }
        .role-name {
            font-weight: bold;
            font-size: 16px;
            color: #1a3a5c;
        }
        .role-desc {
            font-size: 13px;
            color: #666;
            margin-top: 3px;
        }
        .role-arrow {
            color: #1a6fb5;
            font-size: 18px;
        }

        footer {
            text-align: center;
            padding: 20px;
            color: #888;
            font-size: 13px;
        }
    </style>
</head>
<body>

<div class="topbar">
    <h1><a href="home.php">SAFR</a></h1>
</div>

<div class="nav">
    <a href="home.php">Home</a>
</div>

<div class="container">
    <h2>Select Your Role</h2>
    <p style="color:#555; font-size:14px; margin-bottom:4px;">
        Choose the category that applies to you to access your portal.
    </p>

    <ul class="role-list">
        <li>
            <a href="donor FILES/donor.php">
                <div>
                    <div class="role-name">Donor</div>
                    <div class="role-desc">Support NGOs and fund relief efforts for refugees in need.</div>
                </div>
                <span class="role-arrow">&rsaquo;</span>
            </a>
        </li>
        <li>
            <a href="refugee login/login.php">
                <div>
                    <div class="role-name">Refugee</div>
                    <div class="role-desc">Register or sign in to access camp services and assistance.</div>
                </div>
                <span class="role-arrow">&rsaquo;</span>
            </a>
        </li>
        <li>
            <a href="NGO/NGOsign.php">
                <div>
                    <div class="role-name">NGO</div>
                    <div class="role-desc">Manage operations, view donations, and coordinate relief work.</div>
                </div>
                <span class="role-arrow">&rsaquo;</span>
            </a>
        </li>
        <li>
            <a href="Volunteer/Volunteer_signin.php">
                <div>
                    <div class="role-name">Volunteer</div>
                    <div class="role-desc">Sign in to view your assignments and contribute to the mission.</div>
                </div>
                <span class="role-arrow">&rsaquo;</span>
            </a>
        </li>
    </ul>
</div>



</body>
</html>
