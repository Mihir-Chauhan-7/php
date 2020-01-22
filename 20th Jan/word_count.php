<?php
$str = "This is an Example String . & its functions";
echo str_word_count($str,0,"&.")."<br>";//return no of words  . will be considered a word
print_r(str_word_count($str,1,"&."));//return array of word as element

print_r(expression)r(str_word_count($str,2));//return associative-array of word as element with starting pos of each word as index
?>