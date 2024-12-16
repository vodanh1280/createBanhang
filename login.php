<?php 
	include 'components/connect.php';

	if (isset($_COOKIE['user_id'])) {
		$user_id = $_COOKIE['user_id'];
	}else {
		$user_id = '';
	}

    if (isset($_POST['login'])) {
        
        $email = $_POST['email'];
        $email = filter_var($email, FILTER_SANITIZE_STRING);

        $pass = sha1($_POST['pass']);
        $pass = filter_var($pass, FILTER_SANITIZE_STRING);

        $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ? LIMIT 1");
        $select_user->execute([$email, $pass]);
        $row = $select_user->fetch(PDO::FETCH_ASSOC);

        if ($select_user->rowCount() > 0) {
            setcookie('user_id', $row['id'], time() + 60*60*24*30, '/');
            header('location:home.php');
        }else {
            $warning_msg[] = 'incorrect email or password';
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
            <h1>login now</h1>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. At, omnis facere earum vitae pariatur <br>eveniet minima rerum, natus molestiae nulla nostrum tenetur ea. Quasi.</p>
            <span><a href="home.php">home</a><i class="bx bx-right-arrow-alt"></i>login now</span>
        </div>
    </div>
    <div class="line2"></div>


    <div class="form-container">
        <form action="" method="post" enctype="multipart/form-data" class="login">
            <h3>Login now</h3>
            <div class="input-field">
                <p>Your email <span>*</span></p>
                <input type="email" name="email" placeholder="Enter your email..." maxlength="50" required class="box">
            </div>

            <div class="input-field">
                <p>Your password <span>*</span></p>
                <input type="password" name="pass" placeholder="Enter your password..." maxlength="50" required class="box">
            </div>
            <p class="link">don't have an account? <a href="register.php">Register now</a></p>
            <button class="btn" type="submit" name="login">Login now</button>
        </form>
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