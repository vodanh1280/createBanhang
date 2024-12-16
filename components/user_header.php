<header class="header">
    <section class="flex">
        <a href="home.php" class="logo">
            <img src="image/logo (1).png" width="130px" alt="">
        </a>
        <nav class="navbar">
            <a href="home.php">Home</a>
            <a href="about.php">About us</a>
            <a href="shop.php">Shop</a>
            <a href="order.php">Orders</a>
            <a href="contact.php">Contact us</a>
        </nav>
        <form action="search_product.php" method="post" class="search-form">
            <input type="text" name="search_product" placeholder="search-product..." required max-length="100">
            <button type="submit" class="bx bx-search-alt-2" name="search_product_btn">search</button>
        </form>
        <div class="icons">
            <div class="bx bx-list-plus" id="menu-btn"></div>
            <div class="bx bx-search" id="search-btn"></div>

            <?php
                $count_wishlist_item = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
                $count_wishlist_item->execute([$user_id]);
                $total_wishlist_item = $count_wishlist_item->rowCount();
            ?>

            <a href="wishlist.php" class="cart-btn"><i class='bx bx-heart' ></i><sup><?= $total_wishlist_item; ?></sup></a>

            <?php
                $count_cart_item = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
                $count_cart_item->execute([$user_id]);
                $total_cart_item = $count_cart_item->rowCount();
            ?>

            <a href="cart.php" class="cart-btn"><i class='bx bx-cart'></i><sup><?= $total_cart_item; ?></sup></a>
            <div class="bx bx-user" id="user-btn"></div>
        </div>
        <div class="profile">
            <?php
                $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
                $select_profile->execute([$user_id]);

                if ($select_profile->rowCount() > 0) {
                    $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
                
            ?>
            <img src="uploaded_files/<?= $fetch_profile['image'] ?>" alt="">
            <h3 stype="margin-bottom: 1rem;"><?= $fetch_profile['name'] ?></h3>
            <div class="flex-btn">
                <a href="profile.php" class="btn">view profile</a>
                <a href="user_logout.php" onclick="return comfirm('logout from this website');" class="btn">Logout</a>
            </div>
            <?php }else { ?>
                <img src="image/man.png" alt="">
                <h3 stype="margin-bottom: 1rem;">please login or register </h3>
            <div class="flex-btn">
                <a href="login.php" class="btn">login</a>
                <a href="register.php" class="btn">register</a>
            </div>
            <?php } ?>
        </div>
    </section>
</header>