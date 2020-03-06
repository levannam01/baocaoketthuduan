<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Đăng ký</title>
	<link type="text/css" rel="stylesheet" href="style.css">
</head>
<body>
	<form method="POST" enctype="multipart/form-data">
		<table style="margin: auto;">
			<tr>
				<th colspan="2" align="left">Thông tin đăng nhập</th>
			</tr>
			<tr>
				<td>Chọn tên đăng nhập</td>
				<td><input type="text" name="username"></td>
			</tr>
			<tr>
				<td>Mật khẩu</td>
				<td><input type="password" name="pass"></td>
			</tr>
			<tr>
				<td>Nhập lại mật khẩu</td>
				<td><input type="password" name="passr" placeholder="Phải khớp với mật khẩu"></td>
			</tr>
			<tr>
				<td>Ảnh Avatar</td>
				<td><input type="file" name="avatar"></td>
			</tr>
			<tr>
				<th colspan="2" align="left">Thông tin cá nhân</th>
			</tr>
			<tr>
				<td>Họ và Tên</td>
				<td><input type="text" name="name"></td>
			</tr>
			<tr>
				<td>Địa chỉ email</td>
				<td><input type="email" name="email"></td>
			</tr>
			<tr>
				<td>Giới tính</td>
				<td><input type="radio" value="Nam" name="gioitinh">Nam <input type="radio" value="Nữ" name="gioitinh">Nữ</td>
			</tr>
			<tr>
				<td>Ngày sinh</td>
				<td>Ngày <input type="text" name="ngaysinh" size="3">Tháng <input type="text" name="thangsinh" size="3">Năm <input type="text" name="namsinh" size="5"> </td>
			</tr>
			<tr>
				<td>Nơi ở</td>
				<td>
					<select name="noio">
						<option value="">Chọn tỉnh</option>
						<option value="Bắc Ninh">Bắc Ninh</option>
						<option value="Hải Dương">Hải Dương</option>
						<option value="Hải Phòng">Hải Phòng</option>
						<option value="Tp.Hà Nội">Tp.Hà Nội</option>
						<option value="Tp.Hồ Chí Minh">Tp.Hồ Chí Minh</option>
					</select>
				</td>
			</tr>
			<tr>
				<td colspan="2" align="center"><input class="btn btn-sua btn-sm btn-small" type="submit" name="submit" value="Đăng ký"> <br><a class="btn btn-xoa btn-sm btn-small" href="login.php" title="Đăng nhập">Bạn đã có tài khoản ?</a></td>
			</tr>
		</table>
		<?php
		require_once'connect.php';
		if (isset($_POST['submit'])) {
			$user=$_POST['username'];
			$pass=$_POST['pass'];
			$passr=$_POST['passr'];
			$a=$_FILES['avatar']['tmp_name'];
			$b="Avatar/".$_FILES['avatar']['name'];
			$up=move_uploaded_file($a, $b);
			$fullname=$_POST['name'];
			$email=$_POST['email'];
			$gioitinh=$_POST['gioitinh'];
			$ngaysinh=$_POST['ngaysinh'];
			$thangsinh=$_POST['thangsinh'];
			$namsinh=$_POST['namsinh'];
			$noio=$_POST['noio'];
			if ($user!="" && $pass!="" && $passr!="" && $pass==$passr &&  $fullname!="" && $email!="" && $ngaysinh!="" && $gioitinh!="" && $thangsinh!="" && $namsinh!="" && $noio!="") {
				$sql="INSERT INTO dkthamgia(user,pass,avatar,fullname,email,gioitinh,ngaysinh,thangsinh,namsinh,noio) 
				VALUES('$user','$pass','$b','$fullname','$email','$gioitinh','$ngaysinh','$thangsinh','$namsinh','$noio')";
				$q=mysqli_query($con,$sql); 
				if ($q) {
					echo "<script> alert('Thêm dữ liệu thành công!')</script>";
					header("location:index.php");
				} else {
					echo "<script> alert('Khong Thanh cong')</script>";
				}
			}else {echo "Nhập đầy đủ thông tin va mật khẩu phải khớp nhau";}	 
		}
	?>
	</form>
</body>
</html>