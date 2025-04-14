<?php
/* Smarty version 5.4.3, created on 2025-04-14 01:07:43
  from 'file:main_footer.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.3',
  'unifunc' => 'content_67fc43bf4e0b93_09400023',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '57435ebcba96e105fd2589a0cd93729d462fd86c' => 
    array (
      0 => 'main_footer.tpl',
      1 => 1744564170,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_67fc43bf4e0b93_09400023 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\obj-v2\\templates';
?><footer id="footer" class="top-space">
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
    <?php echo '<script'; ?>
 src="<?php echo (defined('_APP_URL') ? constant('_APP_URL') : null);?>
/assets/js/bootstrap.min.js"><?php echo '</script'; ?>
>
</body>
</html>
<?php }
}
