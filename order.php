<?php 
	include 'components/connect.php';

	if (isset($_COOKIE['user_id'])) {
		$user_id = $_COOKIE['user_id'];
	}else {
		$user_id = '';
        header('location:login.php');
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
            <h1>my orders</h1>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. At, omnis facere earum vitae pariatur <br>eveniet minima rerum, natus molestiae nulla nostrum tenetur ea. Quasi.</p>
            <span><a href="home.php">home</a><i class="bx bx-right-arrow-alt"></i>my orders</span>
        </div>
    </div>
    <div class="line2"></div>

    <div class="orders">
        <div class="heading">
            <h1>my orders</h1>
            <img src="image/separator.png" alt="">
        </div>
        <div class="box-container">
            <?php
                $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ?");
                $select_orders->execute([$user_id]);

                if ($select_orders->rowCount() > 0) {
                    while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)) {
                        $product_id = $fetch_orders['product_id'];
                        $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
                        $select_products->execute([$fetch_orders['product_id']]);

                        if ($select_products->rowCount() > 0) {
                            while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
                                

            ?>
            <div class="box">
                <a href="view_order.php?get_id=<?= $fetch_orders['id']; ?>">
                    <div class="icon">
                        <div class="icon-box">
                            <img src="image/products/<?= $fetch_products['thumb_one']; ?>" alt="" class="img1">
                            <img src="image/products/<?= $fetch_products['thumb_two']; ?>" alt="" class="img2">
                        </div>
                    </div>
                    <div class="content">
                        <p class="date"><i class="bx bxs-calender-alt"></i><span><?= $fetch_orders['date']; ?></span></p>
                        <div class="row">
                            <h3 class="name"><?= $fetch_products['name']; ?></h3>
                            <p class="price">$<?= $fetch_products['price']; ?>/-</p>
                            <p class="status" style="color:<?php if($fetch_orders['status']=='delivered'){echo "green";}elseif($fetch_orders['status']=='canceled'){echo "red";}else{echo "orange";} ?>"><?= $fetch_orders['status']; ?></p>
                        </div>
                    </div>
                </a>
            </div>
            <?php
                            }  
                        }
                    }
                }else{
                    echo '
                        <div class="empty">
                            <p>no order take placed yet!</p>
                        </div>
                    ';
                }
            ?>
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