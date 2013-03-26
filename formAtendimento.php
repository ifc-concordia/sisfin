        
<?php
include 'index.php';
?>
<br />

<form action ="#" method="POST" name="atender">
    <fieldset class="fieldsetautenticacao">
        <legend>Atendimento</legend>
        <label for="identificacao" class="autenticacao">Identificação</label>
        <input type="text" id="identificacao" class="autenticacao" />
        <label for="senha" class="autenticacao">Senha</label>
        <input type="password" id="senha" class="autenticacao"/>
        <input type="button" value="Atender" id="btAtender" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only botao" />
    </fieldset>
</form>


<div id="atender">

</div>

<div id="dialogAtendimento">
    
</div>