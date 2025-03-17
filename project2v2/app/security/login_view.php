<?php
$form = isset($form) && is_array($form) ? $form : array();
$messages = isset($messages) && is_array($messages) ? $messages : array();
if (!function_exists('out')) {
    function out(&$param) {
        if (isset($param)) {
            echo htmlspecialchars($param, ENT_QUOTES, 'UTF-8');
        }
    }
}

error_log("login_view.php: form['login'] = " . (isset($form['login']) ? $form['login'] : 'not set'));

$login_value = isset($form['login']) ? htmlspecialchars($form['login'], ENT_QUOTES, 'UTF-8') : '';
?>

<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
    <meta charset="utf-8" />
    <title>Logowanie</title>
    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
</head>
<body>

<div style="width:90%; margin: 2em auto;">

<form action="<?php echo htmlspecialchars(_APP_ROOT, ENT_QUOTES, 'UTF-8'); ?>/app/security/login.php" method="post" class="pure-form pure-form-stacked">
    <legend>Logowanie</legend>
    <fieldset>
        <label for="id_login">login: </label>
        <input id="id_login" type="text" name="login" value="<?php echo $login_value; ?>" />
        <label for="id_pass">pass: </label>
        <input id="id_pass" type="password" name="pass" />
    </fieldset>
    <input type="submit" value="zaloguj" class="pure-button pure-button-primary"/>
</form>	

<?php
if (!empty($messages)) {
    echo '<ol style="padding: 10px 10px 10px 30px; border-radius: 5px; background-color: #f88; width:300px;">';
    foreach ($messages as $key => $msg) {
        echo '<li>' . htmlspecialchars($msg, ENT_QUOTES, 'UTF-8') . '</li>';
    }
    echo '</ol>';
}
?>

</div>

</body>
</html>