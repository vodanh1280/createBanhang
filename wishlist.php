<?php 
	include 'components/connect.php';

	if (isset($_COOKIE['user_id'])) {
		$user_id = $_COOKIE['user_id'];
	}else {
		$user_id = '';
	}

    include 'components/add_cart.php';

    // delete item from wishlist
    if (isset($_POST['delete_item'])) {
        $wishlist_id = $_POST['wishlist_id'];
        $wishlist_id = filter_var($wishlist_id, FILTER_SANITIZE_STRING);

        $verify_delete = $conn->prepare("SELECT * FROM `wishlist` WHERE id = ?");
        $verify_delete->execute([$wishlist_id]);

        if ($verify_delete->rowCount() > 0) {
            $delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE id = ?");
            $delete_wishlist->execute([$wishlist_id]);
            $success_msg[] = 'wishlist item deleted successfully';
        }else {
            $warning_msg[] = 'wishlist item already deleted';
        }
    }
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

    <div class="banner">
        <div class="detail">
            <h1>my wishlist</h1>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. At, omnis facere earum vitae pariatur <br>eveniet minima rerum, natus molestiae nulla nostrum tenetur ea. Quasi.</p>
            <span><a href="dashboard.php">home</a><i class="bx bx-right-arrow-alt"></i>my wishlist</span>
        </div>
    </div>
    <div class="line2"></div>

    <div class="products">
        <div class="heading">
            <h1>products added in your wishlist</h1>
            <img src="image/separator.png" alt="">
        </div>

        <div class="box-container">
            <?php
                $grand_total = 0;

                $select_wishlist = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
                $select_wishlist->execute([$user_id]);

                if ($select_wishlist->rowCount() > 0) {
                    while ($fetch_wishlist = $select_wishlist->fetch(PDO::FETCH_ASSOC)) {
                        $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
                        $select_products->execute([$fetch_wishlist['product_id']]);

                        if ($select_products->rowCount() > 0) {
                            $fetch_products = $select_products->fetch(PDO::FETCH_ASSOC);
                      
            ?>
            <form action="" method="post" class="box <?php if($fetch_products['stock'] == 0){echo 'disabled';} ?>">
                <input type="hidden" name="wishlist_id" value="<?= $fetch_wishlist['id']; ?>">
                <div class="icon-box">
                    <img src="image/products/<?= $fetch_products['thumb_one']; ?>" alt="" class="img1">
                    <img src="image/products/<?= $fetch_products['thumb_two']; ?>" alt="" class="img2">
                </div>
                <?php if($fetch_products['stock'] > 9){  ?>
                    <span class="stock" style="color: green;">in stock</span>
                <?php }elseif($fetch_products['stock'] == 0){ ?>
                    <span class="stock" style="color: red;">out of stock</span>
                <?php }else { ?>
                    <span class="stock" style="color: red;">hurry only <?= $fetch_products['stock']; ?> left</span>
                <?php } ?>
                <div class="flex">
                    <p class="price">price $<?= $fetch_products['price']; ?>/-</p>
                </div>
                <div class="content">
                    <div class="button">
                        <div><h3 class="name"><?= $fetch_products['name']; ?></h3></div>
                        <div>
                            <button type="submit" name="add_to_cart"><i class="bx bx-cart"></i></button>
                            <a href="view_page.php?pid=<?= $fetch_products['id']; ?>" class="bx bxs-show"></a>
                            <button type="submit" name="delete_item" onclick="return confirm('delete this product')"><i class="bx bx-x"></i></button>
                        </div>
                    </div>
                    <input type="hidden" name="product_id" value="<?= $fetch_products['id']; ?>">
                    <div class="flex">
                        <input type="hidden" name="qty" required min="1" max="99" maxlength="2" class="qty" value="1">
                        <a href="checkout.php?get_id=<?= $fetch_products['id']; ?>" class="btn" style="width: 100% !important;">buy now</a>
                    </div>
                </div>
            </form>
            <?php
                        }
                    }
                }else{
                    echo '
                        <div class="empty">
                            <p>no products added to wishlist yet!</p>
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