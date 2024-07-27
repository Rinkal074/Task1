<?php
$conn = mysqli_connect('localhost','root','','work');


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['sid'])){
    $sid = $_POST['sid'];
    $sql = "SELECT * FROM city WHERE sid = $sid";
    $result = $conn->query($sql);
    $options = "<option value=''>Select City</option>";
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $options .= "<option value='".$row['id']."'>".$row['cname']."</option>";
        }
    }
    echo $options;
}
$conn->close();
?>
