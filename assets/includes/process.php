<?php

## Anti-sapm (honeypot)
if (strlen($_POST['color']) > 1) {
    header('Location: ./assets/includes/404.php');
    exit;
}

## Reglages 
#    - Valeur par défaut '' si le champ 'radio-btn' n'est pas coché (opérateur null coalescent ??)
#    - nettoyage du champ email (SANITIZE)
$required = ['firstname', 'lastname', 'email', 'gender', 'country', 'subject', 'comments'];
$_POST['gender'] = $_POST['gender'] ?? ''; 
$_POST['email'] = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

## Redirige vers la page 404.php si le champ (pot de miel) est rempli
if (strlen($_POST['color'])>1) {
    header('Location: ./assets/includes/404.php');
    exit;
}

## Remplissage du tableau $_SESSION
foreach ($_POST as $field => $value) {
    if (!is_array($value)) {$value = trim($value);}     # supprime les espaces début/fin (not array)
    if (in_array($field, $required) && empty($value)) { # champ vide (manquant)
        $post['missing'][] = $field;        
        $post[$field] = '';     
    }
    elseif (in_array($field, $required) && !isValidField($field, $value)) {
        $post['errors'][] = $field; 
        $post[$field] = $value;
    }
    else {$post[$field] = $value;}
}

## Redirige vers la page de remerciements (si pas d'erreurs)
if (empty($post['missing']) && empty($post['errors'])) {
    header('Location: ./assets/includes/thanks.php');
    exit;
}

?>