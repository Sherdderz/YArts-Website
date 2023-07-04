<?php
	$conn = mysqli_connect('localhost', 'root', '', 'user-registration') or die($conn);
	$data = mysqli_query($conn,"SELECT * FROM tb_gambar WHERE id_gambar ='".$_GET['id']."'");
	$r = mysqli_fetch_array($data);

	$author = $r['author'];
	$judul = $r['judul'];
	$file = $r['file'];
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="style.css">	
	<title>Edit Your Image</title>
</head>
<body>
	<h1>Edit your image here!</h1>


<div class="upload-form">
	<form id="upload-form" method="post" action="" enctype="multipart/form-data">
	<input class="upload-control" placeholder="Author" type="text" name="author" value="<?php echo $author ?>" /><br>
	<input class="upload-control" placeholder="Image Title" type="text" name="judul" value="<?php echo $judul ?>" /><br>
	<input class="upload-control" placeholder="Image" type="file" name="gambar" value="<?php echo $file ?>"><br>
	<img src="upload/<?php echo $file ?>" width="500px" height="500px"><br>
	<input class="upload-control submit" type="submit" name="kirim" value="Update" />
	</form>
</div>

<?php
	if(isset($_POST['kirim'])){
		$ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg');
		$author = $_POST['author'];
		$judul = $_POST['judul'];
		$nama_file = $_FILES['gambar']['name'];
		$x = explode('.', $nama_file);
		$ekstensi = strtolower(end($x));
		$source = $_FILES['gambar']['tmp_name'];
		$folder = './upload/';

		if($nama_file !=''){
			move_uploaded_file($source, $folder.$nama_file);
			$update = mysqli_query($conn, "UPDATE tb_gambar SET
				author = '".$author."',
				judul = '".$judul."',
				file = '".$nama_file."'
				WHERE id_gambar ='".$_GET['id']."'
				");
			if($update){
				if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
					echo "<script>alert('Update success');window.location.href = 'index.php';</script>";
				}else{
					echo 'Update Failed';
				}
			}else {
				echo 'Update Failed';
			}
		}else{	
			$update = mysqli_query($conn, "UPDATE tb_gambar SET
				author = '".$author."',
				judul = '".$judul."'
				WHERE id_gambar = '".$_GET['id']."'
				");
			if($update){
				echo "<script>alert('Update success');window.location.href = 'index.php';</script>";
			}else{
				echo 'Update Failed';
			}
		}
	}	
	?>

</body>
</html>