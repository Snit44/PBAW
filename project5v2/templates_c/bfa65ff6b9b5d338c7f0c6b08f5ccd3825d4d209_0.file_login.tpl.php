<?php
/* Smarty version 5.4.3, created on 2025-04-07 23:12:49
  from 'file:login.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.3',
  'unifunc' => 'content_67f43fd134a863_90691545',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'bfa65ff6b9b5d338c7f0c6b08f5ccd3825d4d209' => 
    array (
      0 => 'login.tpl',
      1 => 1742944830,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:main_header.tpl' => 1,
    'file:main_footer.tpl' => 1,
  ),
))) {
function content_67f43fd134a863_90691545 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\obj-v2\\templates';
$_smarty_tpl->renderSubTemplate("file:main_header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>

<div class="login-container">
    <div class="login-box">
        <h2>Login</h2>
        

        <?php if ((true && ($_smarty_tpl->hasVariable('messages') && null !== ($_smarty_tpl->getValue('messages') ?? null))) && $_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('messages')) > 0) {?>
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

        <form action="<?php echo $_SERVER['PHP_SELF'];?>
" method="POST">
            <div class="form-group">
                <label for="login">Username</label>
                <input type="text" class="form-control" id="login" name="login" 
                       value="<?php if ((true && (true && null !== ($_smarty_tpl->getValue('form')['login'] ?? null)))) {
echo $_smarty_tpl->getValue('form')['login'];
}?>" required>
            </div>
            <div class="form-group">
                <label for="pass">Password</label>
                <input type="password" class="form-control" id="pass" name="pass" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Login</button>
        </form>
    </div>
</div>

<?php $_smarty_tpl->renderSubTemplate("file:main_footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
}
}
