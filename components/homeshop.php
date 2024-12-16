<div class="popular-brands">
    <h2>OUR POPULAR BRANDS</h2>
    <div class="controls">
        <i class="bx bx-chevron-left left"></i>
        <i class="bx bx-chevron-right right"></i>
    </div>
    <div class="popular-brands-content">
        <?php
            $select_products = $conn->prepare("SELECT * FROM `products` WHERE status = ?");
            $select_products->execute(['active']);

            if ($select_products->rowCount() > 0) {
                while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
                    
                
        ?>
        <form action="" method="post" class="box" <?php if($fetch_products['stock'] == 0){echo 'disabled';} ?>>
            <div class="icon">
                <div class="icon-box">
                    <img src="image/products/<?= $fetch_products['thumb_one']; ?>" alt="" class="img1">
                    <img src="image/products/<?= $fetch_products['thumb_two']; ?>" alt="" class="img2">
                </div>
            </div>
            <?php if($fetch_products['stock'] > 9){ ?>
                <span class="stock" style="color: green;">in stock</span>
            <?php }elseif($fetch_products['stock'] == 0) {?>
                <span class="stock" style="color: red;">out of stock</span>
            <?php }else{ ?>
                <span class="stock" style="color: green;">hurry only <?= $fetch_products['stock']; ?></span>
            <?php } ?>
            <p class="price">$<?= $fetch_products['price']; ?>/-</p>
            <div class="content">
                <div class="button">
                    <div><h3><?= $fetch_products['name']; ?></h3></div>
                    <div>
                        <button type="submit" name="add_to_cart"><i class="bx bx-cart"></i></button>
                        <button type="submit" name="add_to_wishlist"><i class="bx bx-heart"></i></button>
                        <a href="view_page.php?pid=<?= $fetch_products['id']; ?>" class="bx bxs-show"></a>
                    </div>
                </div>
                <input type="hidden" name="product_id" value="<?= $fetch_products['id']; ?>">
                <div class="flex-btn">
                    <a href="checkout.php?get_id=<?= $fetch_products['id']; ?>" class="btn">buy now</a>
                    <input type="number" name="qty" required min="1" value="1" max="99" maxlength="2" class="qty">
                </div>
            </div>
        </form>
        <?php
                }
            }else{
                echo '
                    <div class="empty">
                        <p>no products added yet!</p>
                    </div>
                ';
            }
        ?>
    </div>
</div>

<script src="jquary.js"></script>
<script src="slick.js"></script>
<script type="text/javascript">
    
$('.popular-brands-content').slick({
    lazyLoad: 'ondemand',
    slidesToShow: 4,
    slideToScrool: 1,
    nextArrow: $('.right'),
    prevArrow: $('.left'),
    responsive: [
        {
            breakpoint: 1024,
            settings: {
                slidesToShow: 2,
                slideToScrool: 1,
                infinite: true,
            }
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 2,
                slideToScrool: 1,
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
                slideToScrool: 1,
            }
        },

    ]
})
</script>


