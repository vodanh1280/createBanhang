<?php 
	include '../components/connect.php';

	if (isset($_COOKIE['seller_id'])) {
		$seller_id = $_COOKIE['seller_id'];
	}else {
		$seller_id = '';
        header('location:login.php');
	}

    if (isset($_POST['delete'])) {
        
        $delete_id = $_POST['delete_if'];
        $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);

        $verify_delete = $conn->prepare("SELECT * FROM `message` WHERE id = ?");
        $verify_delete->execute([$delete_id]);

        if ($verify_delete->rowCount() > 0) {
            $delete_msg = $conn->prepare("DELETE FROM `message` WHERE id = ?");
            $delete_msg->execute([$delete_id]);
            $success_msg[] = 'message deleted';
        }else {
            $warning_msg[] = 'message already deleted';
        }
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
            <h1>messages</h1>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. At, omnis facere earum vitae pariatur <br>eveniet minima rerum, natus molestiae nulla nostrum tenetur ea. Quasi.</p>
            <span><a href="dashboard.php">admin</a><i class="bx bx-right-arrow-alt"></i>messages</span>
        </div>
    </div>
    <div class="line2"></div>

    <div class="message-container">
        <div class="heading">
            <h1>unread messages</h1>
            <img src="../image/separator.png" alt="">
        </div>
        <div class="box-container">
            <?php
                $select_msg = $conn->prepare("SELECT * FROM `message`");
                $select_msg->execute();

                if ($select_msg->rowCount() > 0) {
                    while ($fetch_msg = $select_msg->fetch(PDO::FETCH_ASSOC)) { 
                        
            ?>
            <div class="box">
                <h3 class="name">name: <?= $fetch_msg['name']; ?></h3>
                <h4>subject: <?= $fetch_msg['subject']; ?></h4>
                <p><?= $fetch_msg['message']; ?></p>
                <form action="" method="post">
                    <input type="hidden" name="delete_id" value="<?= $fetch_msg['id']; ?>">
                    <button type="submit" name="delete" onclick="return confirm('want to delete this message');" class="btn">delete message</button>
                </form>
            </div>
            <?php
                    }
                }else{
                    echo '
                        <div class="empty">
                            <p>no unread message yet!</p>
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