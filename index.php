<?php

## Inclusion des fonctions et du tableau des continents/pays
require('./assets/includes/functions.php');
include('./assets/includes/arrays.php');

## Tableau $post (valeurs manquantes, erreurs, champs requis...)
$post['missing'] = [];
$post['errors'] = [];

## Traitement pour chaque soumission (bouton SEND) du formulaire (process.php)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {   # on ne peut traiter que le formulaire envoyé par notre serveur
    require('./assets/includes/process.php'); # inclusion de la page de traitement du formulaire
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('./assets/includes/metadata.php'); ?>
    <link rel="shortcut icon" href="./assets/img/hackers-poulette-logo.png" type="image/png" sizes="16x16" />
    <link rel="stylesheet" href="./assets/css/style.css" />
</head>
<body>
    <header id="header">
        <h1>Hackers Poulette Sprl</h1>
    </header>
    <main id="main">
        <section class="section">
            <header class="section__head">
                <a href="index.php" id="logo">
                    <img src="./assets/img/hackers-poulette-logo.png" alt="Hackers poulette logo">
                    <div id="edit-icon"><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="edit" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M402.6 83.2l90.2 90.2c3.8 3.8 3.8 10 0 13.8L274.4 405.6l-92.8 10.3c-12.4 1.4-22.9-9.1-21.5-21.5l10.3-92.8L388.8 83.2c3.8-3.8 10-3.8 13.8 0zm162-22.9l-48.8-48.8c-15.2-15.2-39.9-15.2-55.2 0l-35.4 35.4c-3.8 3.8-3.8 10 0 13.8l90.2 90.2c3.8 3.8 10 3.8 13.8 0l35.4-35.4c15.2-15.3 15.2-40 0-55.2zM384 346.2V448H64V128h229.8c3.2 0 6.2-1.3 8.5-3.5l40-40c7.6-7.6 2.2-20.5-8.5-20.5H48C21.5 64 0 85.5 0 112v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V306.2c0-10.7-12.9-16-20.5-8.5l-40 40c-2.2 2.3-3.5 5.3-3.5 8.5z"></path></svg></div>
                </a>
                <h2>Contact Us</h2>
                <?= printFixErrors($post) ?>
            </header>
            <form method="post" action="index.php" class="section__body form">
                <p class="form__group">
                    <input type="text" class="form__input" name="firstname" id="firstname"  
                        <?= preserveFirstnameInputs($post) ?> autocomplete="none" placeholder="Your first name (2-32 chars)" />
                    <label for="firstname" class="form__label" <?= enableFieldErrors($post) ?>>
                        First name*: <?= printFirstnameFieldErrors($post) ?>
                    </label>
                    <label for="firstname" class="screen-reader screen-reader-focusable">First name></label>
                </p>
                <p class="form__group">
                    <input type="text" class="form__input" name="lastname" id="lastname" 
                        <?= preserveLastnameInputs($post) ?> autocomplete="none" placeholder="Your last name (2-32 chars)" />
                    <label for="lastname" class="form__label" <?= enableFieldErrors($post) ?>>
                        Last name*: <?= printLastnameFieldErrors($post) ?>
                    </label>
                    <label for="lastname" class="screen-reader screen-reader-focusable">Last name</label>
                </p>
                <p class="form__group">
                    <input type="text" class="form__input" name="email" id="email" 
                        <?= preserveEmailInputs($post) ?> autocomplete="none" placeholder="mail@example.com" />
                    <label for="email" class="form__label" <?= enableFieldErrors($post) ?>>
                        Email*: <?= printEmailFieldErrors($post) ?>
                    </label>
                    <label for="email" class="screen-reader screen-reader-focusable">Email*</label>
                </p>
                <p class="form__group honeypot">
                    <input type="text" class="form__input" name="color" id="color" 
                        autocomplete="none" tabindex="-1" placeholder="Your favorite color" />
                    <label for="color" class="form__label"></label>
                </p>
                <p class="form__group form__radio-group">
                    <input type="radio" class="form__radio-input" name="gender" id="gender-male" 
                        value="male" <?= preserveGenderChoice($post, 'male') ?> />
                    <label for="gender-male" class="form__radio-label">male</label>

                    <input type="radio" class="form__radio-input" name="gender" id="gender-female" 
                        value="female" <?= preserveGenderChoice($post, 'female') ?> />
                    <label for="gender-female" class="form__radio-label">female</label> 

                    <input type="radio" class="form__radio-input" name="gender" id="gender-other" 
                        value="other" <?= preserveGenderChoice($post, 'other') ?> />
                    <label for="gender-other" class="form__radio-label">other</label>

                    <label class="form__label" <?= enableFieldErrors($post) ?>>
                        Gender*: <?= printGenderFieldErrors($post) ?>
                    </label>
                    <label class="screen-reader screen-reader-focusable">Gender</label>
                </p>
                <p class="form__group">
                    <select name="country" class="form__select" id="country">
                        <option value="" default selected>--Choose a country--</option>
                        <?php 
                        foreach ($continents as $continent => $countries) { ?>
                            <optgroup label="<?= $continent ?>">
                            <?php 
                            foreach ($countries as $country) { ?>
                                <option value="<?= strtolower($country) ?>" <?= preserveCountryChoice($post, strtolower($country)) ?>>
                                    <?= $country ?>
                                </option>
                            <?php } ?>
                            </optgroup>
                        <?php } ?>
                    </select>
                    <label for="country" class="form__label" <?= enableFieldErrors($post) ?>>
                        Country*: <?= printCountryFieldErrors($post) ?>
                    </label>
                    <label for="country" class="screen-reader screen-reader-focusable">Country*</label>
                </p>
                <p class="form__group">
                    <select name="subject" class="form__select" id="subject">
                        <option value="" default selected>--Choose a subject--</option>
                        <?php 
                        foreach($subjects as $subject) {?>
                            <option value="<?= strtolower($subject) ?>" <?= preserveSubjectChoice($post, $subject) ?>>
                                <?= $subject ?>
                            </option>
                        <?php } ?>
                    </select>
                    <label for="subject" class="form__label" <?= enableFieldErrors($post) ?>>
                        Subject*: <?= printSubjectFieldErrors($post) ?>
                    </label>
                    <label for="subject" class="screen-reader screen-reader-focusable">Subject</label>
                </p>
                <p class="form__group">
                    <textarea class="form__area" name="comments" id="comments" cols="30" rows="10" 
                        autocomplete="none" placeholder="Tell us more..."><?= preserveCommentsInputs($post) ?></textarea>
                    <label for="comments" class="form__label" <?= enableFieldErrors($post) ?>>Comments*: <?= printCommentsFieldErrors($post) ?></label>
                    <label for="comments" class="screen-reader screen-reader-focusable">Comments
                    </label>
                </p>
                <p class="form__group"><button type="submit" class="btn btn--dark" name="send" value="send">Send</button></p>
            </form>
        </section>
    </main>

    <?php include('./assets/includes/footer.php'); ?>

    <script src="./assets/js/script.js" async></script>
</body>
</html>