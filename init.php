<?php

function print_c($data){
    print_r($data.PHP_EOL);
}
function debug($data){
    echo '<pre>';
    print_r($data);echo '<br>';
    echo '</pre>';
}