<?php
    include "verificaUsuario.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>SisFin</title>
        <link rel="stylesheet"  href="css/jquery-ui-1.9.1.custom.css">
        <link rel="stylesheet"  href="css/estilo.css">
        <script type="text/javascript" src="js/jquery-1.8.2.js"></script>
        <script type="text/javascript" src="js/jquery-ui-1.9.1.custom.js"></script>
        <script type="text/javascript" src="js/funcoes.js"></script>
        <script type="text/javascript" src="js/movimento.js"></script>
    </head>
    <body>
        <div id="logo">
            <img src="imagens/logo.jpg" /><br>
            <h2>Sistema Financeiro Integrado </h2>
        </div>
        <div id="menu">
            <ul id="nav">
                <li>Cadastros
                    <ul>
                        <li><a href="formSetor.php">Setores</a></li>
                        <li><a href="formProduto.php">Produtos</a></li>
                        <li><a href="formServico.php">Serviços</a></li>
                        <li><a href="formAlteraSenha.php">Senha</a></li>
                    </ul>
                </li>
                <li>Movimentação
                    <ul>
                        <li><a href="formVenda.php">Vendas</a></li>
                        <li><a href="formSolicitacao.php">Solicitações</a></li>
                        <li><a href="formAtendimento.php">Atendimentos</a></li>
                        <li><a href="formGRU.php">GRU</a></li>
                        <li><a href="formEncerraCaixa.php">Encerrar caixa</a></li>
                    </ul>
                </li>
                <li>Consultas
                    <ul>
                        <li><a href="formConsultaCredito.php">Créditos</a></li>
                        <li><a href="formRelatorioPeriodico.php">Relatório Periódico</a></li>
                        <li><a href="formLivroCaixa.php">Livro Caixa</a></li>
                    </ul>
                </li>
                <li><a href="logout.php">Sair</a></li>
                
            </ul>
            
        </div>
