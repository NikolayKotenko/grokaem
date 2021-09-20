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
                $shift_elem = array_shift($graph);
                $flip = array_flip($shift_elem);

                foreach ($flip as $key2 => $value2){
                    $check_exist_in_arr = !in_array($key2, array_keys($graph));
                    if ($check_exist_in_arr) {
                       $graph[$key2] = [];
                    }
                }

                $this->breadthSearch($graph);
            }
        }
    }
}