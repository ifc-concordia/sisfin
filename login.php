<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>SisFin</title>
        <link rel="stylesheet"  href="css/jquery-ui-1.9.1.custom.css">
        <link rel="stylesheet"  href="css/estilo.css">
        <script type="text/javascript" src="js/jquery-1.8.2.js"></script>
        <script type="text/javascript" src="js/jquery-ui-1.9.1.custom.js"></script>
        <script type="text/javascript" src="js/login.js"></script>
    </head>
    <body>
        <center>
        <div id="logo">
            <img src="imagens/logo.jpg" /><br>
            <h2>Sistema Financeiro Integrado </h2>
        </div>

        <div class="autenticacao">
            <form action ="processaLogin.php" method="POST" name="atender">
                <fieldset class="fieldsetautenticacao">
                    <legend>Login</legend>
                    <label for="identificacao" class="autenticacao">Identificação</label>
                    <input type="text" id="identificacao" class="autenticacao" name="identificacao" />
                    <label for="senha" class="autenticacao">Senha</label>
                    <input type="password" id="senha" class="autenticacao" name="senha"/>
                    <input type="submit" value="Entrar" id="btLogin" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only botao" />
                </fieldset>
            </form>
        </div>
        </center>