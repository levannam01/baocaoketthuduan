<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Cập nhật dữ liệu</title>
	<link type="text/css" rel="stylesheet" href="style.css">
	<style type="text/css">
		table.info {margin: auto;width:405px;background: #fff;}
		a{text-decoration: none;}
		.avatar {width: 50px; height: 50px; border-radius:50%;}
		.name_ad{float: left;margin-left: 15px;color: #1ebd8a;font-size: 25px;position: relative;}
		a.info{float: left;font-size: 12px;margin-left: 14px;color: #2a6dd2;font-weight: 400;margin-bottom: 5px;line-height: 20px;}
		span.cv{color: #66339a;right: -45px;position: absolute;font-size: 9px;font-weight: 400;text-transform: uppercase;top: 5px;}
	</style>
</head>
<body>
<?php 
	require_once'connect.php';
	session_start();
	if (empty($_SESSION['fullname'])) {header("location:index.php");}
	$id=$_GET['id'];
	if (isset($_SESSION['trang'])) {
		$t = $_SESSION['trang'];
	}
	$sql = "SELECT * FROM dkthamgia WHERE id= '$id'";
	$data = mysqli_query($con, $sql);
	$row = mysqli_fetch_array($data);
	$check=$row["noio"];
	$check_cv=$row["chucvu"];
?>
	<table class="info">
		<?php 
			if (isset($_SESSION['fullname']))
            		{echo "
            			<tr>
							<td width='50px' rowspan='2'><img src='" . $_SESSION['avatar'] . "'class='avatar'></td>
							<td class='name_ad'>"./* $_SESSION['name'] .*/ $_SESSION['fullname'] ."<span class='cv'>". $_SESSION['chucvu'] ."</span></td>
						</tr>
						<tr>
							<td><a style='color:#ec2d82' name='logout' class='info' href='logout.php'>Đăng xuất</a> </td>
						</tr>";}
		 ?>
	</table>
	<form method="POST" enctype="multipart/form-data">
		<table style="margin: auto;">
			<tr>
				<th colspan="2" align="left">Thông tin đăng nhập</th>
			</tr>
			<tr>
				<td>Chọn tên đăng nhập</td>
				<td><input type="text" name="username" value="<?php echo $row['user'];?>"></td>
			</tr>
			<tr>
				<td>Mật khẩu</td>
				<td><input type="password" name="pass"></td>
			</tr>
			<tr>
				<td>Nhập lại mật khẩu</td>
				<td><input type="password" name="passr"></td>
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
				<td><input type="text" name="name" value="<?php echo $row['fullname'];?>"></td>
			</tr>
			<tr>
				<td>Địa chỉ email</td>
				<td><input type="email" name="email" value="<?php echo $row['email'];?>"></td>
			</tr>
			<tr>
				<td>Giới tính</td>
				<td>
					<?php 
						if ($row["gioitinh"]=="Nam") {
							echo "<input type='radio' value='Nam' name='gioitinh' checked>Nam <input type='radio' value='Nữ' name='gioitinh'>Nữ";
						}else{
							echo "<input type='radio' value='Nam' name='gioitinh'>Nam <input type='radio' value='Nữ' name='gioitinh' checked>Nữ";
						}
					 ?>
					 </td>
			</tr>
			<tr>
				<td>Ngày sinh</td>
				<td>Ngày <input type="text" name="ngaysinh" size="3" value="<?php echo $row['ngaysinh'];?>">Tháng <input type="text" name="thangsinh" size="3" value="<?php echo $row['thangsinh'];?>">Năm <input type="text" name="namsinh" size="5" value="<?php echo $row['namsinh'];?>"> </td>
			</tr>
			<tr>
				<td>Nơi ở</td>
				<td>	
					<select name="noio">
						<option value="">Chọn tỉnh</option>
						<option value="Bắc Ninh" <?php if ($check=='Bắc Ninh') {echo 'selected';} ?>>Bắc Ninh</option>
						<option value="Hải Dương" <?php if ($check=='Hải Dương') {echo 'selected';} ?>>Hải Dương</option>
						<option value="Hải Phòng" <?php if ($check=='Hải Phòng') {echo 'selected';} ?>>Hải Phòng</option>
						<option value="Tp.Hà Nội" <?php if ($check=='Tp.Hà Nội') {echo 'selected';} ?>>Tp.Hà Nội</option>
						<option value="Tp.Hồ Chí Minh" <?php if ($check=='Tp.Hồ Chí Minh') {echo 'selected';} ?>>Tp.Hồ Chí Minh</option>	
					</select>
				</td>
			</tr>
			<tr>
				<?php 
					if ($_SESSION['chucvu']=="admin") { ?>
						<td>Chức vụ</td>
						<td>	
							<select name="chucvu">
								<option value="">Chọn chức vụ</option>
								<option value="admin" <?php if ($check_cv=='admin') {echo 'selected';} ?>>Quản trị viên</option>
								<option value="member" <?php if ($check_cv=='member') {echo 'selected';} ?>>Thành viên</option>
							</select>
						</td>
				<?php } ?>
			</tr>
			<tr>
				<td colspan="2" align="center"><a class="btn btn-xoa btn-sm btn-small" href="<?php if (isset($_SESSION['trang'])) {echo'data-new.php?page='.$t;}else{echo'data.php';} ?>" title="Huỷ">Quay lại</a> 
					<?php 
					if ($_SESSION['chucvu']=="admin") { ?><input class='btn btn-sua btn-sm btn-small' type="submit" name="update" value="Update"> <?php } ?></td>
			</tr>
		</table>
	</form>
	<?php 
		if (isset($_POST['update'])) {
			$user=$_POST['username'];
			$pass=$_POST['pass'];
			$passr=$_POST['passr'];
			if ($pass!="") {
				$update_pass = "UPDATE dkthamgia SET pass='$pass' WHERE id=$id";
				mysqli_query($con, $update_pass);
			}
			$a=$_FILES['avatar']['tmp_name'];
			$b="Avatar/".$_FILES['avatar']['name'];
			$up=move_uploaded_file($a, $b);
			if ($up) {
				$update_avatar = "UPDATE dkthamgia SET avatar='$b' WHERE id=$id";
				mysqli_query($con, $update_avatar);
			}
			$fullname=$_POST['name'];
			$email=$_POST['email'];
			$gioitinh=$_POST['gioitinh'];
			$ngaysinh=$_POST['ngaysinh'];
			$thangsinh=$_POST['thangsinh'];
			$namsinh=$_POST['namsinh'];
			$noio=$_POST['noio'];
			$chucvu=$_POST['chucvu'];
			if ($pass==$passr){
				$update = "UPDATE dkthamgia SET user='$user', fullname='$fullname',email='$email', gioitinh='$gioitinh',
			ngaysinh='$ngaysinh', thangsinh='$thangsinh', namsinh='$namsinh', noio='$noio', chucvu='$chucvu' WHERE id=$id";
				$ttupdate=mysqli_query($con, $update);
				if ($ttupdate) {
				echo "<script> alert('Cập nhập dữ liệu thành !')</script>";
				if ($_SESSION['style']==2) {
					if (isset($_SESSION['trang'])) {header("location:data-new.php?page=$t");}
				}else{header("location:data.php");}
				} else {
				echo "<script> alert('Khong Thanh cong')</script>";
			}
			}else{echo "<span align='center'>Mật khẩu không khớp :(( Chú ý nhận mật khẩu phải khớp nhau</span>";}
			
		}
	 ?>
</body>
</html>