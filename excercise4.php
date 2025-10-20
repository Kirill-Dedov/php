<?php

/*Задача. Нужно создать класс, который описывает фигуру квадрат. Класс должен содержать метод square (площадь),
 * которая считает собственно площадь квадрата. Как результат задачи - написать класс, инициализировать его и посчитать площадь заданного квадрата
 */

class Square{    

    public $side;

    public function __construct($side){

    $this->side = $side;

    }

    public function getArea(){
        
        $area =  $this->side ** 2;

        return "The area of a square with a side {$this->side} is {$area}. ";        

    }
}

class Square2{

   public function calculateArea($side){

    $area = $side ** 2;

    return "The area of a square with a side {$side} is {$area}. ";

   }
}

$sqr = new Square(3.3);
echo $sqr->getArea();

$sqr2 = new Square2();
echo "\n" . $sqr2->calculateArea(3.3);