<?php

// Populate missing and errors values
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

// Validate email user
// if (isset($_POST['email']) && !empy($_POST['email'])) 
// {
//     $validemail = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
//     if ($validemail) {$headers[] = "Reply-To: $validemail";} 
//     else {$errors['email'] = true;}

// }

// $mailSent = false;

// if (!$missing && !$errors) 
// {
//     $message = ''; //initialization
//     foreach($required as $field) 
//     {
//         if (isset(${$field}) && !empty(${$field})) {$value = ${$field};} 
//         else {$value = 'Not selected';}

//         if (is_array($value)) {$val = implode(', ', $value);}

//         $field = str_replace('_', ' ', $field);

//         $message .= ucfirst($field).": $val\r\n\r\n";
//     }

//     $message = wordwrap($message, 70);    //70 characters max for a line
//     $headers = implode("\r\n", $headers); //formatting headers into a single string

//     $mailSent = mail($to, $subject, $message, $headers);

//     if (!$mailSent) {$errors['mailfail'] = true;}
// }



?>