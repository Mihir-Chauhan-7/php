<?php
    $str='0,1,2,3,4,5,6,7';
    $tree=[];
    $count=1;
    for($i=1;$i<=6;$i++)
    {
        $i % 2 == 0 ? : $tree[$str[$i+1]]=array($str[($i*2)+2],$str[($i*2)+4]);
    }
    echo "<pre>";
    print_r($tree);
    echo "</pre>";
?>
    

?>