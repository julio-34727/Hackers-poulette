<?php 

$title = basename($_SERVER['SCRIPT_FILENAME'], '.php');
$title = str_replace('_', ' ', $title);

if ($title == 'index') {$title = 'Home';}
$title = ucwords($title);

?>

<meta charset="UTF-8" />
<meta name="viewport"
        content="width=device-width, initial-scale=1.0" />
<meta http-equiv="X-UA-Compatible" content="ie=edge" />
<meta name="author" content="Julio ZINGA" />
<meta name="keywords" content="hackers, poulette, PHP, variables, arrays, forms, HTML, CSS, javascript" />
<meta name="description" content="formulaire de contact" />
<title>Hackers-poulette | <?= $title ?></title>