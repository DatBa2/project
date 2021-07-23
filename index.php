<?php
    session_start();
    date_default_timezone_set("Asia/Ho_Chi_Minh");

    $controller = isset($_GET['controller']) ? $_GET['controller'] : 'product';
    $action = isset($_GET['action']) ? $_GET['action'] : 'index';
    $cms = isset($_GET['cms'])? 'cms':'';
    $controller = ucfirst($controller);
    $controller .= "Controller";
    $path_controller = "controllers/$cms/$controller.php";

    if (file_exists($path_controller) == false) {
      die('Trang bạn tìm không tồn tại');
    }

    require_once "$path_controller";

    $object = new $controller();

    if (method_exists($object, $action) == false) {
      die("Không tồn tại phương thức $action của class $controller");
    }
    $object->$action();
?>