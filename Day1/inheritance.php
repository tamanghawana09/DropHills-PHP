<?php
    class Fruit{
        public $name;
        public $color;
        public function __construct($name, $color){
            $this->name = $name;
            $this->color = $color;
        }
        public function intro(){
            echo "The fruit is {$this->name} and the color is {$this->color}.";
        }
        protected function apple(){
            echo "One apple a day keeps the doctor away";
        }
    }

    //apple is the inherited class of the Fruit
    class Apple extends Fruit{
        public function message(){
            echo "Am I a fruit or a test material<br>";
            //Call the protected method from within derived class - OK
            $this->apple();

        }
    }
    $apple = new Apple("Apple","red");
    $apple->message();
    echo "<br>";
    $apple->intro();
    echo "<br>";
    #$apple->apple(); // shows error because the apple function is protected
?>