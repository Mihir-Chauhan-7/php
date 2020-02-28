<?php

$data = [
    ['a' => 1, 'c' => 1, 'o' => 1],
    ['a' => 1, 'c' => 1, 'o' => 2],
    ['a' => 1, 'c' => 2, 'o' => 3],
    ['a' => 1, 'c' => 2, 'o' => 4],
    ['a' => 2, 'c' => 3, 'o' => 5],
    ['a' => 2, 'c' => 3, 'o' => 6],
    ['a' => 2, 'c' => 4, 'o' => 7],
    ['a' => 2, 'c' => 4, 'o' => 8]
];


$tree = [];
// for($i = 0; $i < sizeof($data) ; $i++){   

//     $tree[$data[$i]['a']][$data[$i]['c']][$data[$i]['o']] = $data[$i]['o'];
// }

foreach($data as $value){
    $tree[$value['a']][$value['c']][$value['o']] = $value['o'];
}
echo "<pre>";
print_r($tree);
?>