<?php
/* Smarty version 5.4.3, created on 2025-04-07 21:46:09
  from 'file:calc_view.php' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.3',
  'unifunc' => 'content_67f42b8105ed29_04290158',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7e6b56b0be2a9388f0960e23a5f251eb3ea64b61' => 
    array (
      0 => 'calc_view.php',
      1 => 1742935849,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_67f42b8105ed29_04290158 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\obj-v2\\app';
echo '<?php'; ?>

require_once dirname(__FILE__).'/../config.php';
//ochrona widoku
include _ROOT_PATH.'/app/security/check.php';
<?php echo '?>'; ?>

<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
    <meta charset="utf-8" />
    <title>Kalkulator Kredytowy</title>
    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
</head>
<body>

<div style="width:90%; margin: 2em auto;">
    <a href="<?php echo '<?php'; ?>
 print(_APP_ROOT); <?php echo '?>'; ?>
/app/calc.php" class="pure-button">Powrót do kalkulatora</a>
    <a href="<?php echo '<?php'; ?>
 print(_APP_ROOT); <?php echo '?>'; ?>
/app/security/logout.php" class="pure-button pure-button-active">Wyloguj</a>
</div>

<div style="width:90%; margin: 2em auto;">

<form action="<?php echo '<?php'; ?>
 print(_APP_ROOT); <?php echo '?>'; ?>
/app/calc.php" method="post" class="pure-form pure-form-stacked">
    <legend>Kalkulator Kredytowy</legend>
    <fieldset>
        <label for="id_amount">Kwota kredytu (PLN): </label>
        <input id="id_amount" type="text" name="amount" value="<?php echo '<?php'; ?>
 out($amount); <?php echo '?>'; ?>
" />
        <label for="id_years">Okres kredytowania (lata): </label>
        <input id="id_years" type="text" name="years" value="<?php echo '<?php'; ?>
 out($years); <?php echo '?>'; ?>
" />
        <label for="id_interest">Oprocentowanie (% rocznie): </label>
        <input id="id_interest" type="text" name="interest" value="<?php echo '<?php'; ?>
 out($interest); <?php echo '?>'; ?>
" />
    </fieldset>	
    <input type="submit" value="Oblicz" class="pure-button pure-button-primary" />
</form>	

<?php echo '<?php'; ?>

//wyświeltenie listy błędów, jeśli istnieją
if (isset($messages)) {
    if (count($messages) > 0) {
        echo '<ol style="margin-top: 1em; padding: 1em 1em 1em 2em; border-radius: 0.5em; background-color: #f88; width:25em;">';
        foreach ($messages as $key => $msg) {
            echo '<li>'.$msg.'</li>';
        }
        echo '</ol>';
    }
}
<?php echo '?>'; ?>


<?php echo '<?php'; ?>
 if (isset($result)){ <?php echo '?>'; ?>

<div style="margin-top: 1em; padding: 1em; border-radius: 0.5em; background-color: #ff0; width:25em;">
    <?php echo '<?php'; ?>
 echo 'Miesięczna rata: '.$result; <?php echo '?>'; ?>

</div>
<?php echo '<?php'; ?>
 } <?php echo '?>'; ?>


</div>

</body>
</html><?php }
}
