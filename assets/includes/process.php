<?php

foreach ($_POST as $field => $value) 
{
    if (!is_array($value)) {$value = trim($value);}
    if (in_array($field, $required) && !$value) 
    {
        $missing[] = $field;
        ${$field} = ''; //create new variables dynamically (accessible in the DOM)
    }
    else {${$field} = $value;}
}


?>