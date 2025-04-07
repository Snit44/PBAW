{include file="main_header.tpl"}

<div class="login-container">
    <div class="login-box">
        <h2>Login</h2>
        

        {if isset($messages) && $messages|@count > 0}
            <div class="alert alert-danger">
                {foreach from=$messages item=message}
                    <p>{$message}</p>
                {/foreach}
            </div>
        {/if}

        <form action="{$smarty.server.PHP_SELF}" method="POST">
            <div class="form-group">
                <label for="login">Username</label>
                <input type="text" class="form-control" id="login" name="login" 
                       value="{if isset($form.login)}{$form.login}{/if}" required>
            </div>
            <div class="form-group">
                <label for="pass">Password</label>
                <input type="password" class="form-control" id="pass" name="pass" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Login</button>
        </form>
    </div>
</div>

{include file="main_footer.tpl"}