<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Đăng nhập</title>
	<link type="text/css" rel="stylesheet" href="style.css">
</head>
<body>
	<form method="POST" enctype="multipart/form-data">
		<table style="margin: auto;width:285px;">
			<tr>
				<th colspan="2">Đăng nhập</th>
			</tr>
			<tr>
				<td>Username</td>
				<td><input type="text" name="username" placeholder="Nhập tài khoản"></td>
			</tr>
			<tr>
				<td>Password</td>
				<td><input type="password" name="pass" placeholder="Nhập mật khẩu"></td>
			</tr>
			<tr>
				<td colspan="2" align="center"><input class="btn btn-sua btn-sm btn-small" type="submit" name="submit" value="Đăng nhập "> <a class="btn btn-xoa btn-sm btn-small" href="register.php" title="Đăng ký">Đăng ký</a></td>
			</tr>
		</table>
		<?php
		require_once'connect.php';
		session_start();
		if (isset($_SESSION['fullname'])) {header("location:index.php");}
		if (isset($_POST['submit'])) {
			$user=$_POST['username'];
			$pass=$_POST['pass'];
			$sql = "SELECT id, user, pass, avatar, chucvu, fullname FROM dkthamgia WHERE user='$user' and pass='$pass'";
			$data = mysqli_query($con, $sql);
			if (mysqli_num_rows($data) == 1){
				$row = mysqli_fetch_array($data);
				$_SESSION['id'] = $row["id"];
				$_SESSION['style']=1;
				$_SESSION['fullname'] = $row["fullname"];
				$_SESSION['chucvu'] = $row["chucvu"];
				$_SESSION['name'] = $row["user"];
				$_SESSION['avatar'] = $row["avatar"];
				echo "<script> alert('Đăng nhập thành công!')</script>";
				header("location:index.php");}
				 else {echo "<script> alert('Tài khoản hoặc mật khẩu không chính xác')</script>";}
			 }
	?>
	</form>
</body>
</html>
 