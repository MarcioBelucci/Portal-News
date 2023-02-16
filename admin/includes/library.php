<?php
function category_validation($category, $description){
    return strlen($category) >= 2 && strlen($description) >= 15 && ctype_upper(substr($category, 0, 1));
}
?>