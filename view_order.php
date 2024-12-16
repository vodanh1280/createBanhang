<?php 
	include 'components/connect.php';

	if (isset($_COOKIE['user_id'])) {
		$user_id = $_COOKIE['user_id'];
	}else {
		$user_id = '';
        header('location:login.php');
	}

    if (isset($_GET['get_id'])) {
        $get_id = $_GET['get_id'];
    }else {
        $get_id = '';
        header('location:order.php');
    }

    if (isset($_POST['canceled'])) {
        $update_order = $conn->prepare("UPDATE `orders` SET status = ? WHERE id = ?");
        $update_order->execute(['canceled', $get_id]);
        header('location:order.php');
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
            <h1>order details</h1>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. At, omnis facere earum vitae pariatur <br>eveniet minima rerum, natus molestiae nulla nostrum tenetur ea. Quasi.</p>
            <span><a href="home.php">home</a><i class="bx bx-right-arrow-alt"></i>order details</span>
        </div>
    </div>
    <div class="line2"></div>
    <div class="heading">
        <h1>order details</h1>
        <img src="image/separator.png" alt="">
    </div>
    <div class="view_order">
        
        <div class="box-container">
            <?php
                $grand_total = 0;

                $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE id = ? LIMIT 1");
                $select_orders->execute([$get_id]);

                if ($select_orders->rowCount() > 0) {
                    while ($fetch_order = $select_orders->fetch(PDO::FETCH_ASSOC)) {
                        $select_product = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
                        $select_product->execute([$fetch_order['product_id']]);

                        if ($select_product->rowCount() > 0) {
                            while ($fetch_product = $select_product->fetch(PDO::FETCH_ASSOC)) {
                                $sub_total = ($fetch_order['price']*$fetch_order['qty']);
                                $grand_total += $sub_total;
                            
            ?>
            <div class="box">
                <div class="col">
                    <div class="product_Slider">
                        <div>
                            <img id="featuredImage" src="image/products/<?= $fetch_product['thumb_one'] ?>" class="Slider-featuredImage" alt="">
                        </div>
                        <div class="Slider-thumbnails">
                            <a href="image/products/<?= $fetch_product['thumb_one'] ?>" class="Slider-thumbnail active">
                                <img src="image/products/<?= $fetch_product['thumb_one'] ?>" alt="">
                            </a>
                            <a href="image/products/<?= $fetch_product['thumb_two'] ?>" class="Slider-thumbnail">
                                <img src="image/products/<?= $fetch_product['thumb_two'] ?>" alt="">
                            </a>
                            <a href="image/products/<?= $fetch_product['thumb_three'] ?>" class="Slider-thumbnail">
                                <img src="image/products/<?= $fetch_product['thumb_three'] ?>" alt="">
                            </a>
                        </div>
                    </div>
                    <p class="date"><i class="bx bxs-calender-alt"></i><span><?= $fetch_order['date']; ?></span></p>
                    <div class="detail">
                        <p class="price">$<?= $fetch_product['price'] ?> X <?= $fetch_order['qty'] ?></p>
                        <p class="name"><?= $fetch_product['name'] ?></p>
                        <p class="grand-total">total amount payable : <span>$<?= $grand_total; ?>/-</span></p>
                    </div>
                </div>
                <div class="col">
                    <p class="title">billing address</p>
                    <p class="user"><i class="bx bxs-user-rectangle"></i><?= $fetch_order['name'] ?></p>
                    <p class="user"><i class="bx bxs-phone-outgoing"></i><?= $fetch_order['number'] ?></p>
                    <p class="user"><i class="bx bxs-envelope"></i><?= $fetch_order['email'] ?></p>
                    <p class="user"><i class="bx bxs-map-alt"></i><?= $fetch_order['address'] ?></p>
                    <p class="title">status</p>
                    <p class="status" style="color:<?php if($fetch_order['status']=='delivered'){echo "green";}elseif($fetch_order['status']=='canceled'){echo "red";}else{echo "orange";} ?>"><?= $fetch_order['status'] ?></p>
                    <?php if($fetch_order['status']=='canceled'){ ?>
                        <a href="checkout.php?get_id=<?= $fetch_product['id']; ?>" class="btn">order again</a>
                    <?php }else{ ?>
                        <form action="" method="post">
                            <button type="submit" name="canceled" class="btn" onclick="return confirm('do you want to canceled this product');">canceled</button>
                        </form>
                    <?php } ?>
                </div>
            </div>
            <?php
                            }
                        }
                    }
                }else{
                    echo '
                        <div class="empty">
                            <p>no products added yet!</p>
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