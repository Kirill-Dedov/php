<?php

class Product {

    public $id;
    public $code;
    public $name;
    public $sort;

    public function __construct($id,$code,$name,$sort=0){

        $this->id = $id;
        $this->code = $code;
        $this->name = $name;
        $this->sort = $sort;

    }
    
}
$productsData = [

    [1,"a111","Телефон",1],
    [2,"a222","Монитор",2],
    [3,"a333","Клавиатура",3],
    [4,"a444","Мышка",3],
    [5,"a555","Часы",3],
    [6,"a666","Лампа",5],
    [7,"a777","Стол",100],
    [8,"a888","Ноутбук",150],
    [9,"a999","Переходник",150],
    [10,"b111","Кабель",150]

];

$products = [];


foreach($productsData as $data){

    $products[] = new Product($data[0],$data[1],$data[2],$data[3]);

}



class ProductRepository{
    
    public $products;

    public function __construct($products){

        $this->products = $products;

    }
    
    public function printList($products){
        
        foreach($products as $product){

             echo "• {$product->name} | код: {$product->code} | сортировка: {$product->sort}\n";

        }
        
    }

    public function displaySortedBySort(){

        $sorted = $this->products;
        $count = count($sorted);

        for($i = 0;$i < $count - 1; $i++){

            for($j = 0;$j < $count - $i - 1;$j++){

                if($sorted[$j]->sort > $sorted[$j + 1]->sort){

                    $temp = $sorted[$j];
                    $sorted[$j] = $sorted[$j + 1];
                    $sorted[$j + 1] = $temp;

                }
            }
        }

        echo "Сортировка по sort:\n";
        $this->printList($sorted);

    }

    public function displaySortedByName(){

        $sorted = $this->products;
        $count = count($sorted);

        for($i = 0; $i < $count - 1; $i++){

            for($j = 0; $j < $count - $i - 1;$j++){

                if(strcmp($sorted[$j]->name,$sorted[$j + 1]->name)>0){

                    $temp = $sorted[$j];
                    $sorted[$j] = $sorted[$j + 1];
                    $sorted[$j + 1] = $temp;

                }

            }
            
        }

        echo "Сортировка по name:\n";
        $this->printList($sorted);

    }

}

$repository = new ProductRepository($products);
$repository->displaySortedByName();
echo "\n";
$repository->displaySortedBySort();