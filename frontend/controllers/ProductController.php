<?php

require_once 'controllers/Controller.php';
require_once 'models/Product.php';
require_once 'models/Category.php';
require_once 'models/Pagination.php';

class ProductController extends Controller {

    public function index() {
        $product_model = new Product();
        $products = $product_model->getProductInHomePage(0);

        $this->content = $this->render('views/products/index.php', [
            'products' => $products
        ]);
        require_once 'views/layouts/main.php';
    }

    public function show() {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $_SESSION['error'] = 'ID không hợp lệ';
            header('Location: index.php?controller=product');
            exit();
        }
        $id = $_GET['id'];
        $product_model = new Product();
        $product = $product_model->getById($id);

        $this->content = $this->render('views/products/show.php', [
            'product' => $product
        ]);
        require_once 'views/layouts/main.php';
    }

    public function shop() {
        $product_model = new Product();
        if (isset($_GET['search'])) {
            $category_id = $_GET['category_id'];
            $name = $_GET['name'];
            $price = $_GET['price'];
            if (isset($_POST['sort']))
                $sort = $_POST['sort'];
            else $sort = 0;
            $params = [
                'category_id' => $category_id,
                'name' => $name,
                'price' => $price,
                'sort' => $sort
            ];
        //truyền mảng params trên vào phương thức getAll()
            $products = $product_model->getAll($params);
        } else {
            $sort = 0;
            if (isset($_POST['sort'])) {
                $sort = $_POST['sort'];
            }
            $products = $product_model->getProductInHomePage($sort);
        }

        $category_model = new Category();
        $categories = $category_model->getAll();

        $this->content = $this->render('views/products/shop.php', [
            'products' => $products,
            'categories' => $categories
        ]);
        require_once 'views/layouts/main.php';
    }
}