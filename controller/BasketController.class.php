<?php
class BasketController extends Controller
{

    public $view = 'basket';
    protected $controls = [
        '' => 'Главная страница',
        '?path=catalog' => 'Каталог',
        '?path=cabinet' => 'Личный кабинет',
    ];

    public function index($data){
        
        //$categories = Category::getCategories(isset($data['id']) ? $data['id'] : 0);
        $goods = Good::getGoodsForBasket(isset($data['id']) ? $data['id'] : 0);
        return ['subcategories' => $categories, 'goods' => $goods, 'controls' => $this->controls];
    }

    public function goods($data){
        
        if($data['id'] > 0){
            $good = new Good([
                "id_good" => $data['id']
            ]);
            //print_r($good->getGoodInfo()[0]);
            return $good->getGoodInfo()[0];
           
        }
        else{
            header("Location: /catalog/");
        }   
    }

    public function remove($data){
        $goods = Basket::remove(isset($data['id']) ? $data['id'] : 0);
        return ['subcategories' => $categories, 'goods' => $goods];
    }

    public function less($data){
        $_GET['asAjax'] = true;
        $goods = Basket::less(isset($data['id']) ? $data['id'] : 0);
        return $goods;
    }

    public function more($data){
        $_GET['asAjax'] = true;
        $goods = Basket::more(isset($data['id']) ? $data['id'] : 0);
        return $goods;
        
    }
}
?>