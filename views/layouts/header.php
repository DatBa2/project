<!-- Header Section Begin -->
<?php
$controller = isset($_GET['controller']) ?
    $_GET['controller'] : 'product';
$action = isset($_GET['action']) ? $_GET['action'] : 'shop';

?>
<header class="header-section">
    <div class="header-top">
        <div class="container">
            <div class="ht-left">
                <div class="mail-service">
                    <a style="color: black" href="mailto:nguyenbadat1092k@gmail.com"><i class=" fa fa-envelope"></i>
                        nguyenbadat1092k@gmail.com</a>
                </div>
                <div class="phone-service">
                    <a style="color: black" href="tel:0981998984"><i class=" fa fa-phone"></i>
                        +89 1234 5678</a>
                </div>
            </div>
            <div class="ht-right">
                <a href="#" class="login-panel"><i class="fa fa-user"></i>Login</a>
                <div class="top-social">
                    <a href="#"><i class="ti-facebook"></i></a>
                    <a href="#"><i class="ti-twitter-alt"></i></a>
                    <a href="#"><i class="ti-linkedin"></i></a>
                    <a href="#"><i class="ti-pinterest"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="inner-header">
            <div class="row">
                <div class="col-lg-2 col-md-2">
                    <div class="logo">
                        <a href="index">
                            <h2 style="color: #01ff70; margin: 0; padding: 0">Ba Đạt</h2>
                        </a>
                    </div>
                </div>
                <div class="col-lg-7 col-md-7">
                    <div class="advanced-search">
                        <button type="button" class="category-btn">All Categories</button>
                        <div class="input-group">
                            <form action="" method="get">
                                <input type="hidden" name="controller"
                                       value="<?php echo $controller; ?>" />
                                <input type="hidden" name="action"
                                       value="<?php echo $action; ?>" />
                                <input type="hidden" name="category_id" value="-1" />
                                <input type="text" name="name" placeholder="What do you need?">
                                <input type="hidden" name="price" value="" />
                                <button type="submit" name="search" value="Tìm kiếm"><i class="ti-search"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 text-right col-md-3">
                    <ul class="nav-right">
                        <li class="heart-icon">
                            <a href="">
                                <i class="icon_heart_alt"></i>
                                <span>1</span>
                            </a>
                        </li>
                        <li class="cart-icon">
                            <a href="giohang">
                                <i class="icon_bag_alt"></i>
                                <?php
                                $cart_total = 0;
                                if (isset($_SESSION['cart'])) {
                                    foreach ($_SESSION['cart'] AS $cart) {
                                        $cart_total += $cart['quantity'];
                                    }
                                }
                                ?>
                                <span >
                                <?php echo $cart_total; ?>
                                </span>
                            </a>
                            <div class="cart-hover">
                                <div class="select-items">
                                    <?php if(isset($_SESSION['cart'])): ?>
                                    <table>
                                        <?php $_SESSION['total'] = 0; ?>
                                        <tbody>
                                        <?php foreach ($_SESSION['cart'] as $cart) : ?>
                                        <tr>
                                            <td width="100px" class="si-pic"><img src="../backend/assets/uploads/<?php echo $cart['avatar'] ?>" alt=""></td>
                                            <td class="si-text">
                                                <div class="product-selected">
                                                    <p><?php echo $cart['price']; ?> x <?php echo $cart['quantity'] ?></p>
                                                    <h6><?php echo $cart['name']; ?></h6>
                                                </div>
                                            </td>
                                            <td class="si-close">
                                                <i class="ti-close"></i>
                                            </td>
                                        </tr>
                                        <?php $_SESSION['total'] += $cart['price']*$cart['quantity']; ?>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                    <?php endif; ?>
                                </div>
                                <div class="select-total">
                                    <span>total:</span>
                                    <h5><?php if (isset($_SESSION['total'])) echo $_SESSION['total']; else echo "0"; ?></h5>
                                </div>
                                <div class="select-button">
                                    <a href="giohang" class="primary-btn view-card">VIEW CARD</a>
                                    <a href="index.php?controller=cart&action=destroy" class="primary-btn checkout-btn">RESET CARD</a>
                                </div>
                            </div>
                        </li>
                        <li class="cart-price"><?php if (isset($_SESSION['total'])) echo ceil($_SESSION['total'] + $_SESSION['total']/10); else echo "0"; ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="nav-item">
        <div class="container">
            <nav class="nav-menu mobile-menu">
                <ul>
                    <li class="<?php if (!isset($_GET['action'])) echo "active"; ?>"><a href="index">Home</a></li>
                    <li class="<?php if (isset($_GET['action'])) echo "active"; ?>" ><a href="<?php echo "shop" ?>">Shop</a></li>
                    <li><a href="index">Collection</a>
                        <ul class="dropdown">
                            <li><a href="#">Men's</a></li>
                            <li><a href="#">Women's</a></li>
                            <li><a href="#">Kid's</a></li>
                        </ul>
                    </li>
                    <li><a href="./blog.html">Blog</a></li>
                    <li><a href="./contact.html">Contact</a></li>
                    <li><a href="#">Pages</a>
                        <ul class="dropdown">
                            <li><a href="./blog-details.html">Blog Details</a></li>
                            <li><a href="./shopping-cart.html">Shopping Cart</a></li>
                            <li><a href="./check-out.html">Checkout</a></li>
                            <li><a href="./faq.html">Faq</a></li>
                            <li><a href="./register.html">Register</a></li>
                            <li><a href="./login.html">Login</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <div id="mobile-menu-wrap"></div>
        </div>
    </div>
</header>
<!-- Header End -->