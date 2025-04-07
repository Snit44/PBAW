<!DOCTYPE HTML>
<html lang="pl">
<head>
    <meta charset="utf-8" />
    <title>Obliczenia</title>
    <link rel="shortcut icon" href="assets/images/logo2.jpg">
    <link rel="stylesheet" media="screen" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
    <link rel="stylesheet" href="{$smarty.const._APP_URL}/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="{$smarty.const._APP_URL}/assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="{$smarty.const._APP_URL}/assets/css/bootstrap-theme.css" media="screen">
    <link rel="stylesheet" href="{$smarty.const._APP_URL}/assets/css/main.css">
</head>
<body class="home">
    <div class="navbar navbar-inverse navbar-fixed-top headroom">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{$smarty.const._APP_URL}/index.html">
                    <img src="{$smarty.const._APP_URL}/assets/images/123123123" alt="Logo">
                </a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav pull-right">
                    <li class="active"><a href="{$smarty.const._APP_URL}/index.html">Home</a></li>
                    <li><a class="btn" href="{$smarty.const._APP_URL}/app/security/logout.php">Wyloguj</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="container top-space">
        <div class="calculator-section">
            <h1 class="lead text-center">Kalkulator Kredytowy</h1>


            <form action="{$smarty.const._APP_URL}/app/calc.php" method="post" class="form-horizontal mt-4">
                <div class="form-group">
                    <label for="id_amount" class="control-label">Kwota kredytu (PLN):</label>
                    <input id="id_amount" type="text" name="amount" value="{$amount|default:''}" class="form-control form-control-smaller" placeholder="Wprowadź kwotę" />
                </div>
                <div class="form-group">
                    <label for="id_years" class="control-label">Okres kredytowania (lata):</label>
                    <input id="id_years" type="text" name="years" value="{$years|default:''}" class="form-control form-control-smaller" placeholder="Wprowadź lata" />
                </div>
                <div class="form-group">
                    <label for="id_interest" class="control-label">Oprocentowanie (% rocznie):</label>
                    <input id="id_interest" type="text" name="interest" value="{$interest|default:''}" class="form-control form-control-smaller" placeholder="Wprowadź oprocentowanie" />
                </div>
                <button type="submit" class="btn btn-action btn-lg btn-center">Oblicz</button>
            </form>


            {if $messages|count > 0}
                <div class="alert alert-danger mt-3">
                    <ul>
                        {foreach from=$messages item=msg}
                            <li>{$msg}</li>
                        {/foreach}
                    </ul>
                </div>
            {/if}


           {if isset($result)}
    <div class="alert alert-success mt-3">
        Miesięczna rata: {$result->result} PLN
    </div>
{/if}

        </div>
    </div>


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


    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <script src="{$smarty.const._APP_URL}/assets/js/headroom.min.js"></script>
    <script src="{$smarty.const._APP_URL}/assets/js/jQuery.headroom.min.js"></script>
    <script src="{$smarty.const._APP_URL}/assets/js/template.js"></script>
</body>
</html>