<?php
require_once 'controllers/Controller.php';
require_once 'models/Product.php';

class CartController extends Controller {

    public function index() {
      // Xử lý Cập nhật lại giá
//      echo "<pre>";
//      print_r($_POST);
//      echo "</pre>";
      if (isset($_POST['submit'])) {
        // Check thêm trường hợp nếu như số lượng là giá trị âm
        //thì báo lỗi và ko update
        foreach ($_SESSION['cart'] AS $product_id => $cart) {
          if ($_POST[$product_id] < 0) {
            $_SESSION['error'] = 'Số lượng phải > 0';
//            $url_redirect = $_SERVER['SCRIPT_NAME'] . '/gio-hang-cua-ban';
            header("Location: gio-hang-cua-ban.html");
            exit();
          }
        }

        //Lặp các phần tử trong giỏ hàng, và gán lại số lương
        //tương ứng cho từng phần tử theo id của sản phẩm
        foreach ($_SESSION['cart'] AS $product_id => $cart) {
          //truy cập phần tử mảng theo product_id
          $_SESSION['cart'][$product_id]['quantity']
              = $_POST[$product_id];
        }
        $_SESSION['success'] = 'Cập nhật giỏ hàng thành công';
      }

        $this->content =
            $this->render('views/carts/index.php');
        require_once 'views/layouts/main.php';
    }

    public function add() {
        $product_id = $_GET['product_id'];
        $product_model = new Product();
        $product = $product_model->getById($product_id);

        $cart = [
            'name' => $product[0]['title'],
            'price' => $product[0]['price'],
            'avatar' => $product[0]['avatar'],
            'quantity' => 1
        ];
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'][$product_id] = $cart;
        } else {
            if (!array_key_exists($product_id, $_SESSION['cart'])) {
                $_SESSION['cart'][$product_id] = $cart;
            } else {
                $_SESSION['cart'][$product_id]['quantity']++;
            }
        }
        $_SESSION['success'] = 'Đã thêm vào giỏ hàng';
        header('Location: ' . $_SERVER['HTTP_REFERER'].'#'.$product['title']);
        exit();
    }

    public function destroy() {
      unset($_SESSION['cart']);
      unset($_SESSION['total']);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }
}