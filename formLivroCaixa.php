<?php

include "index.php";
require "include/config.php";
include 'include/funcoes.php';
?>

<br />
<div>
    <label for="ano">Ano</label>
    <input type="text" id="ano" value="2013" /><br />
    <input type="button" id="btAnoLivroCaixa" value="Consultar" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only botao" />
</div>
<br>
<!--<fieldset>
    <legend>Livro Caixa</legend>-->
    <div id="livroCaixa">
        
    </div>
<!--</fieldset>-->