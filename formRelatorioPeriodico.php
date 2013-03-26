<?php
include "index.php";
require "include/config.php";
include 'include/funcoes.php';
?>

<br />

<div>
    <label for="dataInicial">Data Inicial</label>
    <input type="text" style="max-width: 120px" class ="data" id="dataInicial" onKeyUp="mascaraTexto(event,'99/99/9999')" /><br />
    <label for="dataFinal">Data Final</label>
    <input type="text" style="max-width: 120px" id="dataFinal" class="data" onKeyUp="mascaraTexto(event,'99/99/9999')" /><br />
    <input type="button" id="btRelatorio" value="Relatório" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only botao" />
</div>
<br />

<div id="relatorio">
    
</div>