<?php
	$conn = mysqli_connect('localhost', 'root', '', 'user-registration') or die($conn);
	$delete = mysqli_query($conn, "DELETE FROM tb_gambar WHERE id_gambar = '".$_GET['id']."'");
	if ($delete){
		echo "<script>alert('Delete success');window.location.href = 'index.php';</script>";
	}else{
		echo "Failed to delete";
	}
?>