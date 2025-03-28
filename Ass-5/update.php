<?php
// Database Connection
$con = mysqli_connect("localhost", "root", "admin", "TY");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$roll = "";
$name = "";
$email = "";
$mobile = "";
$address = "";
$showForm = false; // Controls form display

// If user submits Roll No
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['fetch'])) {
    $roll = mysqli_real_escape_string($con, $_POST['t1']); // Secure input

    // Fetch student details from database
    $sql = "SELECT * FROM Student WHERE Roll_no = '$roll'";
    $result = mysqli_query($con, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        
        // Debugging: Check what data is retrieved
        // echo "<pre>";
        // print_r($row);
        // echo "</pre>";

        // Assign values from database
        $name = $row['Name'] ?? "";
        $email = $row['Email'] ?? "";
        $mobile = $row['Mobile_No'] ?? "";
        $address = $row['Address'] ?? "";
        
        $showForm = true; // Enable form display
    } else {
        echo "<script>alert('No record found for Roll No: $roll');</script>";
    }
}

mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Student Record</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            margin: 50px;
        }
        form {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            display: inline-block;
        }
        input[type="text"], input[type="email"] {
            padding: 10px;
            width: 250px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h2>Update Student Record</h2>

    <!-- Form to enter Roll No -->
    <form method="post" action="update.php">
        <label>Enter Roll No:</label>
        <input type="text" name="t1" value="<?php echo htmlspecialchars($roll); ?>" required>
        <input type="submit" name="fetch" value="Fetch Data">
    </form>

    <?php if ($showForm) { ?>
    <br><br>
    <!-- Form to update student details -->
    <form method="post" action="save.php">
        <input type="hidden" name="roll_no" value="<?php echo htmlspecialchars($roll); ?>">
        <label>Name:</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>" required><br>
        <label>Email:</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required><br>
        <label>Mobile:</label>
        <input type="text" name="mobile" value="<?php echo htmlspecialchars($mobile); ?>" required><br>
        <label>Address:</label>
        <input type="text" name="address" value="<?php echo htmlspecialchars($address); ?>" required><br><br>
        <input type="submit" value="Save Changes">
    </form>
    <?php } ?>
</body>
</html>
