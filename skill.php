<?php 
	include "connect.php";
	session_start();
	if(empty($_SESSION['id'])){
		header("location: index.php");
	}
	if(isset($_POST["submit"])){
		$nama=$_POST['nama'];
		$penguasaan=$_POST['penguasaan'];
		$sql1="INSERT INTO skills (nama_skills,penguasaan) values ('".$nama."','".$penguasaan."')";
		$result1=mysqli_query($con,$sql1);
			if($result1){
				?>
				<script>
					alert("berhasil input");
				</script>
				<?php
			}else{
				?>
				<script>
					alert("gagal input");
				</script>
				<?php
			}
	}
	if(isset($_GET["id"])){
		$sql3="DELETE FROM skills where skills_id='".$_GET['id']."'";
		$result3=mysqli_query($con,$sql3);
		if($result3){
			sleep(2);
			header("location:skill.php");
		}
		else{
			sleep(2);
			header("location:skill.php");
		}
	}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Skills</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<style type="text/css">
		#skill_list{
			border-collapse: collapse;
			text-align: center;
			align-content: center;
			margin-top:-90px;
			
		}
		#skill_list td, #skill_list th{
			border:1px solid black;
		}
	</style>
</head>
<body>
	<header>
		<h3 style="float: left;color: white; margin: 3px;">Selamat datang, <?php 
			$sql2="SELECT * from biodata where id = '".$_SESSION["id"]."'";
			$result2=mysqli_query($con,$sql2);
			$data=mysqli_fetch_assoc($result2);
			echo $data["nama_depan"]." ".$data["nama_belakang"];
		 ?></h3>
		<a href="logout.php" id="logout" style="float: right;background: orange;padding: 2px 10px;border-radius: 3px;color: white;">Logout</a>
	</header>
	<body>
	<div id="content">
		<div id="bg-page-profile" >
			<div id="menu-profile" >
				<ul>
					<li><a href="pendidikan.php">Pendidikan</a></li>
					<li><a href="film.php">Film</a></li>
					<li style="background:orange;"><a href="skill.php">Skill</a></li>
				</ul>

			</div>
		</div>
		<center>
		<table id="skill_list">
		
			<tr style="border: 1px solid black;">
				<center>
				<th>Skill</th>
				<th>Penguasaan</th>
				<th>Hapus</th>
				</center>
			</tr>
				<tbody>
					<?php 
						$sql="SELECT * from skills";
						$result=mysqli_query($con,$sql);
						while($data=mysqli_fetch_assoc($result)){
							?>
							<tr style="border: 1px solid black;">
								<td><?php echo $data["nama_skills"]; ?></td>
								<td><?php echo $data["penguasaan"]; ?></td>
								<td><a href="skill.php?id=<?php echo $data["skills_id"] ?>">Hapus</a></td>
							</tr>
							<?php
						}
					 ?>
				</tbody>	
		</table>
		</center>
		<form action="skill.php" method="POST" style="margin-bottom:10px;">
		<center>
			<div class="element-form">
				<label>Nama Skills</label>
				<span><input type="text" id="nama" name="nama"></input></span>
			</div>
			<div class="element-form">
				<label>Penguasaan</label>
				<span><input type="text" id="penguasaan" name="penguasaan"></input></span>
			</div>
			<div class="element-form">
				<span><input type="submit" value="TAMBAH" name="submit"></span>
			</div>
		</center>
		</form>
	</body>
	<footer style="margin-top:20px;"><p>&copy; Copyright Aryasasta D.S 2019</p></footer>
</body>
</html>