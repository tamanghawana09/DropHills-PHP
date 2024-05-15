<?php
    class Car{
        public $color;
        public $model;
        public function __construct($color,$model){
            $this->color = $color;
            $this->model = $model;
        }
    }
    $obj = new Car("Brown","RR");

    foreach($obj as $x => $y){
        echo "$x: $y<br>";
    }
?>