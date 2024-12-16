<?php 
	include '../components/connect.php';

	if (isset($_COOKIE['seller_id'])) {
		$seller_id = $_COOKIE['seller_id'];
	}else {
		$seller_id = '';
        header('location:login.php');
	}

    // delete product from database 
    if (isset($_POST['delete'])) {
        
        $p_id = $_POST['product_id'];
        $p_id = filter_var($p_id, FILTER_SANITIZE_STRING);

        $delete_product = $conn->prepare("DELETE FROM `products` WHERE id = ?");
        $delete_product->execute([$p_id]);

        $success_msg[] = 'product delete successfully';
    }


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- box icon cdn link  -->
   	<link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
   	
   
   	<link rel="stylesheet" type="text/css" href="../css/admin_style.css?v=<?php echo time(); ?>">
	<title>Bedesk Londan Fashion Website Template</title>
</head>
<body>
	
	<?php include '../components/admin_header.php'; ?>

    <div class="banner">
        <div class="detail">
            <h1>view products</h1>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. At, omnis facere earum vitae pariatur <br>eveniet minima rerum, natus molestiae nulla nostrum tenetur ea. Quasi.</p>
            <span><a href="dashboard.php">admin</a><i class="bx bx-right-arrow-alt"></i>view products</span>
        </div>
    </div>
    <div class="line2"></div>

    <div class="show_products">
        <div class="heading">
            <h1>all products</h1>
            <img src="../image/separator.png" alt="">
        </div>
        <div class="box-container">
            <?php
                $seller_product = $conn->prepare("SELECT * FROM `products` WHERE seller_id = ?");
                $seller_product->execute([$seller_id]);

                if ($seller_product->rowCount() > 0) {
                    while ($fetch_products = $seller_product->fetch(PDO::FETCH_ASSOC)) {
                        
            ?>
            <form action="" method="post" class="box">
                <input type="hidden" name="product_id" value="<?= $fetch_products['id']; ?>">
                <div class="icon">
                    <div class="icon-box">
                        <img src="../uploaded_files/<?= $fetch_products['thumb_one']; ?>" alt="" class="img1">
                        <img src="../uploaded_files/<?= $fetch_products['thumb_three']; ?>" alt="" class="img2">
                    </div>
                </div>
                <div class="status" style="color: <?php if($fetch_products['status']=='active'){echo "limegreen";}else{echo "red";} ?>">
                    <?= $fetch_products['status']; ?>
                </div>
                <p class="price">$<?= $fetch_products['price']; ?>/-</p>
                <div class="content">
                    <div class="title"><?= $fetch_products['name']; ?></div>
                    <div class="flex-btn">
                        <a href="edit_product.php?id=<?= $fetch_products['id']; ?>" class="btn">edit</a>
                        <button type="submit" name="delete" onclick="return confirm('want to delete this product');" class="btn">delete</button>
                        <a href="read_product.php?post_id=<?= $fetch_products['id']; ?>" class="btn">read</a>
                    </div>
                </div>
            </form>
            <?php
                    }
                }else{
                    echo '
                        <div class="empty">
                            <p>no products added yet! <br> <a href="add_product.php" class="btn" style="margin-top: 1rem;">add product</a></p>
                        </div>
                    ';
                }
            ?>
        </div>

        
        
    </div>

	<?php include '../components/admin_footer.php'; ?>


	<!-- sweetalert cdn link  -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
	

    <script type="text/javascript">
        <?php include '../js/admin_script.js' ?>
    </script>
	<!-- alert  -->
	<?php include '../components/alert.php'; ?>
</body>
</html>