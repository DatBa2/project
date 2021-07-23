<?php
$year = '';
$username = '';
$jobs = '';
$avatar = '';
?>
<div class="wrapper">
    <div class="container">
        <div class="dashboard">
            <div class="left">
                    <span class="left__icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                <div class="left__content">
                    <div class="left__logo">Web Của Ba Đạt</div>
                    <div class="left__profile">
                        <div class="left__image">
                            <a href="index.php?controller=product&cms"><?php if (!empty($_SESSION['user']['avatar'])): ?>
                                <img height="160" src="assets/uploads/<?php echo $_SESSION['user']['avatar']; ?>"/>
                                <?php endif; ?> </a>
                        </div>
                        <a href="index.php?controller=product&cms"><p class="left__name"><?php echo $_SESSION['user']['username']; ?></p></a>
                    </div>
                    <ul class="left__menu">
                        <li class="left__menuItem">
                            <a href="index.php?cms" class="left__title"><img src="assets/cms/assets/icon-dashboard.svg" alt="">Bảng Điều Khiển</a>
                        </li>
                        <li class="left__menuItem">
                            <div class="left__title"><img src="assets/cms/assets/icon-tag.svg" alt="">Sản Phẩm<img class="left__iconDown" src="assets/cms/assets/arrow-down.svg" alt=""></div>
                            <div class="left__text">
                                <a class="left__link" href="<?php echo "index.php?controller=product&action=create&cms"; ?>">Thêm Sản Phẩm</a>
                                <a class="left__link" href="<?php echo "index.php?controller=product&cms"; ?>">Xem Sản Phẩm</a>
                            </div>
                        </li>
                        <li class="left__menuItem">
                            <div class="left__title"><img src="assets/cms/assets/icon-edit.svg" alt="">Danh Mục SP<img class="left__iconDown" src="assets/cms/assets/arrow-down.svg" alt=""></div>
                            <div class="left__text">
                                <a class="left__link" href="<?php echo "index.php?controller=category&action=create&cms"; ?>">Thêm Danh Mục</a>
                                <a class="left__link" href="<?php echo "index.php?controller=category&cms"; ?>">Xem Danh Mục</a>
                            </div>
                        </li>
                        <li class="left__menuItem">
                            <a href="<?php echo "/ltweb/project/index.php"; ?>" class="left__title" target="_blank" ><img src="assets/cms/assets/icon-users.svg" alt="">Trang Web</a>
                        </li>
                        <li class="left__menuItem">
                            <a href="<?php echo "#"; ?>" class="left__title"><img src="assets/cms/assets/icon-users.svg" alt="">Khách Hàng</a>
                        </li>
                        <li class="left__menuItem">
                            <a href="<?php echo "index.php?controller=order&action=index&cms"; ?>" class="left__title"><img src="assets/cms/assets/icon-book.svg" alt="">Đơn Đặt Hàng</a>
                        </li>
<!--                        <li class="left__menuItem">-->
<!--                            <a href="--><?php //echo "#"; ?><!--" class="left__title"><img src="assets/assets/icon-pencil.svg" alt="">Chỉnh CSS</a>-->
<!--                        </li>-->
                        <li class="left__menuItem">
                            <div class="left__title"><img src="assets/cms/assets/icon-user.svg" alt="">Admin<img class="left__iconDown" src="assets/cms/assets/arrow-down.svg" alt=""></div>
                            <div class="left__text">
                                <a class="left__link" href="<?php echo "index.php?controller=user&action=index&cms"; ?>">Xem Admins</a>
                            </div>
                        </li>
                        <li class="left__menuItem">
                            <a href="<?php echo "index.php?controller=user&action=logout&cms&id=".$_SESSION['user']['id']; ?>" class="left__title"><img src="assets/cms/assets/icon-logout.svg" alt="">Đăng Xuất</a>
                        </li>
                    </ul>
                </div>
            </div>