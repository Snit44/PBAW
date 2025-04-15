<?php
/* Smarty version 5.4.3, created on 2025-04-15 01:55:21
  from 'file:calc.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.3',
  'unifunc' => 'content_67fda0699a4299_07709969',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a1e7210c23f60393b8bdfbd1ba43c892a4726b7f' => 
    array (
      0 => 'calc.tpl',
      1 => 1744664660,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_67fda0699a4299_07709969 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\project5_full\\app\\Views\\Templates';
?><!DOCTYPE HTML>
<html lang="pl">
<head>
    <meta charset="utf-8" />
    <title>Kalkulator kredytowy</title>
    <link rel="shortcut icon" href="<?php echo (defined('_APP_URL') ? constant('_APP_URL') : null);?>
/assets/images/logo2.jpg">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
    <link rel="stylesheet" href="<?php echo (defined('_APP_URL') ? constant('_APP_URL') : null);?>
/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo (defined('_APP_URL') ? constant('_APP_URL') : null);?>
/assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo (defined('_APP_URL') ? constant('_APP_URL') : null);?>
/assets/css/bootstrap-theme.css" media="screen">
    <link rel="stylesheet" href="<?php echo (defined('_APP_URL') ? constant('_APP_URL') : null);?>
/assets/css/main.css">
</head>
<body class="home">

<!-- Navbar -->
<div class="navbar navbar-inverse navbar-fixed-top headroom">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="<?php echo (defined('_APP_URL') ? constant('_APP_URL') : null);?>
/index.php?action=calcShow">
                <img src="<?php echo (defined('_APP_URL') ? constant('_APP_URL') : null);?>
/assets/images/logo.jpg" alt="Logo">
            </a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav pull-right">
                <li><a href="<?php echo (defined('_APP_URL') ? constant('_APP_URL') : null);?>
/index.php?action=calcShow">Home</a></li>
                <li><a class="btn" href="<?php echo (defined('_APP_URL') ? constant('_APP_URL') : null);?>
/app/security/logout.php">Wyloguj</a></li>
            </ul>
        </div>
    </div>
</div>

<!-- Main content -->
<div class="container top-space">
    <div class="calculator-section">
        <h1 class="lead text-center">Kalkulator Kredytowy</h1>

        <form action="<?php echo (defined('_APP_URL') ? constant('_APP_URL') : null);?>
/index.php?action=calcCompute" method="post" class="form-horizontal mt-4">
            <div class="form-group">
                <label for="id_amount" class="control-label">Kwota kredytu (PLN):</label>
                <input id="id_amount" type="text" name="amount" value="<?php echo (($tmp = $_smarty_tpl->getValue('form')->amount ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" class="form-control" placeholder="Wprowadź kwotę" />
            </div>
            <div class="form-group">
                <label for="id_years" class="control-label">Okres kredytowania (lata):</label>
                <input id="id_years" type="text" name="years" value="<?php echo (($tmp = $_smarty_tpl->getValue('form')->years ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" class="form-control" placeholder="Wprowadź lata" />
            </div>
            <div class="form-group">
                <label for="id_interest" class="control-label">Oprocentowanie (% rocznie):</label>
                <input id="id_interest" type="text" name="interest" value="<?php echo (($tmp = $_smarty_tpl->getValue('form')->interest ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" class="form-control" placeholder="Wprowadź oprocentowanie" />
            </div>
            <button type="submit" class="btn btn-primary">Oblicz</button>
        </form>

        <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('messages')) > 0) {?>
            <div class="alert alert-danger mt-3">
                <ul>
                    <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('messages'), 'msg');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('msg')->value) {
$foreach0DoElse = false;
?>
                        <li><?php echo $_smarty_tpl->getValue('msg');?>
</li>
                    <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                </ul>
            </div>
        <?php }?>

        <?php if ((true && (true && null !== ($_smarty_tpl->getValue('result')->monthlyPayment ?? null)))) {?>
            <div class="alert alert-success mt-3">
                <h4>Wyniki obliczeń:</h4>
                <p>Miesięczna rata: <strong><?php echo $_smarty_tpl->getValue('result')->monthlyPayment;?>
</strong> PLN</p>
            </div>
        <?php }?>
    </div>
</div>

<!-- Footer -->
<footer id="footer" class="top-space">
    <div class="footer1">
        <div class="container">
            <div class="row">
                <div class="col-md-3 widget">
                    <h3 class="widget-title">Follow me</h3>
                    <div class="widget-body">
                        <p class="follow-me-icons">
                            <a href="https://github.com/Snit44/PBAW"><i class="fa fa-github fa-2"></i></a>
                        </p>
                    </div>
                </div>
                <div class="col-md-6 widget">
                    <h3 class="widget-title">About project</h3>
                    <div class="widget-body">
                        <p>Projekt powstał w celu szkolenia z przedmiotu Projektowanie bazodanowych aplikacji webowych.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Scripts -->
<?php echo '<script'; ?>
 src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo (defined('_APP_URL') ? constant('_APP_URL') : null);?>
/assets/js/headroom.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo (defined('_APP_URL') ? constant('_APP_URL') : null);?>
/assets/js/jQuery.headroom.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo (defined('_APP_URL') ? constant('_APP_URL') : null);?>
/assets/js/template.js"><?php echo '</script'; ?>
>
</body>
</html>
<?php }
}
