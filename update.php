<?php
  $conn = mysqli_connect('localhost','root','','work');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_POST['id'];
$fnm = $_POST['fnm'];
$lnm = $_POST['lnm'];
$gender = $_POST['gender'];
$age = $_POST['age'];
$state = $_POST['state'];
$city = $_POST['city'];

$sql = "UPDATE student SET fnm='$fnm', lnm='$lnm', gender='$gender', age='$age', state='$state', city='$city' WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
?>
