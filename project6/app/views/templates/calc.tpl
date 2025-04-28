<!DOCTYPE HTML>
<html lang="pl">
<head>
    <meta charset="utf-8" />
    <title>Kalkulator kredytowy</title>
    <link rel="shortcut icon" href="{$smarty.const._APP_URL}/assets/images/logo2.jpg">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
    <link rel="stylesheet" href="{$smarty.const._APP_URL}/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="{$smarty.const._APP_URL}/assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="{$smarty.const._APP_URL}/assets/css/bootstrap-theme.css" media="screen">
    <link rel="stylesheet" href="{$smarty.const._APP_URL}/assets/css/main.css">
</head>
<body class="home">

<!-- Navbar -->
<div class="navbar navbar-inverse navbar-fixed-top headroom">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="{$smarty.const._APP_URL}/index.php?action=calcShow">
                <img src="{$smarty.const._APP_URL}/assets/images/logo.jpg" alt="Logo">
            </a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav pull-right">
                <li><a href="{$smarty.const._APP_URL}/index.php?action=calcShow">Home</a></li>
                <li><a class="btn" href="{$smarty.const._APP_URL}/app/security/logout.php">Wyloguj</a></li>
            </ul>
        </div>
    </div>
</div>

<!-- Main content -->
<div class="container top-space">
    <div class="calculator-section">
        <h1 class="lead text-center">Kalkulator Kredytowy</h1>

        <form action="{$smarty.const._APP_URL}/index.php?action=calcCompute" method="post" class="form-horizontal mt-4">
            <div class="form-group">
                <label for="id_amount" class="control-label">Kwota kredytu (PLN):</label>
                <input id="id_amount" type="text" name="amount" value="{$form->amount|default:''}" class="form-control" placeholder="Wprowadź kwotę" />
            </div>
            <div class="form-group">
                <label for="id_years" class="control-label">Okres kredytowania (lata):</label>
                <input id="id_years" type="text" name="years" value="{$form->years|default:''}" class="form-control" placeholder="Wprowadź lata" />
            </div>
            <div class="form-group">
                <label for="id_interest" class="control-label">Oprocentowanie (% rocznie):</label>
                <input id="id_interest" type="text" name="interest" value="{$form->interest|default:''}" class="form-control" placeholder="Wprowadź oprocentowanie" />
            </div>
            <button type="submit" class="btn btn-primary">Oblicz</button>
        </form>

        {if $messages|@count > 0}
            <div class="alert alert-danger mt-3">
                <ul>
                    {foreach from=$messages item=msg}
                        <li>{$msg}</li>
                    {/foreach}
                </ul>
            </div>
        {/if}

        {if isset($result->monthlyPayment)}
            <div class="alert alert-success mt-3">
                <h4>Wyniki obliczeń:</h4>
                <p>Miesięczna rata: <strong>{$result->monthlyPayment}</strong> PLN</p>
            </div>
        {/if}
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
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="{$smarty.const._APP_URL}/assets/js/headroom.min.js"></script>
<script src="{$smarty.const._APP_URL}/assets/js/jQuery.headroom.min.js"></script>
<script src="{$smarty.const._APP_URL}/assets/js/template.js"></script>
</body>
</html>
