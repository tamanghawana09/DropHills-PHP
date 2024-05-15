<?php
    //class creation
    class Car{
        public $color;
        public $model;
        public function __construct($color,$model){
            $this->color = $color;
            $this->model = $model;
        }
        public function message(){
            return " My car is $this->color and the model is  $this->model";
        }
        public function __destruct(){
            echo "Destructed";
        }
    }
    //object creation
    $myCar = new Car("red","Volvo");
    echo "<br>";
    echo $myCar->message();
    
    
    var_dump($myCar);
?>