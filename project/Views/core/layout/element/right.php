<h5 style="text-align: center;color: whitesmoke">RIGHT</h5>
<?php
    foreach($this->getChild() as $singleChild):
        echo $singleChild->toHTML();
    endforeach; 
?>