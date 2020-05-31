<?php
	include 'connect.php';
	session_start();
	

	if(isset($_POST['submit'])){

			$username = $_POST['email'];
			$password = $_POST['password'];
			$sql = "select Email,Password from user where Email='".$username."' and Password='".$password."'";
			$result = mysqli_query($con,$sql);
			

			$num = mysqli_num_rows($result);
			$sql2 = "select id from user where email ='".$username."'";
			$result2 = mysqli_query($con,$sql2);
			$data = mysqli_fetch_assoc($result2);
			
			if($num==1){
				$_SESSION['id']=$data['id'];
				header("Location: pendidikan.php");
			}
			
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<header></header>
	<form action="index.php" method="POST">
		<div class="container-user-akses">
			<div class="element-form">
				<label>Email Mu Apa</label>
				<span><input type="text" name="email" required="Email anda kosong"></span>
			</div>

			<div class="element-form">
				<label>Password rahasia</label>
				<span><input type="password" name="password" required="Password anda kosong"></span>
			</div>

			<div class="element-form">
				<span><input type="submit" name="submit" id="submit" value="LOGIN LAHH"></span>
			</div>
		</div>	
	</form>
	<footer><p>&copy; Copyright Aryasasta D.S 2019</p></footer>
</body>
</html>
