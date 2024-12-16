<?php 
	include 'components/connect.php';

	if (isset($_COOKIE['user_id'])) {
		$user_id = $_COOKIE['user_id'];
	}else {
		$user_id = '';
	}

    
    if (isset($_POST['register'])) {
        $id = unique_id();

        $name = $_POST['name'];
        $name = filter_var($name, FILTER_SANITIZE_STRING);
        
        $email = $_POST['email'];
        $email = filter_var($email, FILTER_SANITIZE_STRING);

        $pass = sha1($_POST['pass']);
        $pass = filter_var($pass, FILTER_SANITIZE_STRING);

        $cpass = sha1($_POST['cpass']);
        $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

        $image = $_FILES['image']['name'];
        $image = filter_var($image, FILTER_SANITIZE_STRING);
        $ext = pathinfo($image, PATHINFO_EXTENSION);
        $rename = unique_id().'.'.$ext;
        $image_size = $_FILES['image']['size'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_folder = 'uploaded_files/'.$rename;

        $select_users = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
        $select_users->execute([$email]);

        if($select_users->rowCount() > 0) {
            $warning_msg[] = 'email already exist';
        }else {
            if ($pass != $cpass) {
                $warning_msg[] = 'confirm password not matched';
            }else {
                $insert_users = $conn->prepare("INSERT INTO `users`(id, name, email, password, image) VALUES(?,?,?,?,?)");
                $insert_users->execute([$id, $name, $email, $cpass, $rename]);

                move_uploaded_file($image_tmp_name, $image_folder);

                $success_msg[] = 'new user registered! please login now';
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
            <h1>register now</h1>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. At, omnis facere earum vitae pariatur <br>eveniet minima rerum, natus molestiae nulla nostrum tenetur ea. Quasi.</p>
            <span><a href="dashboard.php">home</a><i class="bx bx-right-arrow-alt"></i>register now</span>
        </div>
    </div>
    <div class="line2"></div>


    
    <div class="form-container">
        <form action="" method="post" enctype="multipart/form-data" class="register">
            <h3>register now</h3>
            <div class="flex">
                <div class="col">
                    <div class="input-field">
                        <p>Your name <span>*</span></p>
                        <input type="text" name="name" placeholder="Enter your name..." maxlength="50" required class="box">
                    </div>
                    <div class="input-field">
                        <p>Your email <span>*</span></p>
                        <input type="email" name="email" placeholder="Enter your email..." maxlength="50" required class="box">
                    </div>
                </div>
                <div class="col">
                    <div class="input-field">
                        <p>Your password <span>*</span></p>
                        <input type="password" name="pass" placeholder="Enter your password..." maxlength="50" required class="box">
                    </div>
                    <div class="input-field">
                        <p>Confirm password <span>*</span></p>
                        <input type="password" name="cpass" placeholder="Confirm your password..." maxlength="50" required class="box">
                    </div>
                </div>
            </div>
            <div class="input-field">
                <p>Select profile <span>*</span></p>
                <input type="file" name="image" accept="image/*" required class="box">
            </div>
            <p class="link">already have an account? <a href="login.php">Login now</a></p>
            <button class="btn" type="submit" name="register">Register now</button>
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