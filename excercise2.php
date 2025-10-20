<?php

class Product
{
    public $id;
    public $code;
    public $name;
    public $sort;

    public function __construct($id, $code, $name, $sort = 0)
    {
        $this->id = $id;
        $this->code = $code;
        $this->name = $name;
        $this->sort = $sort;
    }
}
$productsData = [
    [1, 'a111', 'Телефон', 1],
    [2, 'a222', 'Монитор', 2],
    [3, 'a333', 'Клавиатура', 3],
    [4, 'a444', 'Мышка', 3],
    [5, 'a555', 'Часы', 3],
    [6, 'a666', 'Лампа', 5],
    [7, 'a777', 'Стол', 100],
    [8, 'a888', 'Ноутбук', 150],
    [9, 'a999', 'Переходник', 150],
    [10, 'b111', 'Кабель', 150],
];

$products = [];

foreach ($productsData as $data) {
    $products[] = new Product($data[0], $data[1], $data[2], $data[3]);
}

class ProductRepository
{
    public $products;

    public function __construct($products)
    {
        $this->products = $products;
    }

    public function prepareList($products, $title)
    {
        $result = "{$title}\n";

        foreach ($products as $product) {
            $result .= "• {$product->name} | код: {$product->code} | сортировка: {$product->sort}\n";
        }

        return $result;
    }

    public function displaySortedBySort()
    {
        $sorted = $this->products;

        usort($sorted, fn ($a, $b) => $a->sort - $b->sort);

        return $this->prepareList($sorted, 'Сортировка по sort:');
    }

    public function displaySortedByName()
    {
        $sorted = $this->products;

        usort($sorted, fn ($a, $b) => strcmp($a->name, $b->name));

        return $this->prepareList($sorted, 'Сортировка по name:');
    }
}

$repository = new ProductRepository($products);
echo $repository->displaySortedByName();
echo "\n";
echo $repository->displaySortedBySort();
