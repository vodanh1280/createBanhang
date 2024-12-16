<?php
    if (isset($_POST['add_to_wishlist'])) {
        if ($user_id != '') {
            
            $id = unique_id();
            $product_id = $_POST['product_id'];

            $verify_wishlist = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ? AND product_id = ?");
            $verify_wishlist->execute([$user_id, $product_id]);

            $cart_num = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ? AND product_id = ?");
            $cart_num->execute([$user_id, $product_id]);

            if ($verify_wishlist->rowCount() > 0) {
                $warning_msg[] = 'product already exist in your wishlist';
            }elseif ($cart_num->rowCount() > 0) {
                $warning_msg[] = 'product already exist in your cart';
            }else {
                $select_price = $conn->prepare("SELECT * FROM `products` WHERE id = ? LIMIT 1");
                $select_price->execute([$product_id]);
                $fetch_price = $select_price->fetch(PDO::FETCH_ASSOC);

                $insert_wishlist = $conn->prepare("INSERT INTO `wishlist` (id, user_id, product_id, price) VALUES (?, ?, ?, ?)");
                $insert_wishlist->execute([$id, $user_id, $product_id, $fetch_price['price']]);

                $success_msg[] = 'product added to wishlist successfully';
            }
        }else {
            $warning_msg[] = 'please login or register first';
        }
    }



?>