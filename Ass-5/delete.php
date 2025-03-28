

<?php
$roll = $_POST['t1'];
$con = mysqli_connect("localhost", "root", "admin", "TY");
$sql = "DELETE FROM Student WHERE Roll_no = $roll";

if (mysqli_query($con, $sql)) {
    echo "Record Deleted Successfully";  
}  

echo "<br><br>
    <a href='Student.php'>
        <button style='padding: 10px 20px; font-size: 10px; cursor: pointer;'>Back</button>
    </a>";
?>
