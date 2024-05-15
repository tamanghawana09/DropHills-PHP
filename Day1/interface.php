<?php
    interface Animal{
        public function makeSound();
    }

    class Cat implements Animal{
        public function makeSound(){
            echo "Cat makes meow sound";
        }
    }
    class Dog implements Animal{
        public function makeSound(){
            echo "Dog barks";
        }
    }
    class Mouse implements Animal{
        public function makeSound(){
            echo "Mouse squeak";
        }
    }
    
    $cat = new Cat();
    $dog = new Dog();
    $mouse = new Mouse();

    $animals = array($cat,$dog,$mouse);     // array of an object

    foreach($animals as $animal){
        $animal->makeSound();
    }
?>