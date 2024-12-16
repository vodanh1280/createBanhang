<?php 
	include 'components/connect.php';

	if (isset($_COOKIE['user_id'])) {
		$user_id = $_COOKIE['user_id'];
	}else {
		$user_id = '';
	}
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- box icon cdn link  -->
   	<link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
   	
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

    <div class="banner">
        <div class="detail">
            <h1>about us</h1>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. At, omnis facere earum vitae pariatur <br>eveniet minima rerum, natus molestiae nulla nostrum tenetur ea. Quasi.</p>
            <span><a href="dashboard.php">home</a><i class="bx bx-right-arrow-alt"></i>about us</span>
        </div>
    </div>
    <div class="line2"></div>

    <div class="who">
        <div class="box-container">
            <div class="box">
                <div class="heading">
                    <span>who we are</span>
                    <h1>We are passionate about making beautiful more beautiful</h1>
                    <img src="image/separator.png" alt="">
                </div>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Tempore hic quod debitis quas placeat, sit veritatis amet nihil vero pariatur consectetur exercitationem rerum officiis dolorem odio! Consectetur quisquam laboriosam aperiam incidunt tempore, commodi dolores quis aut nostrum ratione exercitationem sed. Fugit nisi aspernatur iste, veritatis soluta blanditiis obcaecati dolores aperiam illo perferendis, distinctio non assumenda eos dolorum. Nobis excepturi tenetur omnis voluptates, suscipit, obcaecati temporibus minus, aperiam tempore corrupti beatae!</p>
                <div class="flex-btn">
                    <a href="shop.php" class="btn">explore our shop</a>
                    <a href="shop.php" class="btn">visit our shop</a>
                </div>
            </div>
            <div class="img-box">
                <img src="image/home.jpg" alt="" class="img">
                <img src="image/mask.png" alt="" class="shap">
            </div>
        </div>
    </div>
    <div class="exclusive">
        <div class="detail">
            <h1>exclusive collection <br> summer collection 2024</h1>
            <p>Feel the summer mood with our latest exclusive clothes collection <br> featuring bright colors and hand-painted ornaments!</p>
            <a href="shop.php" class="btn">shop now</a>
        </div>
    </div>
    <div class="cms-banner">
        <div class="box-container">
            <div class="box">
                <img src="image/cms-banner.avif" alt="">
                <div class="detail">
                    <span>get upto 35% discount</span>
                    <h1>on kid's <br> collection</h1>
                    <a href="shop.php" class="btn">shop now</a>
                </div>
            </div>
            <div class="box">
                <img src="image/cms-banner.jpg" alt="">
                <div class="detail">
                    <span>flat 15% discount</span>
                    <h1>on men's <br> collection</h1>
                    <a href="shop.php" class="btn">shop now</a>
                </div>
            </div>
        </div>
    </div>
    <div class="story">
        <div class="box">
            <div class="heading">
                <span style="color: red; text-transform: uppercase; padding-bottom: .5rem;">fresh & latest collection</span>
                <h1>Discount up to 30% for your <br> first purchase.</h1>
                <p style="color: red; text-transform: uppercase; padding-bottom: .5rem;">get 20% off </p>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Doloremque incidunt nulla voluptatum hic laudantium voluptatibus? Odit necessitatibus debitis amet porro harum? Sed facere dolorum voluptate tenetur pariatur nesciunt blanditiis nostrum? Dolor eum debitis corrupti fugit laboriosam delectus et, voluptates nesciunt aspernatur ad quia necessitatibus vero adipisci fuga asperiores eaque modi repellendus voluptas laudantium quasi esse! Similique cupiditate culpa ipsum ad.</p>
                <a href="shop.php" class="btn">our services</a>
            </div>
        </div>
    </div>

    <div class="team">
        <div class="heading">
            <span>our team</span>
            <h1>Quality & Passion with our Services!</h1>
            <img src="image/separator.png" alt="">
        </div>
        <div class="box-container">
            <div class="box">
                <img src="image/team.jpg" alt="" class="img">
                <div class="content">
                    <h2>fiona edwards</h2>
                    <p>fashion designer</p>
                    <div class="icons">
                        <i class="bx bxl-facebook"></i>
                        <i class="bx bxl-instagram-alt"></i>
                        <i class="bx bxl-linkedin"></i>
                        <i class="bx bxl-twitter"></i>
                        <i class="bx bxl-pinterest-alt"></i>
                    </div>
                </div>
            </div>
            <div class="box">
                <img src="image/team0.jpg" alt="" class="img">
                <div class="content">
                    <h2>ralph johnson</h2>
                    <p>fashion designer</p>
                    <div class="icons">
                        <i class="bx bxl-facebook"></i>
                        <i class="bx bxl-instagram-alt"></i>
                        <i class="bx bxl-linkedin"></i>
                        <i class="bx bxl-twitter"></i>
                        <i class="bx bxl-pinterest-alt"></i>
                    </div>
                </div>
            </div>
            <div class="box">
                <img src="image/team1.jpg" alt="" class="img">
                <div class="content">
                    <h2>ralph johnson</h2>
                    <p>fashion designer</p>
                    <div class="icons">
                        <i class="bx bxl-facebook"></i>
                        <i class="bx bxl-instagram-alt"></i>
                        <i class="bx bxl-linkedin"></i>
                        <i class="bx bxl-twitter"></i>
                        <i class="bx bxl-pinterest-alt"></i>
                    </div>
                </div>
            </div>
            <div class="box">
                <img src="image/team2.jpg" alt="" class="img">
                <div class="content">
                    <h2>ralph johnson</h2>
                    <p>fashion manager</p>
                    <div class="icons">
                        <i class="bx bxl-facebook"></i>
                        <i class="bx bxl-instagram-alt"></i>
                        <i class="bx bxl-linkedin"></i>
                        <i class="bx bxl-twitter"></i>
                        <i class="bx bxl-pinterest-alt"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="about">
        <div class="box-container">
            <div class="box">
                <div class="heading">
                    <span>about company</span>
                    <h1>latest & trandy Fashion <br> Provider Website</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veritatis, atque, sunt ipsam recusandae esse ipsum sequi impedit dolorum a error non voluptas quisquam accusantium, odio quam architecto itaque eaque numquam maxime provident nostrum eligendi voluptatibus nesciunt dignissimos. Dolorem soluta dolores cupiditate sunt quam ipsam aperiam rerum molestias inventore, quod est esse, possimus earum illum! Eaque quas ad nihil eos ea dolor soluta aut aspernatur perferendis temporibus.</p>
                    <div class="flex-btn">
                        <a href="shop.php" class="btn">explore products</a>
                        <a href="contact.php" class="btn">any quary contact us</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="choose">
        <div class="box-container">
            <div class="img-box">
                <img src="image/project0.jpg" alt="" class="img">
            </div>
            <div class="box">
                <div class="heading">
                    <span>why choose us</span>
                    <h1>Special Care For Our Every <br> fashion Lovers</h1>
                </div>
                <div class="box-detail">
                    <div class="detail">
                        <img src="image/discount.png" alt="">
                        <h2>discount options</h2>
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit.</p>
                        <span>1</span>
                    </div>
                    <div class="detail">
                        <img src="image/gift.png" alt="">
                        <h2>gift offers</h2>
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit.</p>
                        <span>2</span>
                    </div>
                    <div class="detail">
                        <img src="image/return.png" alt="">
                        <h2>best return policy</h2>
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit.</p>
                        <span>3</span>
                    </div>
                    <div class="detail">
                        <img src="image/support.png" alt="">
                        <h2>online support</h2>
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit.</p>
                        <span>4</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="project">
        <div class="box-container">
            <div class="box">
                <p>Eu feugiat pretium nibh ipsum consequat nisl vel pretium. <br> Quis imperdiet massa tincidunt nunc.</p>
                <img src="image/head.png" alt="">
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Expedita quisquam recusandae, laboriosam odit harum excepturi quod cupiditate praesentium dolores natus est. Incidunt quaerat inventore explicabo excepturi aspernatur nam.</p>
                <a href="" class="btn">learn more</a>
            </div>
            <div class="card"></div>
        </div>
    </div>

    <div class="mission">
        <div class="box-container">
            <div class="box">
                <div class="heading">
                    <span>our mission</span>
                    <h1>latest fashion with big smile</h1>
                    <img src="image/separator.png" alt="">
                </div>
                <div class="detail">
                    <div class="img-box">
                        <img src="image/fashion.png" alt="">
                    </div>
                    <div>
                        <h2>latest fashion</h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi voluptate deserunt dolorem eligendi eum labore sit sed totam, illum ipsum.</p>
                    </div>
                </div>
                <div class="detail">
                    <div class="img-box">
                        <img src="image/delivery.png" alt="">
                    </div>
                    <div>
                        <h2>delivery in 24 hours</h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi voluptate deserunt dolorem eligendi eum labore sit sed totam, illum ipsum.</p>
                    </div>
                </div>
                <div class="detail">
                    <div class="img-box">
                        <img src="image/app.png" alt="">
                    </div>
                    <div>
                        <h2>order online</h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi voluptate deserunt dolorem eligendi eum labore sit sed totam, illum ipsum.</p>
                    </div>
                </div>
                <div class="detail">
                    <div class="img-box">
                        <img src="image/support.png" alt="">
                    </div>
                    <div>
                        <h2>24/7 support</h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi voluptate deserunt dolorem eligendi eum labore sit sed totam, illum ipsum.</p>
                    </div>
                </div>
            </div>
            <div class="box-img"></div>
        </div>
    </div>
    <div class="about-banner">
        <div class="box-container">
            <div class="box">
                <img src="image/about-banner.jpg" alt="">
                <div class="detail">
                    <span>shop seasonal</span>
                    <h2>50% off </h2>
                    <h1>all seasonal women's fashion</h1>
                    <a href="shop.php" class="btn">shop now</a>
                </div>
            </div>
            <div class="box">
                <img src="image/about-banner0.jpg" alt="">
                <div class="detail">
                    <span>shop seasonal</span>
                    <h2>70% off </h2>
                    <h1>all seasonal kid's fashion</h1>
                    <a href="shop.php" class="btn">shop now</a>
                </div>
            </div>
        </div>
    </div>



	<?php include 'components/user_footer.php'; ?>



	<!-- sweetalert cdn link  -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
	

    <script type="text/javascript">
        <?php include 'js/user_script.js' ?>
    </script>
	<!-- alert  -->
	<?php include 'components/alert.php'; ?>
</body>
</html>