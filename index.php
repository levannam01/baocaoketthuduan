<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Danh sách sản phẩm</title>
	<style type="text/css">
		@font-face {
		font-family:Meocoder;
		src: url('https://rawcdn.githack.com/IZmusic/Code/master/SFNSDisplay.ttf');
		font-weight:normal;
		font-style:normal;}
		body{background-color: #f5f5f5;font-family:Meocoder;}
		#table{margin: auto;}
		td{border: 1px solid #f121ce4a;padding: 5px;text-align: center;}
		.image{width: 200px;height: 120px;object-fit: cover;}
		a{text-decoration: none;}
		.btn {display: inline-block;padding-top: 7px;margin-bottom: 0;font-size: 14px;line-height: 20px;color: #5e5e5e;text-align: center;vertical-align: middle;cursor: pointer;background-color: #d1dade;-webkit-border-radius: 3px;background-image: none !important;border: none;text-shadow: none;box-shadow: none;transition: all 0.12s linear 0s !important;font: 14px/20px "Helvetica Neue", Helvetica, Arial, sans-serif;}
		.btn-xoa {color: #ffffff;background-color: #f35958;}
		.btn-sua {color: #ffffff;background-color: #55a1ff;}
		.btn-them {color: #ffffff;background-color: #0aa699;}
		.btn-xoa:hover, .btn-sua:hover, .btn-them:hover {opacity: .8;}
		.btn-small {padding: 3px 12px;font-size: 11.9px;-webkit-border-radius: 3px;-moz-border-radius: 3px;border-radius: 3px;}
		.box-contaier{width: 1000px;margin: auto;}
		.col-phim-1 {margin: 10px;background: #fff;padding: 5px;width: 22%;float: left;border-radius: 5px;}
		.list-box{width: 100%;}
		.img-box-1{height: 225px;position: relative;padding: 0;}
		.img-box-1 img {width: 100%; height: 100%;border-radius: 3px;}
		.crad-info-1{height: 130px;}
		.ten{width: 210px;overflow: hidden;margin: auto;}
		.ten a {width: 210px;font-size: 20px;font-weight: 500;color: #000;display: -webkit-box;-webkit-line-clamp: 2;-webkit-box-orient: vertical;overflow: hidden;line-height: 1.56;margin: 40px 0 5px;text-transform: capitalize;text-decoration: none;}
		.gia{width: 210px;margin: auto;font-size: 15px;font-weight: 500;color: #E41A2EFF;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;overflow: hidden;line-height: 1.56;text-transform: capitalize;text-decoration: none;}
		.head{line-height: 20px;margin: auto;width: 980px;height: 35px;margin-top: 20px;}
		.admin_menu{width: 100%;height: 30px;margin-top: 10px;text-align: center;}
		.btn-right{margin-left: 5px;}
		.btn-left{margin-right: 5px;}
		span.user{margin-right: 10px;font-size: 20px;color: #d63a3a;}
	</style>
	<link  rel="stylesheet" href="http://gelgun.vn/css.php?id=573188">
	<script   type="text/javascript" src="http://gelgun.vn/java/java15.js?v=1"></script>
	<link rel="stylesheet" href="http://gelgun.vn/templates/fontawesome-pro-5.8.1-web/css/all.min.css">  
</head>
<body>
	<?php 
		require_once'connect.php';
		session_start();
		if (isset($_SESSION['chucvu'])) {
			$cv=$_SESSION['chucvu'];
		}else {
			$cv="khach";
		}
		function so($a){return number_format($a, 0, '.', ' .');}
		$sql="SELECT * FROM sanpham";
		$show = mysqli_query($con, $sql);
		?>
		<div class="box-contaier">
			<div class="head">
				<?php 
					if (isset($_SESSION['fullname'])) {
						echo "<span class='user'>". $_SESSION['fullname']."</span>";
						echo "<a class='btn-left btn btn-xoa btn-sm btn-small' href='logout.php'>Đăng xuất</a>";
						echo "<a class='btn btn-sua btn-sm btn-small' href='user-hang.php'>Giỏ hàng</a>";
					}else { ?> 
						<a class="btn btn-xoa btn-sm btn-small" href="register.php" title="Đăng ký">Đăng ký</a> <a class="btn btn-sua btn-sm btn-small" href="login.php" title="Đăng nhập">Đăng nhập</a>
					<?php } ?>
				 
				<?php if ($cv =="admin") {?>
						<a class="btn btn-them btn-sm btn-small" href="them-sp.php">Thêm Sản Phẩm</a>
			    <?php } ?>	
			</div></div>

			<?php require_once('slide.php') ?>

			<div class="box-contaier">
			<?php while ($sp=mysqli_fetch_array($show, MYSQLI_ASSOC)) { ?>
			<div class="col-phim-1">
				<div class="list-box">
					<a href="giohang.php?id=<?php echo $sp['code']; ?>" title=""><div class="img-box-1"><img src="<?php echo $sp['image']; ?>" data-src="<?php echo $sp['image']; ?>"></div></a>
						<div class="crad-info-1"><div class="ten"><a href="giohang.php?id=<?php echo $sp['code']; ?>" title="<?php echo $sp['name']; ?>"><?php echo $sp['name']; ?></a></div>
						<div class="gia"><?php echo so($sp['price']); ?>₫</div></div>
				</div>
				<?php if ($cv=="admin") {?>
					<div class="admin_menu">
						<a class="btn-left btn btn-sua btn-sm btn-small" href="cap-nhat.php?id=<?php echo $sp['code']; ?>">Sửa</a>
			        	<a class="btn-right btn btn-xoa btn-sm btn-small" href="del.php?id=<?php echo $sp['code']; ?>">Xóa</a>
			        </div>
			    <?php } ?>	
			</div>
			<?php } ?>
		</div>

		<?php require_once('footer.php') ?>
</body>
</html>