<?php 

## Fonctions de vérification d'un champ du formulaire
function isValidField($field, $value) {
    # First name & last name: 
    #    - (2-32) lettres d'alphabet en unicode (french, dutch, english, spanish...)
    #    - nomps composés avec tirets, espaces et apostrophes
    # Email: <=320 caractères au format email (standard RFC 5321)
    # Comments: texte avec >= 1 caractère (pas d'espaces au début)
    if (in_array($field, ['firstname', 'lastname'])) {
        $regex = "/^[\p{L}]+([\ \'](?:\p{L}+))?([\ \'\-](?:\p{L}+))*$/u";
        $out = preg_match($regex, $value) && strlen($value) > 1 && strlen($value) <= 32;
    }
    elseif ($field === 'email') {
        $regex1 = "/(\.{2}|-{2}|_{2})/";
        $regex2 = "/^[a-z0-9][a-z0-9-_\.]+@([a-z]|[a-z0-9]?[a-z0-9-]+[a-z0-9])\.[a-z0-9]{2,10}(?:\.[a-z]{2,10})?$/i";
        $out = !preg_match($regex1, $value) && preg_match($regex2, $value) && strlen($value) <= 320;
    }
    elseif (in_array($field, ['gender', 'country', 'subject'])) {$out = boolval($value);}
    elseif ($field === 'comments') {$out = strlen($value) >= 1;}

    return $out;
}

function enableFieldErrors($post) {
    if (count($post) > 2) {return 'style="display: block;"';}
}

## Fonctions d'affichage des messages d'erreur
function printFixErrors($post) {
    if ($post['missing'] || $post['errors']) {
        return '<p class="error">*Please fix the item(s) indicated in red.</p>';
    }
}

function printFieldErrors($post, $field, $errorMsg) {
    if (count($post) == 2) {$out = '';}
    elseif (in_array($field, $post['missing'])) {$out = '<span class="error">empty field &#10007;</span>';}
    elseif (in_array($field, $post['errors'])) {$out = $errorMsg;}
    else {$out = '<span class="correct">valid field &#10004;</span>';}

    return $out;
}

function printFirstnameFieldErrors($post) {
    $errorMsg = '<span class="error">only unicode letters (2-32 chars) &amp; compound names &#10007;</span>';
    return printFieldErrors($post, 'firstname', $errorMsg);
}

function printLastnameFieldErrors($post) {
    $errorMsg = '<span class="error">only unicode letters (2-32 chars) &amp; compound names &#10007;</span>';
    return printFieldErrors($post, 'lastname', $errorMsg);
}

function printEmailFieldErrors($post) {
    $errorMsg = '<span class="error">invalid email format (RFC 5321) &#10007;</span>';
    return printFieldErrors($post, 'email', $errorMsg);
}

function printGenderFieldErrors($post) {
    $errorMsg = '<span class="error">no button checked &#10007;</span>';
    return printFieldErrors($post, 'gender', $errorMsg);
}

function printCountryFieldErrors($post) {
    $errorMsg = '<span class="error">no selection in the drop list &#10007;</span>';
    return printFieldErrors($post, 'country', $errorMsg);
}

function printSubjectFieldErrors($post) {
    $errorMsg = '<span class="error">no selection in the drop list &#10007;</span>';
    return printFieldErrors($post, 'subject', $errorMsg);
}

function printCommentsFieldErrors($post) {
    $errorMsg = '<span class="error">type your comments please (1-200 chars) &#10007;</span>';
    return printFieldErrors($post, 'comments', $errorMsg);
}

## Fonctions pour retenir la saisie de l'utilisateur
function preserveFirstnameInputs($post) {
    if ($post['missing'] || $post['errors']) {return 'value="'.htmlentities($post['firstname']).'"';}
}

function preserveLastnameInputs($post) {
    if ($post['missing'] || $post['errors']) {return 'value="'.htmlentities($post['lastname']).'"';}
}

function preserveEmailInputs($post) {
    if ($post['missing'] || $post['errors']) {
        $email = filter_var($post['email'], FILTER_SANITIZE_EMAIL); //nettoyage (caractères interdits)
        return 'value="'.$email.'"';
    } 
}

function preserveGenderChoice($post, $currValue) {
    if (($post['missing'] || $post['errors']) && ($post['gender'] === $currValue)) {
        return 'checked';
    }  
}

function preserveCountryChoice($post, $currValue) {
    if (($post['missing'] || $post['errors']) && ($post['country'] === $currValue)) {
        return 'selected';
    }    
}

function preserveSubjectChoice($post, $currValue) {
    if (($post['missing'] || $post['errors']) && ($post['subject'] === $currValue)) {
        return 'selected';
    }  
}

function preserveCommentsInputs($post) {
    if ($post['missing'] || $post['errors']) {return htmlentities($post['comments']);}
}

?>