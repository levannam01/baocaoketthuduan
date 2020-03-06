<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Danh sách giỏ hàng</title>
	<style type="text/css">
		@font-face {
		font-family:Meocoder;
		src: url('http://localhost/Meo_Coder/Font/font.ttf');
		font-weight:normal;
		font-style:normal;}
		body{font-family:Meocoder;font-size: 15px;}
		#table{margin: auto;width: 1000px}
		td{padding: 5px;text-align: center;}
		a{text-decoration: none;}
		tr.tit-bar {height: 50px;-webkit-box-align: center;-webkit-align-items: center-moz-box-align: center-ms-flex-align: center;align-items: center;overflow: hidden;font-size: 16px;background: #3bbf94;text-transform: capitalize;margin-bottom: 12px;color: #fff;}
		tr.san-pham {height: 200px;}
		.btn {display: inline-block;padding-top: 7px;margin-bottom: 0;font-size: 14px;line-height: 20px;color: #5e5e5e;text-align: center;vertical-align: middle;cursor: pointer;background-color: #d1dade;-webkit-border-radius: 3px;background-image: none !important;border: none;text-shadow: none;box-shadow: none;transition: all 0.12s linear 0s !important;font: 14px/20px "Helvetica Neue", Helvetica, Arial, sans-serif;}
		.meocoder_img img{width: 130px;height: 140px;object-fit: cover;}
		td.gia{color:#F30B25FF;}
		.btn-xoa {color: #ffffff;background-color: #f35958;}
		.btn-sua {color: #ffffff;background-color: #55a1ff;}
		.btn-them {color: #ffffff;background-color: #0aa699;}
		.btn-xoa:hover, .btn-sua:hover, .btn-them:hover {opacity: .8;}
		.btn-small {padding: 3px 12px;font-size: 11.9px;-webkit-border-radius: 3px;-moz-border-radius: 3px;border-radius: 3px;}
	</style>
</head>
<body>
	<?php 
		require_once'connect.php';
		session_start();
		$user1 = $_SESSION['name'];
		function so($a){return number_format($a, 0, '.', ' .');}
		$ma = $_GET['id'];
		$sql="SELECT * FROM sanpham WHERE code ='$ma'";
		$show = mysqli_query($con, $sql);
		?>
	<form method="POST">
	 <table id="table" cellpadding="0" cellspacing="0">
	 	<tr class="tit-bar">
	 		<td class="meocoder_img">Ảnh mô tả</td>
	 		<td>Mã sản phẩm</td>
	 		<td class="meocoder_name">Tên sản phẩm</td>
	 		<td>Giá sản phẩm</td>
	 		<td>Loại sản phẩm</td>
	 		<td>Số lượng sản phẩm</td>
	 		<td>Chọn</td>

	 	</tr>
	 	<?php while ($sp=mysqli_fetch_array($show)) { ?>
	 	<tr class="san-pham">
	 		<td class="meocoder_img"><img class="image" src="<?php echo $sp['image']; ?>" alt=""></td>	 		
	 		<td><?php echo $sp['code']; ?></td>
	 		<td class="meocoder_name"><?php echo $sp['name']; ?></td>
	 		<td><?php echo so($sp['price']); ?></td>
	 		<td value="<?php echo $sp['category']; ?>"></td>
	 		<td>
	 			<input type="text" name="quanlity" value="<?php if(isset($_POST['update'])) {if($_POST['quanlity'] <= $sp['quanlity']){echo $_POST['quanlity'];} else{echo "không đủ hàng";}} else{echo"1";} ?>">
				<br><?php if(isset($_POST['update'])) { if($_POST['quanlity'] <= $sp['quanlity']){echo "SL còn lại:".($sp['quanlity']-$_POST['quanlity']);}else{echo"";}} ?>
	 		</td>
	 		<td><input type="submit" class="btn btn-sua btn-sm btn-small" name="update" value="Cập nhật"></td>
	 	</tr>
	 	<tr>
	 		<td colspan="5"> TỔNG GIÁ</td>
	 		<td colspan="2" class="gia"><?php if(isset($_POST['update'])) {if ($_POST['quanlity'] <= $sp['quanlity']) {echo so(($tongtien=$_POST['quanlity']*$sp['price']));} else{echo '0';}}else{echo so($tongtien=$sp['price']);} ?> VNĐ</td>
	 	</tr>
	 	<tr>
	 		<td colspan="7"><a class="btn btn-xoa btn-sm btn-small" href="index.php" title="Quay lại">Quay lại</a> <input type="submit" class="btn btn-them btn-sm btn-small" name="mua" value="Thêm"></td>
	 	</tr>
	 	<?php } ?>
	 </table>
	</form>
	<?php 
		if (isset($_POST['mua'])) {
		$sql1="SELECT * FROM sanpham WHERE code ='$ma'";
		$show1 = mysqli_query($con, $sql1);
		$sp1=mysqli_fetch_array($show1);
			$code=$sp1['code'];
			$name=$sp1['name'];
			$price=$sp1['price'];
			$tongtien = ($price*$_POST['quanlity']);
			$b = $sp1['image'];
			$category=$sp1['category'];
			$quanlity=$_POST['quanlity'];
			//if ($user!="" && $pass!="" && $passr!="" && $pass==$passr &&  $fullname!="" && $email!="" && $ngaysinh!="" && $gioitinh!="" && $thangsinh!="" && $namsinh!="" && $noio!="") {
				$sql1="INSERT INTO giohang(code,name,price,image,category,quanlity,tongtien,user) 
				VALUES('$code','$name','$price','$b','$category','$quanlity','$tongtien','$user1')";
				$q=mysqli_query($con,$sql1); 
				if ($q) {
					echo "<script> alert('Thêm dữ liệu thành công!')</script>";
					header("location:user-hang.php");
				} else {
					echo "<script> alert('Khong Thanh cong')</script>";
				}
			//}else {echo "Nhập đầy đủ thông tin va mật khẩu phải khớp nhau";}	 
		}
	 ?>
</body>
</html>