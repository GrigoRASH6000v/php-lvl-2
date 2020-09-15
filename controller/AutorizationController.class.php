<?php
class AutorizationController extends Controller
{
    // protected $controls = [
    //     '' => 'Главная страница',
    //     '?path=catalog' => 'Каталог',
    //     '?path=cabinet' => 'Личный кабинет',
    // ];

    public $view = 'autorization';

    public function index($data){
        
        //$categories = Category::getCategories(isset($data['id']) ? $data['id'] : 0);
        //$goods = Good::getGoods(isset($data['id']) ? $data['id'] : 0);
        
        return ['subcategories' => $categories, 'goods' => $goods, 'controls' => $this->controls];
    }
    public function registration($data){
        
        //$categories = Category::getCategories(isset($data['id']) ? $data['id'] : 0);
        //$goods = Good::getGoods(isset($data['id']) ? $data['id'] : 0);
        
        //return ['subcategories' => $categories, 'goods' => $goods, 'controls' => $this->controls];
    }
    public function checkEmail ($email){
        $sql = "SELECT email FROM users WHERE email='$email'";
        return db::getInstance()->Select($sql);
        //return $sql;
    }

    public function checkLogin ($login){
        $sql = "SELECT login FROM users WHERE login='$login'";
        return db::getInstance()->Select($sql);
    }

    public function regNewUser(){
        $_GET['asAjax'] = true;
        $checkLogin = $this->checkLogin($_POST['login'])[0]['login'];
        $checkMail = $this->checkEmail($_POST['email'])[0]['email'];
        if($checkLogin && $checkMail){
            $name = $_POST['name'];
            $secondName = $_POST['secondName'];
            $email = $_POST['email'];
            $login = $_POST['login'];
            $password = $_POST['password'];
            $sql = "INSERT INTO users (name, second_name, email, login, password) VALUES ('$name', '$secondName', '$email', '$login', '$password')";
            db::getInstance()->Query($sql);
        }

        
        // $name = $_POST['name'];
        // $secondName = $_POST['secondName'];
        // $email = $_POST['email'];
        // $login = $_POST['login'];
        // $password = $_POST['password'];
        // $sql = "INSERT INTO users (name, second_name, email, login, password) VALUES ('$name', '$secondName', '$email', '$login', '$password')";
        // db::getInstance()->Query($sql);
        //echo $this->checkEmail($_POST['email']);
        //$this->checkEmail($_POST['email'])[0]['email']
        print_r($this->checkLogin($_POST['login'])[0]['login']);
    }

    
}
?>