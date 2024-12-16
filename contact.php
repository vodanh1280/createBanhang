<?php 
	include 'components/connect.php';

	if (isset($_COOKIE['user_id'])) {
		$user_id = $_COOKIE['user_id'];
	}else {
		$user_id = '';
	}

    if (isset($_POST['send_message'])) {
        if ($user_id != '') {
            $id = unique_id();

            $name = $_POST['name'];
            $name = filter_var($name, FILTER_SANITIZE_STRING);

            $email = $_POST['email'];
            $email = filter_var($email, FILTER_SANITIZE_STRING);

            $subject = $_POST['subject'];
            $subject = filter_var($subject, FILTER_SANITIZE_STRING);

            $message = $_POST['message'];
            $message = filter_var($message, FILTER_SANITIZE_STRING);

            $verify_message = $conn->prepare("SELECT * FROM `message` WHERE user_id = ? AND name = ? AND email = ? AND subject = ? AND message = ?");
            $verify_message->execute([$user_id, $name,$email, $subject, $message]);

            if ($verify_message->rowCount() > 0) {
                $warning_msg[] = 'message already send ';
            }else {
                $insert_message = $conn->prepare("INSERT INTO `message`(id, user_id, name, email, subject, message) VALUES(?, ?, ?, ?, ?, ?)");
                $insert_message->execute([$id, $user_id, $name, $email, $subject, $message]);
                $success_msg[] = 'message send';
            }
        }else{
            $warning_msg[] = 'please login first';
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
            <h1>contact us</h1>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. At, omnis facere earum vitae pariatur <br>eveniet minima rerum, natus molestiae nulla nostrum tenetur ea. Quasi.</p>
            <span><a href="dashboard.php">home</a><i class="bx bx-right-arrow-alt"></i>contact us</span>
        </div>
    </div>
    <div class="line2"></div>
    <div class="service">
        <div class="heading">
            <h1>our services</h1>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. At, omnis facere earum vitae pariatur <br>eveniet minima rerum, natus molestiae nulla nostrum tenetur ea. Quasi.</p>
            <img src="image/separator.png" alt="">
        </div>
        <div class="box-container">
            <div class="box">
                <img src="image/delivery.png" alt="">
                <div>
                    <h1>free shipping fast</h1>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit.</p>
                </div>
            </div>
            <div class="box">
                <img src="image/return.png" alt="">
                <div>
                    <h1>money back guarentee</h1>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit.</p>
                </div>
            </div>
            <div class="box">
                <img src="image/discount.png" alt="">
                <div>
                    <h1>online support 24/7</h1>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="contact">
        <div class="heading">
            <h1>droap a line</h1>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. At, omnis facere earum vitae pariatur <br>eveniet minima rerum, natus molestiae nulla nostrum tenetur ea. Quasi.</p>
            <img src="image/separator.png" alt="">
        </div>
        <div class="box-container">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d979994.3209265403!2d106.95387458529808!3d16.368724049209558!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31419c87726490f7%3A0xab1c0fcaf7cb84b5!2zVGjhu6thIFRoacOqbiBIdeG6vywgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1731784046072!5m2!1svi!2s" width="92%" height="820" style="border:0; margin: 1.5rem" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            <div class="form-container">
                <form action="" method="post" class="login">
                    <div class="input-field">
                        <p>your name <span>*</span></p>
                        <input type="text" name="name" placeholder="Enter your name" class="box" maxlength="50" required>
                    </div>
                    <div class="input-field">
                        <p>your email <span>*</span></p>
                        <input type="email" name="email" placeholder="Enter your email" class="box" maxlength="50">
                    </div>
                    <div class="input-field">
                        <p>subject <span>*</span></p>
                        <input type="text" name="subject" placeholder="Enter your reason" class="box" maxlength="50" required>
                    </div>
                    <div class="input-field">
                        <p>message <span>*</span></p>
                        <textarea name="message" class="box"></textarea>
                    </div>
                    <button type="submit" name="send_message" class="btn">send message</button>
                </form>
            </div>
        </div>
    </div>

    <div class="address">
        <div class="heading">
            <h1>our contact detail</h1>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. At, omnis facere earum vitae pariatur <br>eveniet minima rerum, natus molestiae nulla nostrum tenetur ea. Quasi.</p>
            <img src="image/separator.png" alt="">
        </div>
        <div class="box-container">
            <div class="box">
                <i class="bx bxs-map-alt"></i>
                <div>
                    <h4>address</h4>
                    <p>1093 Morigold Lane, Coral Way <br>Miami, Florida, 33169</p>
                </div>
            </div>
            <div class="box">
                <i class="bx bxs-phone-incoming"></i>
                <div>
                    <h4>phone number</h4>
                    <p>4538786483</p>
                    <p>5988487943</p>
                </div>
            </div>
            <div class="box">
                <i class="bx bxs-envelope"></i>
                <div>
                    <h4>email</h4>
                    <p>selenaansari@gmail.com</p>
                    <p>selenaansari38@gmail.com</p>
                </div>
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