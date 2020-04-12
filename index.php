<? 
    //1е, 2e, 3е  задание
    class item {
        private $title;
        private $price;
        private $color;
        private $quantity;
        private $weight;
        function __constructor($title, $price, $color, $quantity, $weight){
            $this->title = $title;
            $this->price = $price;
            $this->color = $color;
        }
        public function changeQuntity(){
            $this->quantity ++ ;//Изменение колличества
        }
        public function changeColor($colorParam){
            $this->color = $colorParam; //Изменение цвета
        }

    }

    //4е задание

    class ItemCart extends Item {
        private $availability; // Наследник отличается от родителя свойством доступности в каком либо магазине
        function __construct($title, $price, $color, $quantity, $weight ,$availability){
            parent::__construct($title, $price, $color, $quantity, $weight);
            $this->availability = $speed;
        }
        public function creatingAnOrder(){
            //И добавлен метод формирования заказа
        }
    }

    //5е задание
    //Ответ, будет выведено 1234, потому что $x задан статичным, и не будет создаваться заново при каждом вызове функции foo а будет увелечен на единицу
    // class A { 
    //     public function foo() {
    //         static $x = 0;
    //         echo ++$x;
    //     }
    // }
    // $a1 = new A();
    // $a2 = new A();
    // $a1->foo();
    // $a2->foo();
    // $a1->foo();
    // $a2->foo();
    
    //6е задание 
    //Ответ, будет выведено 1122, т.к обьект $b1 создан от класса B который наследуется от класса A и соответственно вызов метода foo обьекта b1 не будет влиять на обьект a1 который создан от класса A
    // class A {
    //     public function foo() {
    //         static $x = 0;
    //         echo ++$x;
    //     }
    // }
    // class B extends A {
    // }
    // $a1 = new A();
    // $b1 = new B();
    // $a1->foo(); 
    // $b1->foo(); 
    // $a1->foo(); 
    // $b1->foo();

    ?>