<?php
require_once 'init.php';


$graph = [
    'you' => ['acile', 'bob', 'claire'],
    'bob' => ['anuj', 'peggy'],
    'alice' => ['peggy'],
    "claire" => [
        "jonny", "thom"
    ],
    "anuj" => [],
    "peggy" => [],
    "jonny" => []
];
$obj = new SixthChapter();
$obj->breadthSearch($graph);
debug($obj->res);

class SixthChapter
{
/**
 * Поиск в ширину
 *
 * Если поиск продавца манго был выполнен по всей сети, значит вы прошли по каждому ребру (ребром называется соединительная
 * линия или линия со стрелкой, ведущая от одного человека к другому)
 * Таким образом, время выполнения составит как минимум - О (количество ребер)
 *
 * Также в программе должна хранится очередь поиска. Добавление одного человека в очередь выполняется за
 * постоянное время: О(1). Выполнение операций для каждого человека потребует суммарного времени О (количество людей).
 *
 * Поиск в ширину выполняется за время О (кол-во людей + кол-во ребер),
 * что записывается по формуле O (V + E), V - кол-во вершин, Е - кол-во ребер.
*/
    public array $res = [];

    function breadthSearch($graph)
    {
//        debug($graph);
        $key = array_key_first($graph);

        if (!empty($key)) {
            $this->res[] = $key;

            if (stripos($key, 'm') != 0) {
                $this->res[] = [
                        '$key' => $key,
                        'message' => 'ПОПАЛСЯ ПРОДАВЕЙ МАНГИ!',
                ];
                return false;
            }
            else {
                /* Достаем первый элемент */
                $shift_elem = array_shift($graph);
                /* Гуляем по массиву */
                foreach ($shift_elem as $value2){
                    /* Если этого значения нет в основном массиве, пишем в первый уровень графа */
                    $check_exist_in_arr = !in_array($value2, array_keys($graph));
                    if ($check_exist_in_arr) {
                       $graph[$value2] = [];
                    }
                }

                $this->breadthSearch($graph);
            }
        }
    }
}