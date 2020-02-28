<?php

$data = [
    ['category' => 1, 'cName' => 'c1' , 'attribute' => 1 , 'aName' => 'a1', 'option' => 1, 'oName' => 'o1'],
    ['category' => 1, 'cName' => 'c1' , 'attribute' => 1 , 'aName' => 'a1', 'option' => 2, 'oName' => 'o2'],
    ['category' => 1, 'cName' => 'c1' , 'attribute' => 2 , 'aName' => 'a2', 'option' => 3, 'oName' => 'o3'],
    ['category' => 1, 'cName' => 'c1' , 'attribute' => 2 , 'aName' => 'a2', 'option' => 4, 'oName' => 'o4'],
    ['category' => 2, 'cName' => 'c2' , 'attribute' => 3 , 'aName' => 'a3', 'option' => 5, 'oName' => 'o5'],
    ['category' => 2, 'cName' => 'c2' , 'attribute' => 3 , 'aName' => 'a3', 'option' => 6, 'oName' => 'o6'],
    ['category' => 2, 'cName' => 'c2' , 'attribute' => 4 , 'aName' => 'a4', 'option' => 7, 'oName' => 'o7'],
    ['category' => 2, 'cName' => 'c2' , 'attribute' => 4 , 'aName' => 'a4', 'option' => 8, 'oName' => 'o8'],
];

$tree = [];

$tree['category'] = [];

foreach($data as $key => $value){
    $tree['category'][$value['category']]['cName'] = $value['cName'];
    $tree['category'][$value['category']]['attribute'][$value['attribute']]['aName'] = $value['aName'];
    $tree['category'][$value['category']]['attribute'][$value['attribute']]['option'][$value['option']]['oName'] = $value['oName'];
}

echo "<pre>";
print_r($tree);
?>