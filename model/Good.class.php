<?php

class Good extends Model {
    protected static $table = 'shop';

    protected static function setProperties()
    {
        self::$properties['id_good'] = [
            'type' => 'int'
        ];

        self::$properties['name'] = [
            'type' => 'varchar',
            'size' => 512
        ];

        self::$properties['price'] = [
            'type' => 'float'
        ];

        self::$properties['description'] = [
            'type' => 'text'
        ];

        self::$properties['category'] = [
            'type' => 'int'
        ];
    }
    public static function getGoodsForBasket($categoryId)
    {
        //self::$table="cart";
        //$data = db::getInstance()->Select("SELECT shop.id_good_catalog, makers.maker, shop.model, shop.price, shop.small_img FROM $table NATURAL JOIN makers");
        $data = db::getInstance()->Select("SELECT cart.Id_good_cart, shop.id_good_catalog, makers.maker, shop.model, shop.price, shop.small_img, cart.quantity FROM cart NATURAL JOIN shop NATURAL JOIN makers");
        //print_r(self::$table);
        return $data;
        
    }

    public static function getGoods($categoryId)
    {
        $table=self::$table;
        $data = db::getInstance()->Select("SELECT shop.id_good_catalog, makers.maker, shop.model, shop.price, shop.small_img FROM $table NATURAL JOIN makers");
        //print_r(self::$table);
        return $data;
        
        // return db::getInstance()->Select(
        //     'SELECT id_good, id_category, `name`, price FROM goods WHERE id_category = :category AND status=:status',
        //     ['status' => Status::Active, 'category' => $categoryId]);
    }
    

    public function getGoodInfo(){
        //self::$properties['id_good']=8;
        //print_r ((int)$this->id_good);
        $id = (int)$this->id_good;
        return db::getInstance()->Select("SELECT shop.id_good_catalog, makers.maker, shop.model, shop.price, shop.big_img, shop.info FROM shop NATURAL JOIN makers WHERE id_good_catalog = $id");
        
        //SELECT shop.id_good_catalog, makers.maker, shop.model, shop.price, shop.big_img FROM shop NATURAL JOIN makers WHERE id_good_catalog  = 44
            
        // return db::getInstance()->Select(
        //     'SELECT * FROM goods WHERE id_good = :id_good',
        //     ['id_good' => (int)$this->id_good]);
            
    }

    public static function getGoodPrice($id_good){
        $result = db::getInstance()->Select('SELECT price FROM shop WHERE id_good_catalog = :id_good',['id_good' => $id_good]);

        return (isset($result[0]) ? $result[0]['price'] : null);
    }
    
   
}