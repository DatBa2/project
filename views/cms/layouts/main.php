<!--views/layouts/main.php-->
<!--
Hiển thị các thông tin của user đã đăng nhập
, sử dụng $_SESSION['user'] để xử lý hiển thị
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $this->title_page; ?></title>
    <link rel="stylesheet" href="assets/cms/css/main.css">
    <link href="assets/cms/css/bootstrap.min.css" rel="stylesheet">
    <script src="assets/cms/js/jquery-1.11.1.min.js"></script>
    <script src="assets/cms/js/bootstrap.min.js"></script>
</head>
<body>
    <?php require_once 'header.php';?>

    <div class="right">
        <div class="right__content">
            <div class="right__title">Bảng điều khiển</div>
            <p class="right__desc">Bảng điều khiển</p>
            <div class="right__cards">
                <a class="right__card" href="<?php echo "index.php?controller=product&cms";?>">
                    <div class="right__cardTitle">Sản Phẩm</div>
                    <div class="right__cardNumber"><?php echo $_SESSION['count']['count_product']; ?></div>
                    <div class="right__cardDesc">Xem Chi Tiết <img src="assets/cms/assets/arrow-right.svg" alt=""></div>
                </a>
                <a class="right__card" href="#">
                    <div class="right__cardTitle">Khách Hàng</div>
                    <div class="right__cardNumber"><?php echo 0; ?></div>
                    <div class="right__cardDesc">Xem Chi Tiết <img src="assets/cms/assets/arrow-right.svg" alt=""></div>
                </a>
                <a class="right__card" href="<?php echo "index.php?controller=category&cms";?>">
                    <div class="right__cardTitle">Danh Mục</div>
                    <div class="right__cardNumber"><?php echo $_SESSION['count']['count_category']; ?></div>
                    <div class="right__cardDesc">Xem Chi Tiết <img src="assets/cms/assets/arrow-right.svg" alt=""></div>
                </a>
                <a class="right__card" href="index.php?controller=order&action=index&cms">
                    <div class="right__cardTitle">Đơn Hàng</div>
                    <div class="right__cardNumber">0</div>
                    <div class="right__cardDesc">Xem Chi Tiết <img src="assets/cms/assets/arrow-right.svg" alt=""></div>
                </a>
            </div>
            <div class="right__table">
                <div><?php echo $this->content; ?></div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>

    <?php require_once 'footer.php'; ?>

</body>
</html>
