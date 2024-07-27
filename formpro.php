<?php
	
    $cn = mysqli_connect('localhost','root','','work');

	if(isset($_POST['submit']))
	{
            $fnm = $_POST['fnm'];
            $lnm = $_POST['lnm'];
            $gender = $_POST['gender']; 
            $age = $_POST['age'];
            $state = $_POST['state'];
            $city = $_POST['city'];
			$subjects = implode(',', $_POST['subjects']);	
            	
            $q = mysqli_query($cn,"INSERT INTO `student` (`id`, `fnm`, `lnm`, `gender`, `age`, `state`, `city`,`subjects`) VALUES ('', '$fnm', '$lnm', '$gender', '$age', '$state', '$city','$subjects')");
			echo"<script>alert('Thank You.....')</script>";
			echo"<script>window.location='index.php'</script>";
	}				
	else
	{
		echo"";
	}
?>