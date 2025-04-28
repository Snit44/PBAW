<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <title>Logowanie</title>
  <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>
  <div class="login-container">
    <div class="login-box">
      <h2>Logowanie</h2>
      {if $error neq ""}
      <div class="alert alert-danger">{$error}</div>
      {/if}
      <form method="post" action="{$_SERVER.REQUEST_URI}">
        <div class="form-group">
          <label for="login">Login:</label>
          <input type="text" name="login" id="login" value="{$login}" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="pass">Hasło:</label>
          <input type="password" name="pass" id="pass" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Zaloguj się</button>
      </form>
    </div>
  </div>
</body>
</html>
