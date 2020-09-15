<?php
class AdminController extends Controller
{
    
    protected $controls = [
        '?path=admin' => 'Каталог',
        'users' => 'Пользователи',
        '?path=admin/createGood' => 'Добавить товар',
    ];
    
    public $view = 'admin';
    
    function __construct()
    {
        parent::__construct();
        $this->title = 'Admin';
    }
    
    public function index($data){
        $goods = Good::getGoods(isset($data['id']) ? $data['id'] : 0);
        return ['controls' => $this->controls, 'goods' => $goods];
    }

    public function createGood($data){
        $goods = Admin::createGood();
        return ['controls' => $this->controls, 'goods' => $goods];
    }
    public function editGood($data){
        if($data['id'] > 0){
            $categoryAndMakers = Admin::createGood();
            $good = new Good([
                "id_good" => $data['id']
            ]);
            print_r($categoryAndMakers);
            return ['subcategories' => $categories, 'good' => $good->getGoodInfo()[0], 'controls' => $this->controls, 'categoryAndMakers'=>$categoryAndMakers]; ;
           
        }
        else{
            header("Location: /catalog/");
        } 
       
    }
    public function saveChange($data){
        $_GET['asAjax'] = true;
        $resp = Admin::saveChange($_POST);
        return $resp;
    }

    //editGood
    public function addGood(){
        $_GET['asAjax'] = true;
        $resp = Admin::addGoodToCatalog($_POST, $_FILES);
        return $resp;
    }
    public function removeGood(){
        $_GET['asAjax'] = true;
        $resp = Admin::removeGoodFromCatalog($_GET['id']);
        return $resp;
    }


    public function control($data)
    {
        // Сохранение
        $actionId = $this->getActionId($data);
        if ($actionId['action'] === 'save') {
            $fields = [];

            foreach ($_POST as $key => $value) {
                $field = explode('_', $key, 2);
                if ($field[0] == $actionId['id']) {
                    $fields[$field[1]] = $value;
                }
            }
        }

        if ($actionId['action'] === 'create') {
            $fields = [];
            foreach ($_POST as $key => $value) {
                if (substr($key, 0, 4) == 'new_') {
                    $fields[str_replace('new_', '', $key)] = $value;
                }
            }
        }

        switch($actionId['action']) {
            case 'create':
                $query = 'INSERT INTO ' . $data['id'] . ' ';
                $keys = [];
                $values = [];
                foreach ($fields as $key => $value) {
                    $keys[] = $key;
                    $values[] = '"' . $value . '"';
                }

                $query .= ' (' . implode(',', $keys) . ') VALUES ( ' . implode(',', $values) . ')';
                db::getInstance()->Query($query);
                break;
            case 'save':
                $query = 'UPDATE ' . $data['id'] . ' SET ';
                foreach ($fields as $field => $value) {
                    $query .= $field . ' = "' . $value . '",';
                }
                $query = substr($query, 0, -1) . ' WHERE id = :id';

                db::getInstance()->Query($query, ['id' => $actionId['id']]);
                break;
            case 'delete':
                db::getInstance()->Query('UPDATE ' . $data['id'] . ' SET status=:status WHERE id = :id', ['id' => $actionId['id'], 'status' => Status::Deleted]);
                break;
        }
        $fields = db::getInstance()->Select('desc ' . $data['id']);
        $_items = db::getInstance()->Select('select * from ' . $data['id']);
        $items = [];
        foreach ($_items as $item) {
            $tmp = new $this->controls[$data['id']]($item);
            $items[] = (array)$tmp;
        }

        return ['name' => $data['id'],'fields' => $fields, 'items' => $items];
    }

    protected function getActionId($data)
    {
        foreach ($_POST as $key => $value) {
            if (strpos($key, '__save_') === 0) {
                $id = explode('__save_', $key)[1];
                $action = 'save';
                break;
            }
            if (strpos($key, '__delete_') === 0) {
                $id = explode('__delete_', $key)[1];
                $action = 'delete';
                break;
            }
            if (strpos($key, '__create') === 0) {
                $action = 'create';
                $id = 0;
            }
        }
        return ['id' => $id, 'action' => $action];
    }
}




// class CatalogController extends Controller
// {

//     public $view = 'catalog';

//     public function index($data){
        
//         //$categories = Category::getCategories(isset($data['id']) ? $data['id'] : 0);
//         $goods = Good::getGoods(isset($data['id']) ? $data['id'] : 0);
        
//         return ['subcategories' => $categories, 'goods' => $goods, ];
//     }

//     public function goods($data){
        
//         if($data['id'] > 0){
//             $good = new Good([
//                 "id_good" => $data['id']
//             ]);
//             //print_r($good->getGoodInfo()[0]);
//             return $good->getGoodInfo()[0];
           
//         }
//         else{
//             header("Location: /catalog/");
//         }     
//     }
//     public function add($data){
//         $_GET['asAjax'] = true;
//         Catalog::add(isset($data['id']) ? $data['id'] : 0);
//     }
//     public function check($data){
//         $_GET['asAjax'] = true;
//         $goods = Basket::check(isset($data['id']) ? $data['id'] : 0);
//         return $goods;
//     }
// }
// ?>