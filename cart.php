<?php 
	include 'components/connect.php';

	if (isset($_COOKIE['user_id'])) {
		$user_id = $_COOKIE['user_id'];
	}else {
		$user_id = '';
	}

    // update product qty
    if (isset($_POST['update_cart'])) {
        $cart_id = $_POST['cart_id'];
        $cart_id = filter_var($cart_id, FILTER_SANITIZE_STRING);

        $qty = $_POST['qty'];
        $qty = filter_var($qty, FILTER_SANITIZE_STRING);

        $update_qty = $conn->prepare("UPDATE `cart` SET qty = ? WHERE id = ?");
        $update_qty->execute([$qty, $cart_id]);

        $success_msg[] = 'cart quantity updated';
    }

    // delete product from cart
    if (isset($_POST['delete_item'])) {
        $cart_id = $_POST['cart_id'];
        $cart_id = filter_var($cart_id, FILTER_SANITIZE_STRING);

        $verify_delete = $conn->prepare("SELECT * FROM `cart` WHERE id = ?");
        $verify_delete->execute([$cart_id]);

        if ($verify_delete->rowCount() > 0) {
            $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE id = ?");
            $delete_cart->execute([$cart_id]);
            $success_msg[] = 'cart item deleted successfully';
        }else {
            $warning_msg[] = 'cart item already deleted';
        }
    }

    // empty product from cart 
    if (isset($_POST['empty_cart'])) {
        $verify_empty_item = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
        $verify_empty_item->execute([$user_id]);

        if ($verify_empty_item->rowCount() > 0) {
            $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
            $delete_cart_item->execute([$user_id]);
            $success_msg[] = 'empty cart successfully';
        }else {
            $warning_msg[] = 'your cart already empty';
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
            <h1>my cart</h1>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. At, omnis facere earum vitae pariatur <br>eveniet minima rerum, natus molestiae nulla nostrum tenetur ea. Quasi.</p>
            <span><a href="dashboard.php">home</a><i class="bx bx-right-arrow-alt"></i>my cart</span>
        </div>
    </div>
    <div class="line2"></div>

    <div class="products">
        <div class="heading">
            <h1>products added in your cart </h1>
            <img src="image/separator.png" alt="">
        </div>
        <div class="box-container">
            <?php
                $grand_total = 0;
                $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
                $select_cart->execute([$user_id]);

                if ($select_cart->rowCount() > 0) {
                    while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
                        $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
                        $select_products->execute([$fetch_cart['product_id']]);
                        
                        if ($select_products->rowCount() > 0) {
                            $fetch_products = $select_products->fetch(PDO::FETCH_ASSOC);

            ?>
            <form action="" class="box <?php if($fetch_products['stock'] == 0){echo 'disabled';} ?>" method="post">
                <input type="hidden" name="cart_id" value="<?= $fetch_cart['id']; ?>">
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
                <p class="price">price $<?= $fetch_products['price']; ?>/-</p>
                <div class="content cart-content">
                    <div class="flex-btn">
                        <h3 class="name"><?= $fetch_products['name']; ?></h3>
                        <p class="sub-total">sub total : $<?= $sub_total = ($fetch_cart['qty']*$fetch_cart['price']); ?></p>
                    </div>
                    <div class="flex-btn">
                        <input type="number" name="qty" required min="1" max="99" value="<?= $fetch_cart['qty']; ?>" maxlength="2" class="qty">
                        <button type="submit" name="update_cart" class="bx bxs-edit fa-edit" style="box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.4);"></button>
                        <button type="submit" name="delete_item" onclick="return confirm('delete this product')" class="btn">delete</button>
                    </div>
                </div>
            </form>
            <?php
                        $grand_total += $sub_total;
                        }
                    }
                }else{
                echo '
                    <div class="empty">
                        <p>no products added to cart yet!</p>
                    </div>
                ';
            }
            ?>
        </div>
        <?php if($grand_total != 0){ ?>
            <div class="cart-total">
                <p>total amount payable : <span>$ <?= $grand_total; ?>/-</span></p>
                <div class="button">
                    <form action="" method="post">
                        <button type="submit" name="empty_cart" onclick="return confirm('are you sure to empty cart');" class="btn">empty cart</button>
                        <a href="checkout.php" class="btn">proceed to checkout</a>
                    </form>
                </div>
            </div>
        <?php } ?>
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