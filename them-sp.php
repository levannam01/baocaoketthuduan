<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Thêm sản phẩm</title>
	<link type="text/css" rel="stylesheet" href="style.css">
</head>
<body>
	<form method="POST" enctype="multipart/form-data">
		<table style="margin: auto;">
			<tr>
				<td>Mã sản phẩm</td>
				<td><input type="text" name="code"></td>
			</tr>
			<tr>
				<td>Tên sản phẩm</td>
				<td><input type="text" name="name"></td>
			</tr>
			<tr>
				<td>Giá sản phẩm</td>
				<td><input type="text" name="price"></td>
			</tr>
			<tr>
				<td>Loại sản phẩm</td>
				<td><input type="text" name="category"></td>
			</tr>
			<tr>
				<td>Ảnh mô tả</td>
				<td><input type="file" name="image"></td>
			</tr>
			<tr>
				<td>Số lượng sản phẩm</td>
				<td><input type="text" name="quanlity"></td>
			</tr>
			<tr>
				<td colspan="2" align="center"><a class="btn-right btn btn-xoa btn-sm btn-small" href="index.php">Quay lại</a> <input class="btn btn-sua btn-sm btn-small" type="submit" name="submit" value="Nhập"></td>
			</tr>
		</table>
		<?php
		require_once'connect.php';
		if (isset($_POST['submit'])) {
			$code=$_POST['code'];
			$name=$_POST['name'];
			$price=$_POST['price'];
			$a=$_FILES['image']['tmp_name'];
			$b="image/".$_FILES['image']['name'];
			$up=move_uploaded_file($a, $b);
			$category=$_POST['category'];
			$quanlity=$_POST['quanlity'];
			//if ($user!="" && $pass!="" && $passr!="" && $pass==$passr &&  $fullname!="" && $email!="" && $ngaysinh!="" && $gioitinh!="" && $thangsinh!="" && $namsinh!="" && $noio!="") {
				$sql="INSERT INTO sanpham(code,name,price,image,category,quanlity) 
				VALUES('$code','$name','$price','$b','$category','$quanlity')";
				$q=mysqli_query($con,$sql); 
				if ($q) {
					echo "<script> alert('Thêm dữ liệu thành công!')</script>";
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