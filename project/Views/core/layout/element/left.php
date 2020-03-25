<h5 style="text-align: center;color: whitesmoke">LEFT</h5>
<?php
    foreach($this->getChild() as $singleChild):
        echo $singleChild->toHTML();
    endforeach; 
?>