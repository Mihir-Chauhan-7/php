<?php   
    foreach($this->getChild() as $singleChild):
        echo $singleChild->toHTML();
    endforeach; 
?>