<div class="footer-text"><h5>&copy; Mihir Chauhan</h5></div>
<?php   
    echo "<br>";
    foreach($this->getChild() as $singleChild):
        echo $singleChild->toHTML();
    endforeach; 
?>