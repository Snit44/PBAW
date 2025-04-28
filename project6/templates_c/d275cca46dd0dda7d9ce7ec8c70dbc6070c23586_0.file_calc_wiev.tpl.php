<?php
/* Smarty version 5.4.3, created on 2025-04-07 21:45:11
  from 'file:calc_wiev.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.3',
  'unifunc' => 'content_67f42b473d4569_67890059',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd275cca46dd0dda7d9ce7ec8c70dbc6070c23586' => 
    array (
      0 => 'calc_wiev.tpl',
      1 => 1742944805,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:main_header.tpl' => 1,
    'file:main_footer.tpl' => 1,
  ),
))) {
function content_67f42b473d4569_67890059 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\obj-v2\\templates';
$_smarty_tpl->renderSubTemplate("file:main_header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>

<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h2>Kalkulator kredytowy</h2>
            

            <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('messages')) > 0) {?>
                <div class="alert alert-danger">
                    <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('messages'), 'message');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('message')->value) {
$foreach0DoElse = false;
?>
                        <p><?php echo $_smarty_tpl->getValue('message');?>
</p>
                    <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                </div>
            <?php }?>

            <form action="" method="post">
                <div class="form-group">
                    <label for="amount">Kwota kredytu</label>
                    <input type="text" name="amount" id="amount" 
                           value="<?php if ((true && ($_smarty_tpl->hasVariable('amount') && null !== ($_smarty_tpl->getValue('amount') ?? null)))) {
echo $_smarty_tpl->getValue('amount');
}?>" 
                           class="form-control" placeholder="Podaj kwotę kredytu">
                </div>

                <div class="form-group">
                    <label for="years">Okres kredytowania</label>
                    <input type="text" name="years" id="years" 
                           value="<?php if ((true && ($_smarty_tpl->hasVariable('years') && null !== ($_smarty_tpl->getValue('years') ?? null)))) {
echo $_smarty_tpl->getValue('years');
}?>" 
                           class="form-control" placeholder="Podaj liczbę lat">
                </div>

                <div class="form-group">
                    <label for="interest">Oprocentowanie</label>
                    <input type="text" name="interest" id="interest" 
                           value="<?php if ((true && ($_smarty_tpl->hasVariable('interest') && null !== ($_smarty_tpl->getValue('interest') ?? null)))) {
echo $_smarty_tpl->getValue('interest');
}?>" 
                           class="form-control" placeholder="Podaj oprocentowanie">
                </div>

                <button type="submit" class="btn btn-primary">Oblicz</button>
            </form>


            <?php if ((true && ($_smarty_tpl->hasVariable('result') && null !== ($_smarty_tpl->getValue('result') ?? null)))) {?>
                <div class="alert alert-success mt-3">
                    <h3>Wynik obliczeń:</h3>
                    <p>Miesięczna rata kredytowa: <?php echo $_smarty_tpl->getValue('result');?>
 PLN</p>
                </div>
            <?php }?>
        </div>
    </div>
</div>

<?php $_smarty_tpl->renderSubTemplate("file:main_footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
}
}
