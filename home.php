<?php 
	include 'components/connect.php';

	if (isset($_COOKIE['user_id'])) {
		$user_id = $_COOKIE['user_id'];
	}else {
		$user_id = '';
	}

	include 'components/add_wishlist.php';
	include 'components/add_cart.php';
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- box icon cdn link  -->
	<link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <!------------------------bootstrap icon link------------------------------->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <!------------------------bootstrap css link------------------------------->
    <!------------------------slick slider link------------------------------->
    <link rel="stylesheet" type="text/css" href="slick.css" />
   	<link rel="stylesheet" type="text/css" href="css/user_style.css?v=<?php echo time(); ?>">
	<title>Bedesk Londan Fashion Website Template</title>
</head>
<body>
	
	<?php include 'components/user_header.php'; ?>


	<div class="container-fluid">
		<div class="hero-slider">
			<div class="slider-item">
				<img src="image/home-slide.jpg" alt="">
				<div class="slider-caption">
					<h1>Street style has its <br> own rules</h1>
					<p>Lorem ipsum dolor sit, amet consectetur adipisicing <br> elit. Architecto facilis beatae error animi dicta <br> sit doloribus, ipsum nam quae est?</p>
				<a href="shop.php" class="btn">Shop now</a>
				</div>
			</div>
			<div class="slider-item">
				<img src="image/home-slide0.jpg" alt="">
				<div class="slider-caption">
					<h1>Street style has its <br> own rules</h1>
					<p>Lorem ipsum dolor sit, amet consectetur adipisicing <br> elit. Architecto facilis beatae error animi dicta <br> sit doloribus, ipsum nam quae est?</p>
				<a href="shop.php" class="btn">Shop now</a>
				</div>
			</div>
			<div class="slider-item">
				<img src="image/home-slide1.jpg" alt="">
				<div class="slider-caption">
					<h1>Brand and Designer <br> Features</h1>
					<p>Lorem ipsum dolor sit, amet consectetur adipisicing <br> elit. Architecto facilis beatae error animi dicta <br> sit doloribus, ipsum nam quae est?</p>
				<a href="shop.php" class="btn">Shop now</a>
				</div>
			</div>
			<div class="slider-item">
				<img src="image/home-slide2.jpg" alt="">
				<div class="slider-caption">
					<h1>Street style has its <br> own rules</h1>
					<p>Lorem ipsum dolor sit, amet consectetur adipisicing <br> elit. Architecto facilis beatae error animi dicta <br> sit doloribus, ipsum nam quae est?</p>
				<a href="shop.php" class="btn">Shop now</a>
				</div>
			</div>
		</div>
		<div class="controls">
			<i class="bx bx-left-arrow-alt prev"></i>
			<i class="bx bx-right-arrow-alt next"></i>
		</div>
	</div>

	<div class="services">
		<div class="box-container">
			<div class="box">
				<div class="icon">
					<img src="image/service.png" alt="">
				</div>
				<div class="detail">
					<h4>online shopping</h4>
					<span>100% secure</span>
				</div>
			</div>
			<div class="box">
				<div class="icon">
					<img src="image/services2.png" alt="">
				</div>
				<div class="detail">
					<h4>Quality products</h4>
					<span>100% secure</span>
				</div>
			</div>
			<div class="box">
				<div class="icon">
					<img src="image/services.png" alt="">
				</div>
				<div class="detail">
					<h4>Delivery</h4>
					<span>24 * 7 hours</span>
				</div>
			</div>
			<div class="box">
				<div class="icon">
					<img src="image/services0.png" alt="">
				</div>
				<div class="detail">
					<h4>Customer services</h4>
					<span>support gift services</span>
				</div>
			</div>
			<div class="box">
				<div class="icon">
					<img src="image/service.png" alt="">
				</div>
				<div class="detail">
					<h4>Well organized</h4>
					<span>24 * 7 free returns</span>
				</div>
			</div>
			<div class="box">
				<div class="icon">
					<img src="image/services1.png" alt="">
				</div>
				<div class="detail">
					<h4>Much more</h4>
					<span>support gift services</span>
				</div>
			</div>
		</div>
	</div>
	<img src="image/-sub-banner.jpg" alt="" class="sub-banner">

	<div class="frame-container">
		<div class="box-container">
			<div class="frame">
				<div class="detail">
					<span>Shop seasonal</span>
					<h2>50% off</h2>
					<h1>all seasonal fashion</h1>
					<a href="shop.php" class="btn">Shop now</a>
				</div>
			</div>
			<div class="box">
				<div class="box-detail">
					<img src="image/lookbook4.jpg" alt="" class="img">
					<div class="img-detail">
						<span>Wide range</span>
						<h1>fresh letest collections</h1>
						<a href="shop.php" class="btn">Shop now</a>
					</div>
				</div>
				<div class="box-detail">
					<img src="image/lookbook5.jpg" alt="" class="img">
					<div class="img-detail">
						<span>Wide range</span>
						<h1>fresh letest collections</h1>
						<a href="shop.php" class="btn">Shop now</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="about-us">
		<div class="box-container">
			<div class="img-box"></div>
			<div class="box">
				<div class="heading">
					<span>Why choose us</span>
					<h1>Why Bedsek london fashion website</h1>
					<img src="image/separator.png" alt="">
				</div>
				<p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. In iste illum neque aut provident modi eum quia minima vitae exercitationem amet obcaecati, voluptatem temporibus enim, ducimus ad? Saepe velit ut aut animi iure, nam et, atque, quia esse consectetur dolore. Quos illum voluptatum rem veniam, odit velit quasi, reiciendis consectetur, perspiciatis aspernatur ex iusto laborum? Quas sequi dolorum dolore necessitatibus?Lorem ipsum dolor, sit amet consectetur adipisicing elit. Unde consequuntur ad officiis </p>
				<a href="about.php" class="btn">Know more</a>
				<a href="contact.php" class="btn">Contact us</a>
			</div>
		</div>
	</div>

	<div class="sub-banner">
		<div class="box-container">
			<img src="image/sub-banner1.jpg" alt="">
			<img src="image/sub-banner.jpg" alt="" height="85%">
		</div>
	</div>

	<div class="categories">
		<div class="heading">
			<h1>shop by categoties</h1>
		</div>
		<div class="box-container">
			<div class="box">
				<img src="image/cat.webp" alt="">
			</div>
			<div class="box">
				<img src="image/cat0.webp" alt="">
			</div>
			<div class="box">
				<img src="image/cat1.png" alt="">
			</div>
			<div class="box">
				<img src="image/cat2.webp" alt="">
			</div>
			<div class="box">
				<img src="image/cat3.webp" alt="">
			</div>
			<div class="box">
				<img src="image/cat4.webp" alt="">
			</div>
			<div class="box">
				<img src="image/cat5.webp" alt="">
			</div>
			<div class="box">
				<img src="image/cat6.webp" alt="">
			</div>
			<div class="box">
				<img src="image/cat7.webp" alt="">
			</div>
			<div class="box">
				<img src="image/cat8.avif" alt="">
			</div>
		</div>
	</div>

	<div class="sub-banner">
		<img src="image/sub-banner2.jpg" alt="">
		<img src="image/sub-banner3.jpg" alt="" style="margin-top: -0.4rem;">
	</div>

	<div class="frame-container-2">
		<div class="frame">
			<div class="detail">
				<span>Shop seasonal</span>
				<h2>50% off</h2>
				<h1>all seasonal fashion</h1>
				<a href="shop.php" class="btn">Shop now</a>
			</div>
		</div>
		<div class="box">
			<img src="image/sub-banner4.jpg" alt="">
		</div>
	</div>

	<div class="sub-banner">
		<img src="image/sub-banner5.jpg" alt="">
	</div>

	<div class="gurantee">
		<div class="heading">
			<h1>Our gurantee</h1>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perferendis corporis aut blanditiis rem sunt ex!</p>
			<img src="image/separator.png" alt="">
		</div>
		<div class="box-container con">
			<img src="image/sale3.webp" alt="">
			<img src="image/sale4.jpg" alt="">
			<img src="image/sale6.jpg" alt="">
			<img src="image/sale7.jpg" alt="">
		</div>
	</div>

	<div class="offer-1">
		<div class="detail">
			<h1>special discount for all <br> latest fashion products</h1>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quia possimus ipsa totam doloremque dolore magnam odio nemo quam animi doloribus. In sed corrupti cumque nihil, consectetur inventore accusamus temporibus iste nisi numquam aliquam, iure cum fugiat. Modi sed eos recusandae, aliquam iste iure illo ratione accusamus exercitationem alias deserunt, blanditiis soluta laborum, omnis voluptate ullam quis quidem voluptatem libero similique! Voluptas aliquam nisi at facilis. Blanditiis eaque repellat inventore impedit dolores doloribus assumenda aperiam, officiis molestias maxime eveniet.</p>

			<div class="container">
				<div class="countdown" style="color: #fff">
					<ul>
						<li><span id="days"></span>days</li>
						<li><span id="hours"></span>hours</li>
						<li><span id="minutes"></span>Minutes</li>
						<li><span id="seconds"></span>Seconds</li>
					</ul>
				</div>
			</div>
			<a href="shop.php" class="btn">shop now</a>
		</div>
	</div>

	<div class="products">
		<div class="heading">
			<h1>Our latest collections</h1>
		</div>
		<?php include 'components/homeshop.php'; ?>
	</div>

	<div class="offer-2">
		<div class="detail">
			<h1>We Pride Ourselves On <br> Exceptional fashion design.</h1>
			<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatem dolorem dicta cupiditate excepturi sed pariatur vero quasi commodi non optio odit placeat distinctio eum ex dolor ad recusandae incidunt sunt, eligendi a tenetur quidem aliquid praesentium. Quae hic sunt aliquam recusandae rerum alias architecto, voluptates, asperiores, exercitationem repellendus quod ipsam quaerat officia molestiae unde sint! Non tenetur quis cumque quasi deleniti, eligendi eum perferendis facilis commodi saepe error, officiis libero!</p>

			<a href="shop.php" class="btn">shop now</a>
		</div>
	</div>

	<div class="gurantee">
		<div class="heading">
			<h1>Our gurantee</h1>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perferendis corporis aut blanditiis rem sunt ex!</p>
			<img src="image/separator.png" alt="">
		</div>
		<div class="box-container con">
			<img src="image/sale.webp" alt="">
			<img src="image/sale0.webp" alt="">
			<img src="image/sale1.webp" alt="">
			<img src="image/sale2.webp" alt="">
		</div>
	</div>















	<?php include 'components/user_footer.php'; ?>




	<!-- sweetalert cdn link  -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
	<!-- custom js link  -->
	<script src="jquary.js"></script>
    <script src="slick.js"></script>

    <script type="text/javascript">
        <?php include 'js/script.js' ?>
    </script>
	<!-- alert  -->
	<?php include 'components/alert.php'; ?>
</body>
</html>