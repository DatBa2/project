<?php
require_once 'models/Model.php';

class Product extends Model {

  public function getProductInHomePage($sort) {
    if($sort == 2){
        $str_filter = " ORDER BY products.price ASC";
    } else if($sort == 1) {
        $str_filter = " ORDER BY products.price DESC";
    } else {
        $str_filter = "";
    }
    //do cả 2 bảng products và categories đều có trường name, nên cần phải thay đổi lại tên cột cho 1 trong 2 bảng
    $sql_select = "SELECT products.*, categories.name 
          AS category_name FROM products
          INNER JOIN categories ON products.category_id = categories.id
          WHERE products.status = 1 $str_filter";

    $obj_select = $this->connection->prepare($sql_select);
    $obj_select->execute();

    $products = $obj_select->fetchAll(PDO::FETCH_ASSOC);
    return $products;
  }

  /**
   * Lấy thông tin sản phẩm theo id
   * @param $id
   * @return mixed
   */
      public function getById($id)
  {
    $obj_select = $this->connection
      ->prepare("SELECT products.*, categories.name AS category_name FROM products 
          INNER JOIN categories ON products.category_id = categories.id WHERE products.id = $id");

    $obj_select->execute();
    return $obj_select->fetchAll(PDO::FETCH_ASSOC);
  }

    /**
     * Lấy thông tin của sản phẩm đang có trên hệ thống
     * @return array
     */
    public function getAll($params = []) {
        //+ Tạo 1 ra chuỗi search với giá trị là WHERE TRUE, để
        //việc nối chuỗi với các key search đc đơn giản hơn
        $str_search = ' WHERE TRUE';
        // + Xử lý trường hợp nếu search thì sẽ thay đổi lại
        // giá trị của chuỗi search ban đầu
        if (isset($params['category_id']) && $params['category_id'] != -1) {
            $category_id = $params['category_id'];
            $str_search .= " AND products.category_id = $category_id";
        }

        if (isset($params['name']) && !empty($params['name'])) {
            $name = $params['name'];
            $str_search .= " AND products.title LIKE '%$name%' ";
        }
        if (isset($params['price']) && !empty($params['price'])) {
            $price =$params['price'];
            $str_search .= " AND products.price <= $price";
        }
        $sort = $params['sort'];
        if($sort == 2){
            $str_search .= " ORDER BY products.price ASC";
        } else if($sort == 1) {
            $str_search .= " ORDER BY products.price DESC";
        } else {
            $str_search .= "";
        }
        $obj_select = $this->connection
            ->prepare("SELECT products.*, categories.name AS category_name FROM products 
                        INNER JOIN categories ON categories.id = products.category_id
                        $str_search
                        ");

        $arr_select = [];
        $obj_select->execute($arr_select);
        $products = $obj_select->fetchAll(PDO::FETCH_ASSOC);

        return $products;
    }

    /**
     * Tính tổng số bản ghi đang có trong bảng products
     * @return mixed
     */
    public function countTotal()
    {
        $obj_select = $this->connection->prepare("SELECT COUNT(id) FROM products");
        $obj_select->execute();

        return $obj_select->fetchColumn();
    }

}
