<?php 
	include '../components/connect.php';

	if (isset($_COOKIE['seller_id'])) {
		$seller_id = $_COOKIE['seller_id'];
	}else {
		$seller_id = '';
        header('location:login.php');
	}

    // delete product from database 
    $get_id = $_GET['post_id'];
    if (isset($_POST['delete'])) {
        $p_id = $_POST['product_id'];
        $p_id = filter_var($p_id, FILTER_SANITIZE_STRING);

        $delete_image = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
        $delete_image->execute([$p_id]);
        $fetch_delete_image = $delete_image->fetch(PDO::FETCH_ASSOC);

        if ($fetch_delete_image['thumb_one'] != '' AND $fetch_delete_image['thumb_two'] != '' AND $fetch_delete_image['thumb_three'] != '') {
            unlink('../uploaded_files/'.$fetch_delete_image['thumb_one']);
            unlink('../uploaded_files/'.$fetch_delete_image['thumb_two']);
            unlink('../uploaded_files/'.$fetch_delete_image['thumb_three']);
        }
        $delete_product = $conn->prepare("DELETE FROM `products` WHERE id = ?");
        $delete_product->execute([$p_id]);
        header('location:view_product.php');
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
            <h1>read products</h1>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. At, omnis facere earum vitae pariatur <br>eveniet minima rerum, natus molestiae nulla nostrum tenetur ea. Quasi.</p>
            <span><a href="dashboard.php">admin</a><i class="bx bx-right-arrow-alt"></i>read products</span>
        </div>
    </div>
    <div class="line2"></div>

    <div class="read_products">
        <div class="heading">
            <h1>read product</h1>
            <img src="../image/separator.png" alt="">
        </div>
        <div class="container">
            <?php
                $select_product = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
                $select_product->execute([$get_id]);

                if ($select_product->rowCount() > 0) {
                    while($fetch_product = $select_product->fetch(PDO::FETCH_ASSOC)){
            ?>
            <form action="" method="post" class="box">
                <input type="hidden" name="product_id" value="<?= $fetch_product['id']; ?>">

                <div class="status" style="color: <?php if($fetch_product['status'] == 'active'){echo "limegreen";}else{echo "red";} ?>"><?= $fetch_product['status']; ?></div>
                <div class="product_slider">
                    <div>
                        <img id="featuredImage" class="slider-featuredImage" src="../uploaded_files/<?= $fetch_product['thumb_one']; ?>" alt="">
                    </div>
                    <div class="slider-thumbnails">
                        <a href="../uploaded_files/<?= $fetch_product['thumb_one']; ?>" class="slider-thumbnail active">
                            <img src="../uploaded_files/<?= $fetch_product['thumb_one']; ?>" alt="">
                        </a>
                        <a href="../uploaded_files/<?= $fetch_product['thumb_two']; ?>" class="slider-thumbnail">
                            <img src="../uploaded_files/<?= $fetch_product['thumb_two']; ?>" alt="">
                        </a>
                        <a href="../uploaded_files/<?= $fetch_product['thumb_three']; ?>" class="slider-thumbnail">
                            <img src="../uploaded_files/<?= $fetch_product['thumb_three']; ?>" alt="">
                        </a>
                    </div>
                </div>
                <p class="price">$<?= $fetch_product['price']; ?>/-</p>
                <div class="title"><?= $fetch_product['name']; ?></div>
                <div class="content"><?= $fetch_product['product_detail']; ?></div>
                <div class="flex-btn">
                    <a href="edit_product.php?id=<?= $fetch_product['id']; ?>" class="btn">edit</a>
                    <button type="submit" name="delete" onclick="return confirm('delete this product');" class="btn">delete</button>
                    <a href="view_product.php?post_id=<?= $fetch_product['id']; ?>" class="btn">go back</a>
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