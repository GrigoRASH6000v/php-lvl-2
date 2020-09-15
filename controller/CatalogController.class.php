<?php
class CatalogController extends Controller
{
    protected $controls = [
        '' => 'Главная страница',
        '?path=catalog' => 'Каталог',
        '?path=cabinet' => 'Личный кабинет',
    ];

    public $view = 'catalog';

    public function index($data){
        
        //$categories = Category::getCategories(isset($data['id']) ? $data['id'] : 0);
        $goods = Good::getGoods(isset($data['id']) ? $data['id'] : 0);
        
        return ['subcategories' => $categories, 'goods' => $goods, 'controls' => $this->controls];
    }

    public function goods($data){
        
        if($data['id'] > 0){
            $good = new Good([
                "id_good" => $data['id']
            ]);
            print_r($good->getGoodInfo()[0]);
            return $good->getGoodInfo()[0];
           
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