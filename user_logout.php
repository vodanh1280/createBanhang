<?php
    include 'connect.php';

    setcookie('user_id', '', time() - 1, '/');
    header('location:../website%20bán%20hàng%20full%20stack/home.php');

?>