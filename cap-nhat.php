<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Cập nhật sản phẩm</title>
	<link type="text/css" rel="stylesheet" href="style.css">
</head>
<body>
	<?php 	
		require_once'connect.php';
		$ma = $_GET['id'];
		$sql = "SELECT * FROM sanpham WHERE code= '$ma'";
		$data = mysqli_query($con, $sql);
		$sp = mysqli_fetch_array($data);
	 ?>
	<form method="POST" enctype="multipart/form-data">
		<table style="margin: auto;">
			<tr>
				<td>Mã sản phẩm</td>
				<td><input type="text" name="code" value="<?php echo $sp['code']; ?>"></td>
			</tr>
			<tr>
				<td>Tên sản phẩm</td>
				<td><input type="text" name="name" value="<?php echo $sp['name']; ?>"></td>
			</tr>
			<tr>
				<td>Giá sản phẩm</td>
				<td><input type="text" name="price" value="<?php echo $sp['price']; ?>"></td>
			</tr>
			<tr>
				<td>Loại sản phẩm</td>
				<td><input type="text" name="category" value="<?php echo $sp['category']; ?>"></td>
			</tr>
			<tr>
				<td>Ảnh mô tả</td>
				<td><input type="file" name="image"></td>
			</tr>
			<tr>
				<td>Số lượng sản phẩm</td>
				<td><input type="text" name="quanlity" value="<?php echo $sp['quanlity']; ?>"></td>
			</tr>
			<tr>
				<td colspan="2" align="center"><a class="btn-right btn btn-xoa btn-sm btn-small" href="index.php">Quay lại</a> <input class="btn btn-sua btn-sm btn-small" type="submit" name="submit" value="Cập nhập"></td>
			</tr>
		</table>
		<?php
		if (isset($_POST['submit'])) {
			$code=$_POST['code'];
			$name=$_POST['name'];
			$price=$_POST['price'];
			$a=$_FILES['image']['tmp_name'];
			$b="image/".$_FILES['image']['name'];
			$up=move_uploaded_file($a, $b);
			if ($up) {
				$update_avatar = "UPDATE sanpham SET image='$b' WHERE code= '$ma'";
				mysqli_query($con, $update_avatar);
			}
			$category=$_POST['category'];
			$quanlity=$_POST['quanlity'];
			//if ($user!="" && $pass!="" && $passr!="" && $pass==$passr &&  $fullname!="" && $email!="" && $ngaysinh!="" && $gioitinh!="" && $thangsinh!="" && $namsinh!="" && $noio!="") {
				$sql = "UPDATE sanpham SET code='$code', name='$name', price='$price', category='$category', quanlity='$quanlity' WHERE code= '$ma'";
				$q=mysqli_query($con,$sql); 
				if ($q) {
					echo "<script> alert('Cập nhật dữ liệu thành công!')</script>";
					header("location:index.php");
				} else {
					echo "<script> alert('Khong Thanh cong')</script>";
				}
			//}else {echo "Nhập đầy đủ thông tin va mật khẩu phải khớp nhau";}	 
		}
	?>
	</form>
</body>
</html>