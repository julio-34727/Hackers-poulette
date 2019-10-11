<?php 

function checkFirstnameInputs($missing, $errors) 
{
    if (in_array('firstname', $missing)) {$out = '<span class="error">Type a valid first name please</span>';}
    elseif (isset($_POST['firstname'])) {$out = '<span class="correct">valid first name &#10004;</span>';}
    else {$out = '';}
    return $out;
}

function checkLastnameInputs($missing, $errors) 
{
    if (in_array('lastname', $missing)) {$out = '<span class="error">Type a valid last name please</span>';}
    elseif (isset($_POST['lastname'])) {$out = '<span class="correct">valid last name &#10004;</span>';}
    else {$out = '';}
    return $out;
}

function checkEmailInputs($missing, $errors) 
{
    if (in_array('email', $missing)) {$out = '<span class="error">Type a valid email (RFC 5322) please</span>';}
    elseif (isset($_POST['email'])) {$out = '<span class="correct">valid email &#10004;</span>';}
    else {$out = '';}
    return $out;
}

function checkGenderChoice($missing, $errors) 
{
    if (in_array('gender', $missing)) {$out = '<span class="error">Choose your gender please</span>';}
    elseif (isset($_POST['gender'])) {$out = '<span class="correct">valid choice &#10004;</span>';}
    else {$out = '';}
    return $out;
}

function checkCountryChoice($missing, $errors) 
{
    if (in_array('country', $missing)) {$out = '<span class="error">Choose your country please</span>';}
    elseif (isset($_POST['country'])) {$out = '<span class="correct">valid choice &#10004;</span>';}
    else {$out = '';}
    return $out;
}

function checkSubjectChoice($missing, $errors) 
{   
    if (in_array('subject', $missing)) {$out = '<span class="error">Choose one subject please</span>';}
    elseif (isset($_POST['subject'])) {$out = '<span class="correct">valid subject &#10004;</span>';}
    else {$out = '';}
    return $out;
}

function checkCommentsInputs($missing, $errors) 
{
    if (in_array('comments', $missing)) {$out = '<span class="error">Type your comments please</span>';}
    elseif (isset($_POST['comments'])) {$out = '<span class="correct">valid comments &#10004;</span>';}
    else {$out = '';}
    return $out;
}

function preserveFirstnameInputs($missing, $errors)
{
    if ($missing || $errors) {return 'value="'.htmlentities($_POST['firstname']).'"';}
}

function preserveLastnameInputs($missing, $errors)
{
    if ($missing || $errors) {return 'value="'.htmlentities($_POST['lastname']).'"';} 
}

function preserveEmailInputs($missing, $errors)
{
    if ($missing || $errors) 
    {
        return 'value="'.$_POST['email'].'"';
    } 
}

function preserveGenderChoice($missing, $errors)
{
    if ($missing || $errors) {return 'value="'.$_POST['gender'].'"';}   
}

function preserveCountryChoice($missing, $errors)
{
    if ($missing || $errors) {return 'value="'.$_POST['country'].'"';}    
}

function preserveSubjectChoice($missing, $errors)
{
    if ($missing || $errors) {return 'value="'.$_POST['subject'].'"';} 
}

function preserveCommentsInputs($missing, $errors)
{
    if ($missing || $errors) {return 'value="'.htmlentities($_POST['comments']).'"';}
}




function sendMailToHackersPoulette($forms, $message, $admin, $coach=null) 
{
    $firstname = $forms['firstname'];
    $lastname = $forms['lastname'];
    $emailUser = $forms['email'];
    $gender = $forms['gender'];
    $country = $forms['country'];
    $subject = $forms['subject'];
    $comments = $forms['comments'];
    $emailAdmin = $admin['firstname'].' '.$admin['email'];

    $headers[] = 'Content-Type: text/plain; charset=utf-8';
    $headers[] = 'From: '.$firstname.' <'.$emailUser.'>';
    $headers[] = ($coach != null) ? 'Cc: '.$coach['firstname'].' '.$coach['email'] : '';
    $headers = implode('\r\n', $headers);

    mail($emailAdmin, $subject, $message);
}

// $admin = array('firstname' => 'Julio', 'email' => '<j.tusamba@gmail.com>'); //'Emily <emily@becode.org>';
// $coach = array('firstname' => 'Kibens', 'email' => '<julio.t@hotmail.be>'); //'Marvin <marvin@becode.org>';

// $message = <<<TAG
// Thank You\r\n
// Your message has been sent. We appreciate your feedback, and will be in touch if necessary.\r\n
// We hope you'll continue to enjoy browsing the Japan Journey website.
// TAG;

?>