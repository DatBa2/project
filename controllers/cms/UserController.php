<?php
require_once 'controllers/Controller.php';
require_once 'models/cms/User.php';

class UserController extends Controller {

    public function logout(){
        unset($_SESSION['user']);
        $_SESSION['success']="Đăng xuất thành công";
        $id = $_GET['id'];
        $user_model = new User();
        $user_model->last_login = date('Y-m-d H:i:s');
        $user_model->status = 0;
        $is_update = $user_model->updateLogin($id);
        header("location:index.php?controller=user&action=login&cms");
        exit();
    }

    public function index() {
        if (!isset($_SESSION['user']['username'])){
            header("location:index.php?controller=user&action=login&cms");
            exit();
        }
        $user_model = new User();

        //lấy danh sách user sử dụng phân trang
        $users = $user_model->getAll();

        $this->content = $this->render('views/cms/users/index.php', [
            'users' => $users
        ]);


        require_once 'views/cms/layouts/main.php';
    }

    public function update() {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            header("Location: index.php?controller=user&cms");
            exit();
        }

        $id = $_GET['id'];
        $user_model = new User();
        $user = $user_model->getById($id);
        if (isset($_POST['submit'])) {

            if ($_FILES['avatar']['error'] == 0) {
                $extension = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
                $extension = strtolower($extension);
                $allow_extensions = ['png', 'jpg', 'jpeg', 'gif'];
                $file_size_mb = $_FILES['avatar']['size'] / 1024 / 1024;
                $file_size_mb = round($file_size_mb, 2);
                if (!in_array($extension, $allow_extensions)) {
                    $this->error = 'Phải upload avatar dạng ảnh';
                } else if ($file_size_mb > 2) {
                    $this->error = 'File upload không được lớn hơn 2Mb';
                }
            }

            //xủ lý lưu dữ liệu khi biến error rỗng
            if (empty($this->error)) {
                $filename = $user['avatar'];
                //xử lý upload ảnh nếu có
                if ($_FILES['avatar']['error'] == 0) {
                    $dir_uploads = __DIR__ . '/../assets/uploads';
                    //xóa file ảnh đã update trc đó
                    @unlink($dir_uploads . '/' . $filename);
                    if (!file_exists($dir_uploads)) {
                        mkdir($dir_uploads);
                    }

                    $filename = time() . '-user-' . $_FILES['avatar']['name'];
                    move_uploaded_file($_FILES['avatar']['tmp_name'], $dir_uploads . '/' . $filename);
                }
                //lưu password dưới dạng mã hóa, hiện tại sử dụng cơ chế md5
                $user_model->avatar = $filename;
                $is_update = $user_model->update($id);
                if ($is_update) {
                    $_SESSION['success'] = 'Update dữ liệu thành công';
                } else {
                    $_SESSION['error'] = 'Update dữ liệu thất bại';
                }
                header('Location: index.php?controller=user&cms');
                exit();
            }
        }

        $this->content = $this->render('views/cms/users/update.php', [
            'user' => $user
        ]);

        require_once 'views/cms/layouts/main.php';
    }

    //url: index.php?controller=user&action=register
    public function register() {
        // + Xử lý submit form khi user click Đăng ký
//        echo "<pre>";
//        print_r($_POST);
//        echo "</pre>";
        if (isset($_SESSION['success']))
            unset($_SESSION['success']);
        if (isset($_POST['register'])) {
            //Gán biến trung gian
            $username = $_POST['username'];
            $password = $_POST['password'];
            $confirm_password = $_POST['repassword'];
            //Xử lý validate form:
            // + Tất cả các trường ko ddc để trống
            // + Mật khẩu phải trùng nhau
            if (empty($username) || empty($password) ||
            empty($confirm_password)) {
                $this->error = 'Ko đc để trống';
            } elseif ($password != $confirm_password) {
                $this->error = 'Mật khẩu chưa trùng nhau';
            }
            // nếu như ko có lỗi thì xử lý đăng ký user
            if (empty($this->error)) {
                // kiểm tra xem username đã tồn tại trong
//                bảng users chưa
                // Gọi model để xử lý, tạo model User
                $user_model = new User();
                $is_username_exists =
                    $user_model->isUsernameExists($username);
                //nếu username đã tồn tại sẽ báo lỗi
                if ($is_username_exists) {
                    $this->error = 'Username đã tồn tại';
                } else {
                    //đăng ký user
                    //cần lưu mật khẩu dưới dạng mã hóa
                    $password = md5($password);
                    $is_register =
                        $user_model->register($username, $password);
//                    var_dump($is_register);
                    if ($is_register) {
                        $_SESSION['success'] = 'Đăng ký thành công';
                        if (!isset($_SESSION['user'])){
                            header('Location: index.php?controller=user&action=login&cms');
                            exit();
                        } else {
                            header('location:index.php?controller=user&action=index&cms');
                        }
                    } else {
                        $this->error = "Không thể đăng ký";
                    }
                }
            }
        }

        $this->title_page = 'Trang đăng ký user';
        $this->content = $this->render('views/cms/users/register.php');
        // + Gọi layout để hiển thị nội dung view vừa lấy đc
        require_once 'views/cms/layouts/main_login.php';
    }

    //Phương thức xử lý login
    public function login() {
        //XỬ LÝ SUBMIT FORM
        if (isset($_POST['login'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            //Xử lý validate, ko đc để trống 2 trường
            if (empty($username) || empty($password)) {
                $this->error = 'Phải nhập cả 2 trường';
            }
            //Xử lý đăng nhập chỉ khi ko có lỗi nào xảy ra
            if (empty($this->error)) {
                $user_model = new User();
                //cần mã hóa password đúng theo cơ chế đã lưu
                //password này trc khi kiểm tra trong CSDL
                $password = md5($password);
                // Do cần hiển thị thông tin user sau khi login
                //thành công, nên kêt quả trả về xử lý hàm
                //getUser là 1 mảng, gán mảng đó cho session
                $user = $user_model
                    ->getUserByUsernameAndPassword($username, $password);
                $user_model->last_login = date('Y-m-d H:i:s');
                $user_model->status = 1;
                $is_update = $user_model->updateLogin($user['id']);
                //nếu đăng nhập thành công
                if (!empty($user)) {
                    //Tạo session gán bằng mảng user trên
                    $_SESSION['user'] = $user;
                    $_SESSION['success'] = 'Đăng nhập thành công';
                    header('Location: index.php?controller=product&cms');
                    exit();
                } else {
                    $this->error = 'Sai tài khoản hoặc mật khẩu';
                }
            }
        }

        $this->title_page = 'Trang đăng nhập';

        // + Lấy nội dung view login tương ứng,
        //tạo view: views/users/login.php
        $this->content = $this->render('views/cms/users/login.php');
        // + Gọi layout để hiển thị
        require_once 'views/cms/layouts/main_login.php';
    }

}