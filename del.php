
<?php 
	require_once'connect.php';
	$id=$_GET['id'];
	$sql = "DELETE FROM sanpham WHERE code = '$id'";
	$data = mysqli_query($con, $sql);
	if ($data) {
		echo "<script> alert('Xoá Thành Công!')</script>";
		echo "<script>window.location='index.php'</script>";
	}
	else echo "Không Thành Công";
?>