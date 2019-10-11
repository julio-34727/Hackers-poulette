<?php

/* Includes */
require('./assets/includes/functions.php');
include('./assets/includes/continents.php');

/* Arrays (global variables) */
$errors = [];
$missing = [];

/* Form processing & mail (correct submit) */
if ($_SERVER['REQUEST_METHOD'] == 'POST') //isset($_POST['send'])
{
    // Processing
    $required = ['firstname', 'lastname', 'email', 'gender', 'country', 'subject', 'comments'];
    $_POST['gender'] = $_POST['gender'] ?? ''; //default value for radio-btn (no check)
    $_POST['email'] = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    // anti-sapm (honeypot)
    if (strlen($_POST['color'])>1) {
        header('location: ./assets/includes/404.php');
        exit;
    }

    require('./assets/includes/process.php');

    if (!$missing && !$errors) 
    {
        header('location: ./assets/includes/thanks.php');
        exit;
    }
}

// var_dump($_POST);

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
                <h2>Contact Us</h2>
                <a href="index.php" id="logo"><img src="./assets/img/hackers-poulette-logo.png" alt="Hackers poulette logo"></a>
                <?php if ($missing || $errors) {?>
                <p class="error">*Please fix the item(s) indicated in red.</p>
                <?php }?>
            </header>
            <form method="post" action="index.php" class="section__body form">
                <p class="form__group">
                    <input type="text" class="form__input" name="firstname" id="firstname"  
                           <?= preserveFirstnameInputs($missing, $errors) ?>
                           minlength="2" maxlength="32" placeholder="Your first name (2-32 characters)" />
                    <label for="firstname" class="form__label">First name*: <?= checkFirstnameInputs($missing, $errors) ?></label>
                </p>
                <p class="form__group">
                    <input type="text" class="form__input" name="lastname" id="lastname" 
                           <?= preserveLastnameInputs($missing, $errors) ?>
                           minlength="2" maxlength="32" placeholder="Your last name (2-32 chaacters)" />
                    <label for="lastname" class="form__label">Last name*: <?= checkLastnameInputs($missing, $errors) ?></label>
                </p>
                <p class="form__group">
                    <input type="email" class="form__input" name="email" id="email" 
                           <?= preserveEmailInputs($missing, $errors) ?>
                           minlength="3" maxlength="320" placeholder="mail@example.com" />
                    <label for="email" class="form__label">Email*: <?= checkEmailInputs($missing, $errors) ?></label>
                </p>
                <p class="form-group honeypot">
                    <input type="text" class="form__input" name="color" id="color" placeholder="Your favorite color" />
                    <label for="email" class="form__label">Favorite color*:</label>
                </p>
                <p class="form__group">
                    <div class="form__group--radio">
                        <input type="radio" class="form__radio-input" name="gender" id="gender-male" value="male" />
                        <label for="gender-male" class="form__radio-label">male</label>

                        <input type="radio" class="form__radio-input" name="gender" id="gender-female" value="female" />
                        <label for="gender-female" class="form__radio-label">female</label> 

                        <input type="radio" class="form__radio-input" name="gender" id="gender-other" value="other" />
                        <label for="gender-other" class="form__radio-label">other</label>
                    </div>
                    <label class="form__label">Gender*: <?= checkGenderChoice($missing, $errors) ?></label>
                </p>
                <p class="form__group">
                    <select name="country" class="form__select" id="country">
                        <option value="" default selected>--Choose a country--</option>
                        <?php 
                        foreach ($continents as $continent => $countries) 
                        {
                            echo '<optgroup label="'.$continent.'">';
                            foreach ($countries as $country) {echo '<option value="'.strtolower($country).'">'.$country.'</option>';}
                            echo '</optgroup>';
                        }
                        ?>
                    </select>
                    <label for="country" class="form__label">Country*: <?= checkCountryChoice($missing, $errors) ?></label>
                </p>
                <p class="form__group">
                    <select name="subject" class="form__select" id="subject">
                        <option value="" default selected>--Choose a subject--</option>
                        <option value="software">Software</option>
                        <option value="hardware">Hardware</option>
                        <option value="repairs">Repairs</option>
                        <option value="others">Others</option>
                    </select>
                    <label for="subject" class="form__label">Subject*: <?= checkSubjectChoice($missing, $errors) ?></label>
                </p>
                <p class="form__group">
                    <textarea class="form__area" name="comments" id="comments" cols="30" rows="10" 
                              <?= preserveCommentsInputs($missing, $errors) ?>
                              minlength="1" maxlength="200" placeholder="Tell us more... &#13;&#10;(max 200 characters)"></textarea>
                    <label for="comments" class="form__label">Comments*: <?= checkCommentsInputs($missing, $errors) ?></label>
                </p>
                <p class="form__group"><button type="submit" class="btn btn--dark" name="send" value="send">Send</button></p>
            </form>
        </section>
    </main>

    <?php include('./assets/includes/footer.php'); ?>

    <script src="./assets/js/script.js"></script>
</body>
</html>