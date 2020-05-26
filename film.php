<?php 
	include "connect.php";
	session_start();
	if(empty($_SESSION['id'])){
		header("location: index.php");
	}
	if(isset($_POST["submit"])){
		$username=$_SESSION['id'];
		$judul=$_POST['judul'];
		$link=$_POST['link'];
		$foto = addslashes(file_get_contents($_FILES['file']['tmp_name']));
		$sql1="INSERT INTO film (judul,link,foto_poster)  VALUES ('".$judul."','".$link."','".$foto."')";
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
		$sql3="DELETE FROM film where film_id='".$_GET['id']."'";
		$result3=mysqli_query($con,$sql3);
		if($result3){
			?>
			<script type="text/javascript">
				alert("Berhasil delete");
			</script>
			<?php
			header("location:film.php");
		}
		else{
			?>
			<script type="text/javascript">
				alert("Gagal delete");
			</script>
			<?php
			header("location:film.php");
		}
	}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Film</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<style type="text/css">
		#film_list{
			border-collapse: collapse;
			text-align: center;
			align-content: center;
			margin-top:-580px;
			margin-left: 300px;
			margin-bottom:50px;
		}
		#film_list td, #film_list th{
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
	<div id="content">
		<div id="bg-page-profile" >
			<div id="menu-profile" style="height:590.8px;">
				<ul>
					<li><a href="pendidikan.php">Pendidikan</a></li>
					<li style="background:orange;"><a href="film.php">Film</a></li>
					<li><a href="skill.php">Skill</a></li>
				</ul>

			</div>
		</div>
		<center>
		<table id="film_list">
		
			<tr style="border: 1px solid black;">
				<center>
				<th>Judul</th>
				<th>Link</th>
				<th>Foto</th>
				<th>Hapus</th>
				</center>
			</tr>
				<tbody>
					<?php 
						$sql="SELECT * from film";
						$result=mysqli_query($con,$sql);
						while($data=mysqli_fetch_assoc($result)){
							?>
							<tr style="border: 1px solid black;">
								<td><?php echo $data["judul"]; ?></td>
								<td><a href="<?php echo $data["link"]; ?>" target="_blank">Link</a></td>
								<td><?php echo '<img style="height:80px;width:80px;" src="data:image/jpeg;base64,'.base64_encode($data['foto_poster']).'"/>';?> </td>
								<td><a href="film.php?id=<?php echo $data["film_id"] ?>">Hapus</a></td>
								
							</tr>
							<?php
						}
					 ?>
				</tbody>	
		</table>
		</center>
		<form action="film.php" method="POST" enctype="multipart/form-data" style="margin-left:280px;margin-bottom:30px;">
		<center>
			<div class="element-form">
				<label>Judul Film</label>
				<span><input type="text" id="judul" name="judul" required="Harus ada judul"></input></span>
			</div>
			<div class="element-form">
				<label>Link</label>
				<span><input type="text" id="link" name="link" required="Harus ada link"></input></span>
			</div>
			<div class="element-form">
				<label>Foto Poster</label>
				<center>
				<span><input type="file" id="file" name="file"></input></span>
				</center>
			</div>
			<div class="element-form">
				<span><input type="submit" value="TAMBAH" name="submit" ></span>
			</div>
		</center>
		</form>
		<footer style="margin-top:10px;"><p>&copy; Copyright Aryasasta D.S 2019</p></footer>
</body>
</html> 