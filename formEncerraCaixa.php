<?php

include "index.php";
require "include/config.php";
include 'include/funcoes.php';
?>

<br />
<form action="#" method="POST" name="formEncerraCaixa">
    <fieldset style="width: 620px">
        <legend>Encerramento de caixa</legend>
        <label for="dataEncerrar">Data</label>
        <input type="text" class="liberaData" id="dataEncerrar" onKeyUp="mascaraTexto(event,'99/99/9999')"  /><br />
        <input type="button" id="btEncerrarCaixa" value="Fechar" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only botao" />
    </fieldset>
</form>
<br />