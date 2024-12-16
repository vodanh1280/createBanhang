<?php 
	include 'components/connect.php';

	if (isset($_COOKIE['user_id'])) {
		$user_id = $_COOKIE['user_id'];
	}else {
		$user_id = '';
	}

    if (isset($_POST['place_order'])) {
        if ($user_id != '') {
            $name = $_POST['name'];
            $name = filter_var($name, FILTER_SANITIZE_STRING);

            $email = $_POST['email'];
            $email = filter_var($email, FILTER_SANITIZE_STRING);

            $number = $_POST['number'];
            $number = filter_var($number, FILTER_SANITIZE_STRING);

            $address = $_POST['flat'].', '.$_POST['street'].', '.$_POST['city'].', '.$_POST['country'].', '.$_POST['pin'];
            $address = filter_var($address, FILTER_SANITIZE_STRING);

            $address_type = $_POST['address_type'];
            $address_type = filter_var($address_type, FILTER_SANITIZE_STRING);

            $method = $_POST['method'];
            $method = filter_var($method, FILTER_SANITIZE_STRING);

            $verify_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $verify_cart->execute([$user_id]);

            if (isset($_GET['get_id'])) {
                $get_product = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
                $get_product->execute([$_GET['get_id']]);

                if ($get_product->rowCount() > 0) {
                    while ($fetch_p = $get_product-fetch(PDO::FETCH_ASSOC)) {
                        $seller_id = $fetch_p['seller_id'];

                        $insert_order = $conn->prepare("INSERT INTO `orders`(id, user_id, seller_id, name, number, email, address, address_type, method, product_id, price, qty) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)");

                        $insert_order->execute([unique_id(), $user_id, $seller_id, $name, $number, $email, $address, $address_type, $method, $fetch_p['id'], $fetch_p['price'], 1]);
                        header('location:order.php');

                    }
                }else {
                    $warning_msg[] = 'somthing went wrong';
                }
            }elseif ($verify_cart->rowCount()) {
                while ($f_cart = $verify_cart->fetch(PDO::FETCH_ASSOC)) {
                    $s_products = $conn->prepare("SELECT * FROM `products` WHERE id = ? LIMIT 1");
                    $s_products->execute([$f_cart['product_id']]);
                    $f_product = $s_products->fetch(PDO::FETCH_ASSOC);

                    $seller_id = $f_product['seller_id'];

                    $insert_order = $conn->prepare("INSERT INTO `orders`(id, user_id, seller_id, name, number, email, address, address_type, method, product_id, price, qty) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)");

                    $insert_order->execute([unique_id(), $user_id, $seller_id, $name, $number, $email, $address, $address_type, $method, $f_cart['product_id'], $f_cart['price'], $f_cart['qty']]);
                        header('location:order.php');
                }
                if ($insert_order) {
                    $delete_cart_id = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
                    $delete_cart_id->execute([$user_id]);
                    header('location:order.php');
                }
            }else {
                $warning_msg[] = 'somthing went wrong';
            }
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
            <h1>checkout</h1>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. At, omnis facere earum vitae pariatur <br>eveniet minima rerum, natus molestiae nulla nostrum tenetur ea. Quasi.</p>
            <span><a href="dashboard.php">home</a><i class="bx bx-right-arrow-alt"></i>checkout</span>
        </div>
    </div>
    <div class="line2"></div>

    <div class="checkout">
        <div class="heading">
            <h1>checkout summary</h1>
            <img src="image/separator.png" alt="">
        </div>
        <div class="row">
            <div class="form-container">
                <form action="" method="post" class="register">
                    <input type="hidden" name="p_id" value="<?= $get_id; ?>">
                    <h3>billing details</h3>
                    <div class="flex">
                        <div class="col">
                            <div class="input-field">
                                <p>your name <span>*</span></p>
                                <input type="text" name="name" placeholder="enter your name" maxlength="50" required class="box">
                            </div>
                            <div class="input-field">
                                <p>your number <span>*</span></p>
                                <input type="number" name="number" placeholder="enter your name" class="box" required>
                            </div>
                            <div class="input-field">
                                <p>your email <span>*</span></p>
                                <input type="email" name="email" placeholder="enter your email" maxlength="50" required class="box">
                            </div>
                            <div class="input-field">
                                <p>payment status <span>*</span></p>
                                <select name="method" class="box">
                                    <option value="cash on delivery">cash on delivery</option>
                                    <option value="credit or debit cart">credit or debit cart</option>
                                    <option value="net banking">net banking</option>
                                    <option value="upi or rupay">upi or rupay</option>
                                    <option value="paytm">credit or debit cart</option>
                                </select>
                            </div>
                            <div class="input-field">
                                <p>address type <span>*</span></p>
                                <select name="address_type" class="box">
                                    <option value="home">home</option>
                                    <option value="office">office</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="input-field">
                                <p>address line 01 <span>*</span></p>
                                <input type="text" name="flat" placeholder="e.g flate & building" maxlength="50" required class="box">
                            </div>
                            <div class="input-field">
                                <p>address line 02 <span>*</span></p>
                                <input type="text" name="street" placeholder="e.g street name" maxlength="50" required class="box">
                            </div>
                            <div class="input-field">
                                <p>city name <span>*</span></p>
                                <input type="text" name="city" placeholder="enter city name" maxlength="50" required class="box">
                            </div>
                            <div class="input-field">
                                <p>country name <span>*</span></p>
                                <input type="text" name="country" placeholder="enter country name" maxlength="50" required class="box">
                            </div>
                            <div class="input-field">
                                <p>pincode <span>*</span></p>
                                <input type="number" name="pin" placeholder="e.g 110099" maxlength="6" required class="box">
                            </div>
                        </div>
                    </div>
                    <button type="submit" name="place_order" class="btn">place order</button>
                </form>
            </div>
            <div class="summary">
                <h3>my bag</h3>
                <div class="box-container">
                    <?php 
                        $grand_total = 0;

                        if (isset($_GET['get_id'])) {
                            $select_get = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
                            $select_get->execute([$_GET['get_id']]);

                            while ($fetch_get = $select_get->fetch(PDO::FETCH_ASSOC)) {
                                $sub_total = $fetch_get['price'];
                                $grand_total += $sub_total;
                            
                    ?>
                    <div class="flex">
                        <img src="image/products/<?= $fetch_get['thumb_one']; ?>" class="image">
                        <div>
                            <h3 class="name"><?= $fetch_get['name']; ?></h3>
                            <p class="price">$<?= $fetch_get['price']; ?>/-</p>
                        </div>
                    </div>
                    <?php
                            }
                        }else {
                            $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
                            $select_cart->execute([$user_id]);

                            if ($select_cart->rowCount() > 0) {
                                while ($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)) {
                                    $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
                                    $select_products->execute([$fetch_cart['product_id']]);
                                    $fetch_products = $select_products->fetch(PDO::FETCH_ASSOC);
                                    $sub_total = ($fetch_cart['qty']*$fetch_products['price']);
                                    $grand_total += $sub_total;
                                
                    ?>
                    <div class="flex">
                        <img src="image/products/<?= $fetch_products['thumb_one']; ?>" class="image">
                        <div>
                            <h3 class="name"><?= $fetch_products['name']; ?></h3>
                            <p class="price">$<?= $fetch_products['price']; ?> X <?= $fetch_cart['qty']; ?></p>
                        </div>
                    </div>
                    <?php
                                }
                            }else{
                                echo '
                                    <div class="empty">
                                        <p>no products added yet!</p>
                                    </div>
                                ';
                            }
                        }
                    ?>
                </div>
                <div class="grand-total"><span>total amount payable : </span>$<?= $grand_total; ?>/-</div>
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