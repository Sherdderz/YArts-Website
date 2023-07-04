<?php
	$conn = mysqli_connect('localhost', 'root', '', 'user-registration') or die($conn);
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css">
	<title>Upload Your Image</title>
</head>
<body>

	<div class="upload-title">
	<h1>Upload your image here!</h1>
	</div>




<div class="upload-form">
	<form id="upload-form" method="post" action="" enctype="multipart/form-data">
	<input class="upload-control" placeholder="Author" type="text" name="author" required><br>
	<input class="upload-control" placeholder="Image Title" type="text" name="judul" required><br>
	<input class="upload-control" placeholder="Image" type="file" name="gambar" required><br>
	<input class="upload-control submit" type="submit" name="kirim" value="Upload" />
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

		move_uploaded_file($source, $folder.$nama_file);
		$insert = mysqli_query($conn, "INSERT INTO tb_gambar VALUES (
			NULL,
			'$author',
			'$judul', 
			'$nama_file')");

		if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
			
			if($insert){
				echo "<script>alert('Upload success');window.location.href = 'index.php';</script>";
			}else{
				echo 'Failed to upload';
			}
		}else{
			echo 'Failed to upload';
		}
	}
?>

</body>
</html>