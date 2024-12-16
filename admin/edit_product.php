<?php 
	include '../components/connect.php';

	if (isset($_COOKIE['seller_id'])) {
		$seller_id = $_COOKIE['seller_id'];
	}else {
		$seller_id = '';
        header('location:login.php');
	}

    // save product in database
    if (isset($_POST['update'])) {
        
        $product_id = $_POST['product_id'];
        $product_id = filter_var($product_id, FILTER_SANITIZE_STRING);

        $name = $_POST['name'];
        $name = filter_var($name, FILTER_SANITIZE_STRING);

        $price = $_POST['price'];
        $price = filter_var($price, FILTER_SANITIZE_STRING);

        $content = $_POST['content'];
        $content = filter_var($content, FILTER_SANITIZE_STRING);

        $category = $_POST['category'];
        $category = filter_var($category, FILTER_SANITIZE_STRING);

        $stock = $_POST['stock'];
        $stock = filter_var($stock, FILTER_SANITIZE_STRING);

        $status = $_POST['status'];
        $status = filter_var($status, FILTER_SANITIZE_STRING);

        $update_product = $conn->prepare("UPDATE `products` SET name = ?, price = ?, category = ?, product_detail = ?, stock = ?, status = ? WHERE id = ?");
        $update_product->execute([$name, $price, $category, $content, $stock, $status, $product_id]);

        $success_msg[] = 'product update';
        
        $thumb_one = $_FILES['thumb_one']['name'];
        $thumb_one = filter_var($thumb_one, FILTER_SANITIZE_STRING);
        $thumb_one_tmp_name = $_FILES['thumb_one']['tmp_name'];
        $thumb_one_folder = '../uploaded_files/'.$thumb_one;

        $thumb_two = $_FILES['thumb_two']['name'];
        $thumb_two = filter_var($thumb_two, FILTER_SANITIZE_STRING);
        $thumb_two_tmp_name = $_FILES['thumb_two']['tmp_name'];
        $thumb_two_folder = '../uploaded_files/'.$thumb_two;

        $thumb_three = $_FILES['thumb_three']['name'];
        $thumb_three = filter_var($thumb_three, FILTER_SANITIZE_STRING);
        $thumb_three_tmp_name = $_FILES['thumb_three']['tmp_name'];
        $thumb_three_folder = '../uploaded_files/'.$thumb_three;

        $update_image = $conn->prepare("UPDATE `products` SET thumb_one = ?, thumb_two = ?, thumb_three = ? WHERE id = ?");
        $update_image->execute([$thumb_one, $thumb_two, $thumb_three, $product_id]);

        move_uploaded_file($thumb_one_tmp_name, $thumb_one_folder);
        move_uploaded_file($thumb_two_tmp_name, $thumb_two_folder);
        move_uploaded_file($thumb_three_tmp_name, $thumb_three_folder);

        $success_msg[] = 'product image updated successfully';
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


    // save product in database as draft
    if (isset($_POST['draft'])) {
        
        $id = unique_id();

        $name = $_POST['name'];
        $name = filter_var($name, FILTER_SANITIZE_STRING);

        $price = $_POST['price'];
        $price = filter_var($price, FILTER_SANITIZE_STRING);

        $content = $_POST['content'];
        $content = filter_var($content, FILTER_SANITIZE_STRING);

        $category = $_POST['category'];
        $category = filter_var($category, FILTER_SANITIZE_STRING);

        $stock = $_POST['stock'];
        $stock = filter_var($stock, FILTER_SANITIZE_STRING);
        $status = 'deactive';

        $thumb_one = $_FILES['thumb_one']['name'];
        $thumb_one = filter_var($thumb_one, FILTER_SANITIZE_STRING);
        $thumb_one_tmp_name = $_FILES['thumb_one']['tmp_name'];
        $thumb_one_folder = '../uploaded_files/'.$thumb_one;

        $thumb_two = $_FILES['thumb_two']['name'];
        $thumb_two = filter_var($thumb_two, FILTER_SANITIZE_STRING);
        $thumb_two_tmp_name = $_FILES['thumb_two']['tmp_name'];
        $thumb_two_folder = '../uploaded_files/'.$thumb_two;

        $thumb_three = $_FILES['thumb_three']['name'];
        $thumb_three = filter_var($thumb_three, FILTER_SANITIZE_STRING);
        $thumb_three_tmp_name = $_FILES['thumb_three']['tmp_name'];
        $thumb_three_folder = '../uploaded_files/'.$thumb_three;

        $insert_product = $conn->prepare("INSERT INTO `products`(id, seller_id, name, price, category, thumb_one, thumb_two, thumb_three, stock, product_detail, status) VALUES(?,?,?,?,?,?,?,?,?,?,?)");
        $insert_product->execute([$id, $seller_id, $name, $price, $category, $thumb_one, $thumb_two, $thumb_three, $stock, $content, $status]);

        move_uploaded_file($thumb_one_tmp_name, $thumb_one_folder);
        move_uploaded_file($thumb_two_tmp_name, $thumb_two_folder);
        move_uploaded_file($thumb_three_tmp_name, $thumb_three_folder);

        $success_msg[] = 'product save as draft successfully';
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
            <h1>edit products</h1>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. At, omnis facere earum vitae pariatur <br>eveniet minima rerum, natus molestiae nulla nostrum tenetur ea. Quasi.</p>
            <span><a href="dashboard.php">admin</a><i class="bx bx-right-arrow-alt"></i>edit products</span>
        </div>
    </div>
    <div class="line2"></div>

    <div class="edit_products">
        <div class="heading">
            <h1>edit products</h1>
            <img src="../image/separator.png" alt="">
        </div>
        <div class="container">
            <?php
                $product_id = $_GET['id'];
                $select_product = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
                $select_product->execute([$product_id]);

                if ($select_product->rowCount() > 0) {
                    while($fetch_product = $select_product->fetch(PDO::FETCH_ASSOC)) {
                    
            ?>
            <div class="form-container">
                <form action="" method="post" enctype="multipart/form-data" class="register">
                    <input type="hidden" name="product_id" value="<?= $fetch_product['id']; ?>">
                    <div class="flex">
                        <div class="col">
                            <div class="input-field">
                                <p>product name <span>*</span></p>
                                <input type="text" name="name" maxlength="100" value="<?= $fetch_product['name']; ?>" class="box">
                            </div>
                            <div class="input-field">
                                <p>product price <span>*</span></p>
                                <input type="number" name="price" maxlength="100" value="<?= $fetch_product['price']; ?>" class="box">
                            </div>
                            <div class="input-field">
                                <p>total stocks <span>*</span></p>
                                <input type="number" name="stock" maxlength="10" min="0" max="9999999999" value="<?= $fetch_product['stock']; ?>" class="box">
                            </div>
                            <div class="input-field">
                                <p>product category <span>*</span></p>
                                <select name="category" class="box">
                                    <option selected value="<?= $fetch_product['category']; ?>"><?= $fetch_product['category']; ?></option>
                                    <option value="kid's section">kids section</option>
                                    <option value="men's section">men's section</option>
                                    <option value="co-ordsets">co-ordsets</option>
                                    <option value="bottoms">bottoms</option>
                                    <option value="shirts & tops">shirts & tops</option>
                                    <option value="western dresses">western dresses</option>
                                    <option value="ethinic wears">ethinic wears</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="input-field">
                                <p>thumbnail one <span>*</span></p>
                                <input type="file" name="thumb_one" accept="image/*" class="box">
                            </div>
                            <div class="input-field">
                                <p>thumbnail two <span>*</span></p>
                                <input type="file" name="thumb_two" accept="image/*" class="box">
                            </div>
                            <div class="input-field">
                                <p>thumbnail three <span>*</span></p>
                                <input type="file" name="thumb_three" accept="image/*" class="box">
                            </div>
                            <div class="input-field">
                                <p>product status <span>*</span></p>
                                <select name="status" class="box">
                                    <option selected value="<?= $fetch_product['status']; ?>"><?= $fetch_product['status']; ?></option>
                                    <option value="active">active</option>
                                    <option value="deactive">deactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="input-field">
                        <p>product description <span>*</span></p>
                        <textarea name="content" class="box"><?= $fetch_product['product_detail']; ?></textarea>
                    </div>
                    <div class="input-field">
                        <div class="flex-box">
                            <img src="../uploaded_files/<?= $fetch_product['thumb_one']; ?>" alt="">
                            <img src="../uploaded_files/<?= $fetch_product['thumb_two']; ?>" alt="">
                            <img src="../uploaded_files/<?= $fetch_product['thumb_three']; ?>" alt="">
                        </div>
                    </div>
                    <div class="flex-btn">
                        <button type="submit" name="update" class="btn">update product</button>
                        <button type="submit" name="delete" onclick="return confirm('delete this product');" class="btn">delete</button>
                        <a href="view_product.php?post_id=<?= $fetch_product['id']; ?>" class="btn">go back</a>
                    </div>
                </form>
            </div>
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