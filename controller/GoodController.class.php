<?php
class GoodController extends Controller
{
    protected $controls = [
        '' => 'Главная страница',
        '?path=catalog' => 'Каталог',
        '?path=cabinet' => 'Личный кабинет',
    ];

    public $view = 'good';

    public function index($data){
        
        if($data['id'] > 0){
            $good = new Good([
                "id_good" => $data['id']
            ]);
            return ['subcategories' => $categories, 'good' => $good->getGoodInfo()[0], 'controls' => $this->controls]; ;
           
        }
        else{
            header("Location: /catalog/");
        }     
    }
    public function add($data){
        $_GET['asAjax'] = true;
        Catalog::add(isset($data['id']) ? $data['id'] : 0);
    }
    public function check($data){
        $_GET['asAjax'] = true;
        $goods = Basket::check(isset($data['id']) ? $data['id'] : 0);
        return $goods;
    }
}
?>