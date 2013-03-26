        
<?php
include 'index.php';
?>
<br />

<form action="processaMudarSenha" method="post" name="formSenha">
    <fieldset>
        <legend>Altera Senha</legend>
        <label for="senhaAntiga">Senha Atual</label>
        <input type="password" id="senhaAntiga" /><br />
        <label for="senhaNova">Nova Senha:</label>
        <input type="password" id="senhaNova" /><br />
        <label for="confirmaSenhaNova">Confirme a Senha:</label>
        <input type="password" id="confirmaSenhaNova" /><br />
        <input type="button" value="Alterar" id="btAlterarSenha" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only botao" />
    </fieldset>
</form>