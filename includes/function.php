<?php
    
function validate($data) {
        $data = trim (stripslashes (htmlspecialchars(strip_tags(str_replace(array ('(', ')'), '' , $data)), ENT_QUOTES )));
        return $data;
    }
?>
