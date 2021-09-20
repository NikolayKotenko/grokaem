<?php
require_once 'init.php';

$obj = new FourChapter();

//$obj->recursionSum([1,2,3,4]);
//$obj->recursionMaxInt([1,777,34,4]);
//debug($obj->quickSort([1,777,34,4]));
debug($obj->multiplicationTable([1,2,3,4]));
class FourChapter
{
    /**
     * "Разделяй и властвуй"
     *  1. С начала определяется базовый случай. Это должен быть простейший случай из всех возможных.
     *  2. Задача делится или сокращается до тех пор. пока не будет сведена к базовому случаю.
     */
    public $rec_sum = [];

    public function baseSum(array $arr): int
    {
        $sum = 0;
        foreach ($arr as $item){
            $sum += $item;
        }
        return $sum;
    }
    public function recursionSum(array $arr): void
    {
        if (isset($arr[0])){
            $first_elem = array_shift($arr);
            $this->rec_sum[] = $first_elem + array_sum($arr);
            $this->recursionSum($arr);
        }
        else{
            print_c($this->rec_sum[0]);
        }
    }
    public function recursionMaxInt(array $arr, int $cur_max_elem = 0): void
    {
        if (isset($arr[0])) {
            $first_elem = array_shift($arr);
            $max = ($first_elem > $cur_max_elem) ? $first_elem : $cur_max_elem;
//            print_c($max);
            $this->recursionMaxInt($arr, $max);
        }
        else{
            print_c($cur_max_elem);
        }
    }
    /**
     * Скорость зависит от выбора опорного элемента $pivot;
     * Если выбирать опорным элементом случайный элемент в массиве это будет лучшим выбором (он же средний)
     * Поэтому  - O (n * log n)
    */
    public function quickSort(array $arr): array
    {
        $count= count($arr);

        if ($count < 2){
            return $arr;
        }
        else{
            $pivot = $arr[0];
            $left_arr = [];
            $right_arr = [];

            for ($i = 1; $i < $count; $i++)
            {
                if ($arr[$i] < $pivot) {
                    $left_arr[] = $arr[$i];
                }
                else{
                    $right_arr[] = $arr[$i];
                }
            }

            $left_arr = $this->quickSort($left_arr);
            $right_arr = $this->quickSort($right_arr);
        }
        return array_merge($left_arr, [$pivot], $right_arr);
    }
    public function multiplicationTable(array $arr)
    {
        $length_arr = count($arr);
        $multi = [];

        for ($i =0; $i <= $length_arr; $i++)
        {
            if ($length_arr === $i) {
                return $arr;
            }
            else{
                $next_elem = ($i !== 0) ? $arr[$i + 1] : $arr[$i];
                $multi[] = $arr[$i] * $next_elem;
                $this->multiplicationTable($multi);
            }
        }
    }
}