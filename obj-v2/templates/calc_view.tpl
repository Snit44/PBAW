{include file="main_header.tpl"}

<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h2>Kalkulator kredytowy</h2>
            

            {if $messages|@count > 0}
                <div class="alert alert-danger">
                    {foreach $messages as $message}
                        <p>{$message}</p>
                    {/foreach}
                </div>
            {/if}

            <form action="" method="post">
                <div class="form-group">
                    <label for="amount">Kwota kredytu</label>
                    <input type="text" name="amount" id="amount" 
                           value="{if isset($amount)}{$amount}{/if}" 
                           class="form-control" placeholder="Podaj kwotę kredytu">
                </div>

                <div class="form-group">
                    <label for="years">Okres kredytowania</label>
                    <input type="text" name="years" id="years" 
                           value="{if isset($years)}{$years}{/if}" 
                           class="form-control" placeholder="Podaj liczbę lat">
                </div>

                <div class="form-group">
                    <label for="interest">Oprocentowanie</label>
                    <input type="text" name="interest" id="interest" 
                           value="{if isset($interest)}{$interest}{/if}" 
                           class="form-control" placeholder="Podaj oprocentowanie">
                </div>

                <button type="submit" class="btn btn-primary">Oblicz</button>
            </form>


            {if isset($result)}
                <div class="alert alert-success mt-3">
                    <h3>Wynik obliczeń:</h3>
                    <p>Miesięczna rata kredytowa: {$result} PLN</p>
                </div>
            {/if}
        </div>
    </div>
</div>

{include file="main_footer.tpl"}