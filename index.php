<?
    abstract class Good{
        private $title;
        private $quantity;
        private $price;
        const COST = 40;

        public function getTitle(){
            return $this->title;
        }

        public function setTitle($title){
            return $this->title=$title;
        }
        public function getPrice(){
            return $this->price;
        }
        public function getQuantity(){
            return $this->quantity;
        }
        public function setQuantity($quantity){
            return $this->quantity = $quantity;
        }

        abstract function finalPrice();
        
        abstract function render();

        public function profit(){
           return $this->finalPrice()-(($this->finalPrice()*self::COST)/100);
        }
        
    }

    class GoodDigital extends Good{
        
        const PRICE = 10000;
        

        public function __construct($title, $quantity){
            $this->title=$title;
            $this->quantity=$quantity;
            $this->setPrice(); 
        }
        public function setPrice(){
            return $this->price = self::PRICE;
        }
        public function finalPrice(){
            return $this->quantity*$this->price;
        }
        public function render(){
            echo $this->title." 1шт стоит".$this->price."руб колличество ".$this->quantity." итого: ".$this->finalPrice()." Чистая прибыль = ".$this->profit()."руб <br>";
        }

    }

    class GoodPiece extends Good{
        
        public function __construct($title, $quantity){
            $this->title=$title;
            $this->quantity=$quantity;
            $this->setPrice(); 
        }
        public function finalPrice(){
            return $this->quantity*$this->price;
        }
        public function setPrice(){
            return $this->price = GoodDigital::PRICE*2;
        }
        public function render(){
            echo $this->title." стоит ".$this->price."руб, колличество ".$this->quantity." итого: ".$this->finalPrice()." Чистая прибыль = ".$this->profit()."руб <br>";
        }
    }


    class GoodWeight extends Good{
        
        private $weight;

        public function __construct($title, $quantity, $price){
            $this->title=$title;
            $this->price = $price;
            $this->quantity = $quantity; 
        }
        public function finalPrice(){
            return $this->quantity*$this->price;
        }
        
        public function render(){
            echo $this->title." стоит ".$this->price."руб за кг, колличество".$this->quantity."кг, итого: ".$this->finalPrice()." Чистая прибыль = ".$this->profit()."руб <br>";
        }

    }

    $lessons = new GoodDigital("Онлайн уроки", 2);
    $lessons->render();

    $laptop = new GoodPiece("Ноутбук", 3);
    $laptop->render();

    $cement = new GoodWeight("Цемент", 50, 300);
    $cement->render();

?>

