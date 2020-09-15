<?php
    class Admin extends Model {
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
    
        public static function createGood(){
            $data=[];
            $result = db::getInstance()->Select('SELECT * FROM  makers');
            $data['makers'] = $result;
            $result = db::getInstance()->Select('SELECT * FROM  category_goods');
            $data['category'] = $result;
            array_push($data, $result);
            return $data;
        }
        public static function addGoodToCatalog($post, $files){
            $category = $post['category'];
            $maker = $post['maker'];
            $model = $post['model'];
            $price = $post['price'];
            $info = $post['info'];
            $paths = self::createImg($post, $files);
            $pathSm = $paths['pathSmall'];
            $pathBg = $paths['pathBig'];
            $sql = "INSERT INTO shop (id_category, id_maker, model, price, info, small_img, big_img) VALUES ($category, $maker, '$model', $price, '$info', '$pathSm', '$pathBg')";
            db::getInstance()->Query($sql);
            return "Товар добавлен";
             
        }
        public static function saveChange($post){
            //$category = $post['category'];
            $maker = $post['maker'];
            $model = $post['model'];
            $price = $post['price'];
            $info = $post['info'];
            $idGood = $post['id_good'];
            $sql = "UPDATE shop SET model='$model', price=$price, info='$info' WHERE id_good_catalog=$idGood";
            db::getInstance()->Query($sql);
            return "Информация о товаре успешно изменена";
             
        }
        public static function removeGoodFromCatalog($id){
            $sql = "DELETE FROM shop WHERE id_good_catalog=$id";
            db::getInstance()->Query($sql);
            //$data = db::getInstance()->Select("SELECT cart.Id_good_cart, shop.id_good_catalog, makers.maker, shop.model, shop.price, shop.small_img, cart.quantity FROM cart NATURAL JOIN shop NATURAL JOIN makers");
           
             
        }
        public static function createImg($inf, $img){
            $pathForBigFoto="img/catalog/big_img";
            $pathForSmallFoto = "img/catalog/small_img";
            $nameForFile = self::translit($inf['model']);
            $nameForBigFile= $nameForFile."_Big.jpg";
            $nameForSmallFile = $nameForFile."_Small.jpg";
            $pathSmall = "$pathForSmallFoto/$nameForSmallFile";
            $pathBig = "$pathForBigFoto/$nameForBigFile";
            $tmp_name = $img["photo"]["tmp_name"];
            if(move_uploaded_file($tmp_name, $pathBig));
            self::img_resize($pathBig ,$pathSmall, 0 , 294 );
            return ['pathSmall'=>$pathSmall, 'pathBig'=>$pathBig];
        }
        public static function translit($s) {
            $s = (string) $s;
            $s = str_replace(array("\n", "\r"), " ", $s);
            $s = preg_replace("/\s+/", ' ', $s); 
            $s = trim($s); 
            $s = function_exists('mb_strtolower') ? mb_strtolower($s) : strtolower($s);
            $s = strtr($s, array('а'=>'a','б'=>'b','в'=>'v','г'=>'g','д'=>'d','е'=>'e','ё'=>'e','ж'=>'j','з'=>'z','и'=>'i','й'=>'y','к'=>'k','л'=>'l','м'=>'m','н'=>'n','о'=>'o','п'=>'p','р'=>'r','с'=>'s','т'=>'t','у'=>'u','ф'=>'f','х'=>'h','ц'=>'c','ч'=>'ch','ш'=>'sh','щ'=>'shch','ы'=>'y','э'=>'e','ю'=>'yu','я'=>'ya','ъ'=>'','ь'=>''));
            $s = preg_replace("/[^0-9a-z-_ ]/i", "", $s);
            $s = str_replace(" ", "-", $s);
            return $s; 
        }
        public static function img_resize($src, $dest, $width, $height, $rgb = 0xFFFFFF, $quality = 100){  
            if (!file_exists($src))
                return false;
        
            $size = getimagesize($src);
            
            if ($size === false)
                return false;
        
            $format = strtolower(substr($size['mime'], strpos($size['mime'], '/') + 1));
            $icfunc = 'imagecreatefrom'.$format;
            
            if (!function_exists($icfunc))
                return false;
        
            $x_ratio = $width  / $size[0];
            $y_ratio = $height / $size[1];
            
            if ($height == 0)
            { 
                $y_ratio = $x_ratio;
                $height  = $y_ratio * $size[1];
            }
            elseif ($width == 0)
            { 
                $x_ratio = $y_ratio;
                $width   = $x_ratio * $size[0];
            }
            
            $ratio       = min($x_ratio, $y_ratio);
            $use_x_ratio = ($x_ratio == $ratio);
            
            $new_width   = $use_x_ratio  ? $width  : floor($size[0] * $ratio);
            $new_height  = !$use_x_ratio ? $height : floor($size[1] * $ratio);
            $new_left    = $use_x_ratio  ? 0 : floor(($width - $new_width)   / 2);
            $new_top     = !$use_x_ratio ? 0 : floor(($height - $new_height) / 2);
            
            // если не нужно увеличивать маленькую картинку до указанного размера
            if ($size[0]<$new_width && $size[1]<$new_height)
            {
                $width = $new_width = $size[0];
                $height = $new_height = $size[1];
            }
        
            $isrc  = $icfunc($src);
            $idest = imagecreatetruecolor($width, $height);
            
            imagefill($idest, 0, 0, $rgb);
            imagecopyresampled($idest, $isrc, $new_left, $new_top, 0, 0, $new_width, $new_height, $size[0], $size[1]);
        
            $i = strrpos($dest,'.');
            if (!$i) return '';
            $l = strlen($dest) - $i;
            $ext = substr($dest,$i+1,$l);
            
            switch ($ext)
            {
                case 'jpeg':
                case 'jpg':
                imagejpeg($idest,$dest,$quality);
                break;
                case 'gif':
                imagegif($idest,$dest);
                break;
                case 'png':
                imagepng($idest,$dest);
                break;
            }
        
            imagedestroy($isrc);
            imagedestroy($idest);
        
            return true;  
        }
    
    }

?>