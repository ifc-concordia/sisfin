<?php

include "index.php";
require "include/config.php";
include 'include/funcoes.php';
?>

<br />

<form action="#" method="POST" name="formConsultarCredito">
    <fieldset>
        <legend>Consultas</legend>
        <label for="solicitante">Solicitante:</label>
        <input type="text" id="solicitante" value="" /><br />
        <input type="button" id="btConsultaCredito" value="Consultar" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only botao" />
        
    </fieldset>
</form>

<div id="listaCreditos">
</div>