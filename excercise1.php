<?php
//Этап 1

$numbers = [1,2,3,4,5];
$sum = 0;

foreach($numbers as $number){
    
    $sum+=$number;
}

print_r("1.Сумма чисел массива равна: {$sum}");  
echo "\n\n";


//Этап 2 

$numbers = [2,4,6,8,10];

echo "2.Четные числа массива: ";

foreach($numbers as $number){
    
    if($number%2===0){

        echo $number . " ";

    }
    
}

echo "\n\n";


//Этап 3

$numbers = [1,3,5,7,9];

echo "3.Нечетные числа массива: ";

foreach($numbers as $number){

    if($number%2!==0){

        echo $number . " ";

    }
}

echo "\n\n";


//Этап 4

$numbers = [1,2,3,4,5,6,7,8,9,10];

echo "4.1.Простые числа массива: ";

$counter = 0;

foreach($numbers as $number){
    if(isPrime($number)){

        echo $number . " ";

        $counter++;

    }
}
print_r("\n4.2.Количество простых чисел в массиве: {$counter}");

function isPrime($number){
    if($number<2){

        return false;
    }
    if ($number==2){

        return true;
    }
    if($number%2===0){

        return false;

    }
    for($i = 2;$i <= $number / 2;$i++){

        if($number % $i === 0){

            return false;
        }
    }
    return true;
}