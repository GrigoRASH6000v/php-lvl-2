<?php

class Catalog extends Model {
    protected static $table = 'categories';

    protected static function setProperties()
    {
        self::$properties['name'] = [
            'type' => 'varchar',
            'size' => 512
        ];

        self::$properties['parent_id'] = [
            'type' => 'int',
        ];
    }

    public static function getCatalog(){
        //return db::getInstance()->Select("SELECT shop.id_good_catalog, makers.maker, shop.model, shop.price, shop.small_img FROM shop NATURAL JOIN makers");
        // return db::getInstance()->Select(
        //     'SELECT id_category, name FROM categories WHERE status=:status AND parent_id = :parent_id',
        //     ['status' => Status::Active, 'parent_id' => $parentId]);
    }
    public static function add($id){
        $query = "INSERT INTO cart (id_good_catalog) VALUES ($id)";
        db::getInstance()->Query($query);
        
    }

}