<?php
require_once 'init.php';


$obj = new SeventhChapter();

class SeventhChapter
{
    static array $graph = [];
    static array $costs = [];
    static array $parents = [];

    static array $processed = [];

    public function __construct()
    {
        /* Сами графы */
        self::$graph["start"]["a"] = 6;
        self::$graph["start"]["b"] = 2;

        self::$graph["a"]["fin"] = 1;
        self::$graph["b"]["a"] = 3;
        self::$graph["b"]["fin"] = 5;

        self::$graph["fin"] = [];

        /* Таблица родителей */
        self::$parents["a"] = "start";
        self::$parents["b"] = "start";
        self::$parents["in"] = NAN;

        /* Таблица стоимостей */
        self::$costs["a"] = 6;
        self::$costs["b"] = 2;
        self::$costs["fin"] = INF;

        $this->DijkstraAlgorithm();


        print_c('$processed - ');
        debug(self::$processed);
    }

    /**
     * Алгоритим дейстры не работает с отрицательными ребрами! Для этого существует алгоритм Беллмана - Форда.
    */
    public function DijkstraAlgorithm()
    {

        $node = $this->findLowestCostNode(self::$costs);
        while (!is_nan($node)){
            $cost = self::$costs[$node]; // $costs["b"] = 2;
            $neighbors = self::$graph[$node];
            /*
            (
                [a] => 3
                [fin] => 5
            )
            */
//            debug($neighbors);
            foreach ($neighbors as $n => $neighbor){
//                print_c($neighbor);
                $new_cost = $cost + $neighbor;
                if (self::$costs[$n] > $new_cost){
                    self::$costs[$n] = $new_cost;
                    self::$parents[$n] = $node;
                }
            }
            self::$processed[] = $node;
//            print_c('$processed');
//            print_r(self::$processed);
//            print_c('$parents');
//            print_r(self::$parents);
//            print_c('$node');
//            print_c($node);
            $node = $this->findLowestCostNode(self::$costs);
        }

    }
    public  function findLowestCostNode(array $costs)
    {
        $lowest_cost = INF;
        $lowest_cost_node = NAN;
        foreach ($costs as $key => $cost){
            if ($cost < $lowest_cost && (!in_array($key, self::$processed))){
                $lowest_cost = $cost;
                $lowest_cost_node = $key;
            }
        }
        return $lowest_cost_node;
    }
}