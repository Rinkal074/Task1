<?php
$conn = mysqli_connect('localhost','root','','work');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM state";
$result = $conn->query($sql);
$options = "<option value=''>Select State</option>";
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $options .= "<option value='".$row['id']."'>".$row['name']."</option>";
    }
}
echo $options;
$conn->close();
?>
