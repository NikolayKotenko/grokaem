<?php
require_once 'init.php';

$obj = new ThreeChapter();

//echo($obj->recursion(10));
echo($obj->great('maggie'));

class ThreeChapter
{
    /**
     *  В каждой рекурсивной функции долгжго быть два случая: базовый и реурсивный.
     *  Стек поддерживает две операции: занесение и извлечение элементов.
     *  Все вызовы функций сохраняются в стек вызовов
     */
    public function recursion(int $i)
    {
        print_c($i);
        if ($i <= 0){
            return false;
        }
        else{
            $this->recursion($i-1);
        }
    }
    public function great(string $name): void
    {
        print_c('hello '.$name);
        $this->great2($name);
        print_c('getting ready to say bye...');
        $this->bye();
    }
    public function great2(string $name): void
    {
        print_c('how are you '. $name);
    }
    public function bye(): void
    {
        print_c('ok, bye');
    }
}