<?php

$controller = isset($_GET['controller']) ?
    $_GET['controller'] : 'product';
$action = isset($_GET['action']) ? $_GET['action'] : 'shop';
?>

<!-- Breadcrumb Section Begin -->
<div class="breacrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <a href="#"><i class="fa fa-home"></i> Home</a>
                    <span>Shop</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section Begin -->

<?php
//    echo '<pre>';
//    print_r($_SESSION);
//    echo '</pre>';
//?>

<!-- Product Shop Section Begin -->
<section class="product-shop spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-8 order-2 order-lg-1 produts-sidebar-filter">
                <div class="filter-widget">
                    <?php if(!empty($categories)): ?>
                    <h4 class="fw-title">Categories</h4>
                    <ul class="filter-catagories">
                        <?php foreach($categories AS $category):
                        ?>
                            <li><a href="index.php?controller=product&action=shop&category_id=<?php echo $category['id'] ?>&price=&name=&search=Tìm+kiếm"><?php echo $category['name'] ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                    <?php endif; ?>
                </div>
                <div class="filter-widget">
                    <h4 class="fw-title">Brand</h4>
                    <div class="fw-brand-check">
                        <div class="bc-item">
                            <label for="bc-calvin">
                                Calvin Klein
                                <input type="checkbox" id="bc-calvin">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="bc-item">
                            <label for="bc-diesel">
                                Diesel
                                <input type="checkbox" id="bc-diesel">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="bc-item">
                            <label for="bc-polo">
                                Polo
                                <input type="checkbox" id="bc-polo">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="bc-item">
                            <label for="bc-tommy">
                                Tommy Hilfiger
                                <input type="checkbox" id="bc-tommy">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="filter-widget">
                    <h4 class="fw-title">Price</h4>
                    <div class="filter-range-wrap">
                        <form action="" method="get">
                            <input type="hidden" name="controller"
                                   value="<?php echo $controller; ?>" />
                            <input type="hidden" name="action"
                                   value="<?php echo $action; ?>" />
                            <input type="hidden" name="category_id"
                                   value="-1" />
                            <input type="hidden" name="name" value="">
                            <input type="number" name="price">
                            <button style="border: none; margin-top: 20px; padding: 0px; background-color: white"
                                    type="submit" name="search" value="Tìm kiếm"><p class="filter-btn">Filter</p></button>
                        </form>
                    </div>
                </div>
                <div class="filter-widget">
                    <h4 class="fw-title">Size</h4>
                    <div class="fw-size-choose">
                        <div class="sc-item">
                            <input type="radio" id="s-size">
                            <label for="s-size">s</label>
                        </div>
                        <div class="sc-item">
                            <input type="radio" id="m-size">
                            <label for="m-size">m</label>
                        </div>
                        <div class="sc-item">
                            <input type="radio" id="l-size">
                            <label for="l-size">l</label>
                        </div>
                        <div class="sc-item">
                            <input type="radio" id="xs-size">
                            <label for="xs-size">xs</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 order-1 order-lg-2">
                <div class="product-show-option">
                    <div class="row">
                        <div class="col-lg-7 col-md-7">
                            <div class="select-option">
                                <form method="post" >
                                <select name="sort" class="sorting">
                                    <option <?php if (isset($_POST['sort']) && $_POST['sort']==0) echo 'selected'; else echo ""; ?> value="0">Default sort</option>
                                    <option <?php if (isset($_POST['sort']) && $_POST['sort']==1) echo 'selected'; else echo ""; ?> value="1">Giảm dần theo giá</option>
                                    <option <?php if (isset($_POST['sort']) && $_POST['sort']==2) echo 'selected'; else echo ""; ?> value="2">Tăng dần theo giá</option>
                                </select>
                                    <button type="submit" class="btn btn-primary">Sort</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product-list">
                    <?php if (!empty($products)): ?>
                    <div class="row">
                        <?php foreach ($products AS $product):
                            $product_link = "shop/show/" . $product['id'];
                        ?>
                        <div class="col-lg-4 col-sm-6" id="<?php echo $product['title'] ?>">
                            <div class="product-item">
                                <div class="pi-pic">
                                    <img height="300px"src="assets/uploads/<?php echo $product['avatar'] ?>" alt="">
                                    <?php
                                    $today = date("Y-m-d H:i:s");
                                    if(strtotime('3 day',strtotime($product['created_at']))-strtotime($today)>0):
                                    ?>
                                        <div class="sale">NEW</div>
                                    <?php endif ?>
                                    <?php
                                    if($product['amount']<=0):
                                        ?>
                                        <div class="sale" style="background-color: red">Hết hàng</div>
                                    <?php endif ?>
                                    <div class="icon">
                                        <i class="icon_heart_alt"></i>
                                    </div>
                                    <ul>
                                        <?php
                                        if($product['amount']>0):
                                        ?>
                                        <li class="w-icon active"><a href="index.php?controller=cart&action=add&product_id=<?php echo $product['id'];?>"><i class="icon_bag_alt"></i></a></li>
                                        <?php endif; ?>
                                        <li class="quick-view"><a href="<?php echo $product_link; ?>">+ Quick View</a></li>
                                        <li class="w-icon"><a href="#"><i class="fa fa-random"></i></a></li>
                                    </ul>
                                </div>
                                <div class="pi-text">
                                    <div class="catagory-name"><?php echo $product['category_name'] ?></div>
                                    <a href="<?php echo $product_link ?>">
                                        <h5><?php echo $product['title'] ?></h5>
                                    </a>
                                    <div class="product-price">
                                        <?php echo $product['price'] ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
<!--                    --><?php //echo $pages; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Product Shop Section End -->