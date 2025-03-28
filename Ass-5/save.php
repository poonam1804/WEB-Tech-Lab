<?php
// Database Connection
$con = mysqli_connect("localhost", "root", "admin", "TY");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $roll_no = mysqli_real_escape_string($con, $_POST['roll_no']);
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $mobile = mysqli_real_escape_string($con, $_POST['mobile']);
    $address = mysqli_real_escape_string($con, $_POST['address']);

    // Update query
    $sql = "UPDATE Student SET 
                Name = '$name', 
                Email = '$email', 
                Mobile_No = '$mobile', 
                Address = '$address' 
            WHERE Roll_no = '$roll_no'";

    if (mysqli_query($con, $sql)) {
        echo "Record Updated Successfully";  
    } else {
        echo "<script>alert('Error updating record: " . mysqli_error($con) . "'); window.location.href='update.php';</script>";
    }
}

// Close connection
echo "<br><br>
    <a href='Student.php'>
        <button style='padding: 10px 20px; font-size: 10px; cursor: pointer;'>Back</button>
    </a>";
mysqli_close($con);
?>

