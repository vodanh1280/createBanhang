<?php 
	include '../components/connect.php';

	if (isset($_COOKIE['seller_id'])) {
		$seller_id = $_COOKIE['seller_id'];
	}else {
		$seller_id = '';
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
   	
   
   	<link rel="stylesheet" type="text/css" href="../css/admin_style.css?v=<?php echo time(); ?>">
	<title>Bedesk Londan Fashion Website Template</title>
</head>
<body>
	
	<?php include '../components/admin_header.php'; ?>

    <div class="banner">
        <div class="detail">
            <h1>registered users</h1>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. At, omnis facere earum vitae pariatur <br>eveniet minima rerum, natus molestiae nulla nostrum tenetur ea. Quasi.</p>
            <span><a href="dashboard.php">admin</a><i class="bx bx-right-arrow-alt"></i>registered users</span>
        </div>
    </div>
    <div class="line2"></div>

    <div class="user-container">
        <div class="heading">
            <h1>registered users</h1>
            <img src="../image/separator.png" alt="">
        </div>
        <div class="box-container">
            <?php
                $select_users = $conn->prepare("SELECT * FROM `users`");
                $select_users->execute();

                if ($select_users->rowCount() > 0) {
                    while ($fetch_users = $select_users->fetch(PDO::FETCH_ASSOC)) { 
                        
            ?>
            <div class="box">
                <img src="../uploaded_files/<?= $fetch_users['image']; ?>" alt="">
                <div class="detail">
                    <p>user id: <?= $fetch_users['id']; ?></p>
                    <p>user name: <?= $fetch_users['name']; ?></p>
                    <p>user email: <?= $fetch_users['email']; ?></p>
                </div>
            </div>
            <?php
                    }
                }else{
                    echo '
                        <div class="empty">
                            <p>no user registered yet!</p>
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