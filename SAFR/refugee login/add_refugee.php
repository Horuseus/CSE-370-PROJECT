<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register as Refugee – SAFR</title>
    <link href="../css/safr.css" rel="stylesheet">
</head>
<body>

<div class="safr-topbar">
    <a href="../home.php" class="brand">SAFR</a>
</div>

<div class="safr-nav">
    <a href="login.php">Sign In</a>
    <a href="add_refugee.php" class="active">Register</a>
</div>

<div class="safr-container">
    <h2>Refugee Registration</h2>
    <form action="insert_refugee.php" method="post">
        <label for="ref-name">Full Name</label>
        <input type="text" id="ref-name" name="ref_name" placeholder="Enter your full name" required>

        <label for="ref-dob">Date of Birth</label>
        <input type="date" id="ref-dob" name="ref_dob" required>

        <label for="ref-bg">Blood Group</label>
        <select id="ref-bg" name="ref_bg">
            <option value="">-- Select Blood Group --</option>
            <option value="A+">A+</option>
            <option value="A-">A-</option>
            <option value="B+">B+</option>
            <option value="B-">B-</option>
            <option value="AB+">AB+</option>
            <option value="AB-">AB-</option>
            <option value="O+">O+</option>
            <option value="O-">O-</option>
        </select>

        <label>Home Country</label>
        <input type="text" name="ref_country" value="Syria" readonly>

        <label for="ref-city">City</label>
        <select id="ref-city" name="ref_city">
            <option value="">-- Select City --</option>
            <option value="Hasakah">Hasakah</option>
            <option value="Raqqa">Raqqa</option>
            <option value="Aleppo">Aleppo</option>
            <option value="Deir ez-Zor">Deir ez-Zor</option>
            <option value="Idlib">Idlib</option>
            <option value="Hama">Hama</option>
            <option value="Homs">Homs</option>
            <option value="Latakia">Latakia</option>
            <option value="Tartus">Tartus</option>
            <option value="Damascus">Damascus</option>
            <option value="Quneitra">Quneitra</option>
            <option value="Daraa">Daraa</option>
            <option value="Suwayda">Suwayda</option>
        </select>

        <label for="ref-date">Registration Date</label>
        <input type="date" id="ref-date" name="ref_date" required>

        <button type="submit" class="safr-btn safr-btn-full">Register</button>
    </form>
    <div class="note" style="margin-top:16px;">Already registered? <a href="login.php">Sign In here</a></div>
</div>

</body>
</html>
