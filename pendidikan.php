<?php 
	include "connect.php";
	session_start();
	if(empty($_SESSION['id'])){
		header("location: index.php");
	}
	if(isset($_POST['submit'])){
		$nama=$_POST['nama'];
		$combo=$_POST['combo'];
		$tahun_awal=$_POST['tahun_awal'];
		$tahun_akhir=$_POST['tahun_akhir'];
		$nilai_akhir=$_POST['nilai_akhir'];
		$deskripsi=$_POST['deskripsi'];
		$sql3="INSERT INTO pendidikan (nama_sekolah,jenis_pendidikan,tahun_awal,tahun_akhir,nilai_akhir,deskripsi) VALUES ('".$nama."','".$combo."','".$tahun_awal."','".$tahun_akhir."','".$nilai_akhir."','".$deskripsi."')";
		$result3=mysqli_query($con,$sql3);
			if($result3){
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
		$sql3="DELETE FROM pendidikan where pendidikan_id='".$_GET['id']."'";
		$result3=mysqli_query($con,$sql3);
		if($result3){
			?>
			<script>
				alert("Berhasil delete");
			</script>
			<?php
			sleep(3);
			header("location:pendidikan.php");
		}
		else{
			?>
			<script>
				alert("Gagal delete");
			</script>
			<?php
			sleep(3);
			header("location:pendidikan.php");
		}
	}

 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Pendidikan</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<style type="text/css">
		#pendidikan_list{
			border-collapse: collapse;
			text-align: center;
			align-content: center;
		}
		#pendidikan_list td, #pendidikan_list th{
			border:1px solid black;
		}
	</style>
	<script>
		window.onload=function(){
			var a=document.getElementById("deskripsi");
			var b=document.getElementById("maxchar");
			a.addEventListener("keyup",function(){
				b.innerHTML=a.value.length;
			})
		}
	</script>
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
		<div id="bg-page-profile">
			<div id="menu-profile" style="height:613.8px;">
				<ul>
					<li style="background:orange;"><a href="pendidikan.php">Pendidikan</a></li>
					<li><a href="film.php">Film</a></li>
					<li><a href="skill.php">Skill</a></li>
				</ul>

			</div>
		</div>
	<body>
		<table id="pendidikan_list" style="float:right;margin-top:-614px;margin-right:175px;">
		
			<tr style="border: 1px solid black;">
				<center>
				<th>Nama Sekolah</th>
				<th>Jenis Pendidikan</th>
				<th>Tahun Awal</th>
				<th>Tahun Akhir</th>
				<th>Nilai Akhir</th>
				<th>Deskripsi</th>
				<th>Hapus</th>
				</center>
			</tr>
				<tbody>
					<?php 
						$sql="SELECT * from pendidikan";
						$result=mysqli_query($con,$sql);
						while($data=mysqli_fetch_assoc($result)){
							?>
							<tr style="border: 1px solid black;">
								<td><?php echo $data["nama_sekolah"]; ?></td>
								<td><?php echo $data["jenis_pendidikan"]; ?></td>
								<td><?php echo $data["tahun_awal"]; ?></td>
								<td><?php echo $data["tahun_akhir"]; ?></td>
								<td><?php echo $data["nilai_akhir"]; ?></td>
								<td><?php echo $data["deskripsi"]; ?></td>
								<td><a href=pendidikan.php?id=<?php echo $data['pendidikan_id'] ?> onclick="return confirm('Hapus data')">Hapus</a></td>
							</tr>
							<?php
						}
					 ?>
				</tbody>	
		</table>
		<form action="pendidikan.php" method="POST" style="float:right;margin-right:270px;margin-top:-490px;">
		<center>
			<div class="element-form">
				<label>Nama Sekolah</label>
				<span><input type="text" id="nama" name="nama"></input></span>
			</div>
			<select name="combo">
				<label>Jenis Pendidikan</label>
				<?php 
					$sql1="SELECT * FROM combo";
					$result1=mysqli_query($con,$sql1);
					while($data1=mysqli_fetch_assoc($result1)){
						?>
						<option><?php echo $data1['value']; ?></option>
						<?php
					}
				 ?>
			</select>
			<div class="element-form">
			<label>Tahun Awal</label>
				<span><input type="text" id="tahun_awal" name="tahun_awal"></input></span>
			</div>
			<div class="element-form">
			<label>Tahun Akhir</label>
				<span><input type="text" id="tahun_akhir" name="tahun_akhir"></input></span>
			</div>
			<div class="element-form">
			<label>Nilai Akhir</label>
				<span><input type="text" id="nilai_akhir" name="nilai_akhir"></input></span>
			</div>
			<div class="element-form">
			<label>Deskripsi</label>
				<span><textarea id="deskripsi" name="deskripsi" maxlength="10"></textarea></span>
				<p id="maxchar">0</p><span>/10</span>
			</div>
			<div class="element-form">
				<span><input type="submit" value="TAMBAH" name="submit"></span>
			</div>
		</center>
		</form>
		<footer style="margin-top:10px;"><p>&copy; Copyright Aryasasta D.S 2019</p></footer>
</body>
</html>