<?php

include 'include/config.php';
include 'include/funcoes.php';
$acao = $_POST['acao'];
session_start();
//print_r($_SESSION);
$idusuario = $_SESSION['idusuario'];

class Resposta {

    public $status = "1";
    public $mensagem = "Requisição efetuada com sucesso";
    public $dados = array();

    public function addData($dados) {
        array_push($this->dados, $dados);
    }

    public function getData() {
        return $this;
    }

}

$reply = new Resposta;

if ($acao == 'gravaSetor') {
    $nome = $_POST['nome'];
    $sql = "Insert into setor (nome) VALUES ('$nome');";
    mysql_query($sql) or die(mysql_error());
}

if ($acao == 'retornaSetor') {
    $setor = $_POST['setor'];
    $sql = "select * from setor where idsetor = '$setor'";
    $query = mysql_query($sql);
    $obj = mysql_fetch_object($query);
    $setor = $obj->nome;
    $idsetor = $obj->idsetor;
    $dados = array("nome" => $setor, "idsetor" => $idsetor);
    $reply->addData($dados);
}

if ($acao == 'listaSetores') {
    $sql = "select * from setor";
    $query = mysql_query($sql) or die(mysql_error());
    $num = mysql_num_rows($query);
    $dados = array();
    for ($x = 0; $x < $num; $x++) {
        $obj = mysql_fetch_object($query);
        $nome = $obj->nome;
        $idsetor = $obj->idsetor;
        $array = array("nome" => $nome, "idsetor" => $idsetor);
        $dados = array_push($array, $dados);
    }
    $reply->addData($dados);
}

if ($acao == 'atualizaSetor') {
    $setor = $_POST['setor'];
    $idsetor = $_POST['idsetor'];
    $sql = "update setor set nome = '$setor' where idsetor = '$idsetor'";
    mysql_query($sql) or die(mysql_error());
}

if ($acao == 'gravaProduto') {
    $nome = utf8_decode($_POST['nome']);
    $valor = reformata_dinheiro($_POST['valor']);
    $sql = "Insert into produto (nome, valor_un) VALUES ('$nome', '$valor');";
    mysql_query($sql) or die(mysql_error());
}

if ($acao == 'retornaProduto') {
    $produto = $_POST['produto'];
    $sql = "select * from produto where idproduto = '$produto'";
    $query = mysql_query($sql) or die(mysql_error());
    $obj = mysql_fetch_object($query);
    $nome = utf8_encode($obj->nome);
    $valor = formata_dinheiro($obj->valor_un);
    $dados = array("nome" => $nome, "idproduto" => $produto, "valor" => $valor);
    $reply->addData($dados);
}

if ($acao == 'atualizaProduto') {
    $produto = utf8_decode($_POST['produto']);
    $idproduto = $_POST['idproduto'];
    $valor = reformata_dinheiro($_POST['valor']);
    $sql = "update produto set nome = '$produto', valor_un = '$valor' where idproduto = '$idproduto'";
    mysql_query($sql) or die(mysql_error());
}

if ($acao == 'gravaServico') {
    $nome = utf8_decode($_POST['nome']);
    $valor = reformata_dinheiro($_POST['valor']);
    $setor = $_POST['setor'];
    $sql = "Insert into servico (nome, valor_un, setor_idsetor) VALUES ('$nome', '$valor', '$setor');";
    mysql_query($sql) or die(mysql_error());
}

if ($acao == 'retornaServico') {
    $servico = $_POST['servico'];
    $sql = "select sv.nome, sv.setor_idsetor, sv.valor_un, st.nome as setor from servico sv, setor st where sv.idservico = '$servico' and sv.setor_idsetor = st.idsetor";
    $query = mysql_query($sql) or die(mysql_error());
    $obj = mysql_fetch_object($query);
    $nome = utf8_encode($obj->nome);
    $valor = formata_dinheiro($obj->valor_un);
    $idsetor = $obj->setor_idsetor;
    $setor = $obj->setor;
    $dados = array("idsetor" => $idsetor, "valor" => $valor, "setor" => $setor, "idservico" => $servico, "nome" => $nome);
    $reply->addData($dados);
}

if ($acao == 'atualizaServico') {
    $servico = $_POST['nome'];
    $idservico = $_POST['idservico'];
    $valor = reformata_dinheiro($_POST['valor']);
    $sql = "update servico set nome = '$servico', valor_un = '$valor' where idservico = '$idservico'";
    mysql_query($sql) or die(mysql_error());
}

if ($acao == 'calculaValorTotal') {
    $valor_un = reformata_dinheiro($_POST['valor_un']);
    $quantidade = $_POST['quantidade'];
    $valorTotal = $valor_un * $quantidade;
    $valorTotal = formata_dinheiro($valorTotal);
    $dados = array("valor" => $valorTotal);
    $reply->addData($dados);
}

if ($acao == 'efetuaVenda') {
    $data = $_POST['data'];
    $continuar = statusCaixa($data);
    if ($continuar == 0) {
        $dados = array("status" => "0");
    } else if ($continuar == 1) {
        $valorTotal = reformata_dinheiro($_POST['valorTotal']);
        tempCaixa(1, $data, $valorTotal);
        $data = reformata_data($data);
        $descricao = utf8_encode($_POST['descricao']);
        $produto = $_POST['produto'];
        $quantidade = $_POST['quantidade'];
        $valorUnitario = reformata_dinheiro($_POST['valorUnitario']);
        $sql = "insert into venda (pessoa_idpessoa, produto_idproduto, quantidade, valor_un, valor_tot, data, descricao )VALUES
            ('0', '$produto', '$quantidade', '$valorUnitario', '$valorTotal', '$data', '$descricao')";
        $query = mysql_query($sql) or die(mysql_error());

        $dados = array("status" => "1");
    } else {
        $dados = array("status" => "2");
    }
    $reply->addData($dados);
}

if ($acao == 'procurarFoto') {
    $matricula = $_POST['matricula'];
    //$link = "../guarita/fotos/uploads/$matricula.jpg";
    $link = "https://200.135.19.197/guarita/fotos/uploads/$matricula.jpg";
    $arquivo = fopen($link, "r");
    if ($arquivo) {
        $caminho = $link;
    } else {
        $caminho = "./imagens/perfil.png";
    }
    $sql = "select pessoa from usuario where login = '$matricula'";
    $query = mysql_query($sql) or die(mysql_error());
    $num = mysql_num_rows($query);
    if ($num == 0) {
        $nome = "Nome não encontrado";
    } else {
        $obj = mysql_fetch_object($query);
        $nome = $obj->pessoa;
    }
    $dados = array("caminho" => $caminho, "pessoa" => $nome);
    $reply->addData($dados);
}

if ($acao == 'buscaServicos') {
    $setor = $_POST['setor'];
    $sql = "select * from servico where setor_idsetor = '$setor'";
    $query = mysql_query($sql) or die(mysql_error());
    while ($resultRow = mysql_fetch_assoc($query)) {
        $dados = array("idservico" => $resultRow['idservico'], "nome" => utf8_encode($resultRow['nome']));
        $reply->addData($dados);
    }
}

if ($acao == 'efetuaSolicitacao') {
    $data = $_POST['data'];
    $continuar = statusCaixa($data);
    if ($continuar == 0) {
        $dados = array("status" => "0");
    } else if ($continuar == 1) {
        $valorTotal = reformata_dinheiro($_POST['valorTotal']);
        tempCaixa(2, $data, $valorTotal);
        $data = reformata_data($data);
        $solicitante = $_POST['solicitante'];
        $sql = "select idusuario from usuario where login = '$solicitante'";
        $query = mysql_query($sql) or die(mysql_error());
        $obj = mysql_fetch_object($query);
        $idsolicitante = $obj->idusuario;
        $setor = $_POST['setor'];
        $servico = $_POST['servico'];
        $quantidade = $_POST['quantidade'];
        $valorUnitario = reformata_dinheiro($_POST['valorUnitario']);
        $sql = "insert into solicitacao (data, servico_idservico, solicitante_idusuario, quantidade, valor_un, valor_tot,  vendeu_idusuario, status)VALUES
            ('$data', '$servico', '$idsolicitante', '$quantidade', '$valorUnitario', '$valorTotal', '1', 'S')";
        $query = mysql_query($sql) or die(mysql_error());

        $dados = array("status" => "1");
    } else {
        $dados = array("status" => "2");
    }
    $reply->addData($dados);
}

if ($acao == 'consultaUsuario') {
    $login = $_POST['usuario'];
    $senha = $_POST['senha'];
    $sql = "select * from usuario where login = '$login' and senha = '$senha'";
    $query = mysql_query($sql);
    $num = mysql_num_rows($query);
    $dados = array("num" => $num);
    $reply->addData($dados);
}

if ($acao == 'carregaSolicitacoesPendentes') {
    $usuario = $_POST['usuario'];
    $sql = "select st.nome as setor, sl.data, sr.nome as servico, sl.quantidade, sl.idsolicitacao
        from solicitacao sl left join servico sr on sr.idservico = sl.servico_idservico
        left join setor st on st.idsetor = sr.setor_idsetor
        right join usuario ur on ur.idusuario = sl.solicitante_idusuario
        where ur.login = '$usuario' and sl.status <> 'A'";
    $query = mysql_query($sql) or die(mysql_error());
    while ($resultRow = mysql_fetch_assoc($query)) {
        $quantidade = $resultRow['quantidade'];
        $qtdAtendido = 0;
        $idsolicitacao = $resultRow['idsolicitacao'];
        $sql2 = "select * from atendimento where solcitacao = '$idsolicitacao'";
        $query2 = mysql_query($sql2);
        $num2 = mysql_num_rows($query2);
        if ($num2 > 0) {
            for ($x = 0; $x < $num2; $x++) {
                $obj = mysql_fetch_object($query2);
                $qtd2 = $obj->quantidade;
                $qtdAtendido = $qtdAtendido + $qtd2;
            }
        }
        $quantidade2 = $quantidade - $qtdAtendido;
        $dados = array("setor" => $resultRow['setor'], "data" => formata_data($resultRow['data']), "servico" => utf8_encode($resultRow['servico'])
            , "quantidade" => $quantidade2, "idsolicitacao" => $idsolicitacao);
        $reply->addData($dados);
    }
}

if ($acao == 'atendeSolicitacao') {
    $quantidadePedida = $_POST['quantidadePedida']; //Oque o maluco quer
    $data = date("Y-m-d");
    $solicitacao = $_POST['solicitacao'];
    $sql = "select * from solicitacao where idsolicitacao = '$solicitacao'";
    $query = mysql_query($sql);
    $obj = mysql_fetch_object($query);
    $status = $obj->status;
    $qtdAtendido = 0; //Oque ja foi dado pro maluco
    $quantidadeSolicitada = $obj->quantidade; //O que ele pediu na tesouraria?
    $sql2 = "select * from atendimento where solcitacao = '$solicitacao'";
    $query2 = mysql_query($sql2);
    $num2 = mysql_num_rows($query2);
    if ($num2 > 0) {
        for ($x = 0; $x < $num2; $x++) {
            $obj = mysql_fetch_object($query2);
            $qtd2 = $obj->quantidade;
            $qtdAtendido = $qtdAtendido + $qtd2;
        }
    }
    $quantidade2 = $quantidadeSolicitada - $qtdAtendido;

    if ($quantidadePedida > $quantidade2) {
        $dados = array("retorno" => "0");
        $reply->addData($dados);
    } else {
        if ($status == 'S') {
            //Faço o atendimento
            $sql = "insert into atendimento(solcitacao, data,  quantidade, responsavel) VALUES 
            ('$solicitacao', '$data', '$quantidadePedida', '4')";
            $query = mysql_query($sql) or die(mysql_error());
            if ($quantidadeSolicitada == $quantidadePedida) {
                //Atendeu tudo
                $sql = "update solicitacao set status = 'A' where idsolicitacao = '$solicitacao'";
                mysql_query($sql) or die(mysql_error());
                $dados = array("retorno" => "3");
                $reply->addData($dados);
            } else if ($quantidadeSolicitada >= $quantidadePedida) {
                $sql = "update solicitacao set status = 'P' where idsolicitacao = '$solicitacao'";
                mysql_query($sql) or die(mysql_error());
                $dados = array("retorno" => "1");
                $reply->addData($dados);
            }
        } else if ($status == 'P') {
            $sql = "insert into atendimento(solcitacao, data,  quantidade, responsavel) VALUES 
            ('$solicitacao', '$data', '$quantidadePedida', '4')";
            $query = mysql_query($sql) or die(mysql_error());
            if ($quantidade2 == $quantidadePedida) {
                //Atendeu tudo
                $sql = "update solicitacao set status = 'A' where idsolicitacao = '$solicitacao'";
                mysql_query($sql) or die(mysql_error());
                $dados = array("retorno" => "1");
                $reply->addData($dados);
            } else {
                $dados = array("retorno" => "1");
                $reply->addData($dados);
            }
        }
    }
}

if ($acao == 'cadastraGRU') {
    $data = $_POST['data'];
    $continuar = statusCaixa($data);
    if ($continuar == 0) {
        $dados = array("status" => "0");
    } else if ($continuar == 1) {
        $numero = $_POST['numero'];
        $valor = reformata_dinheiro($_POST['valor']);
        $data = reformata_data($data);
        $sql = "insert into gru (numero, valor, data) VALUES ('$numero', '$valor', '$data')";
        $query = mysql_query($sql) or die(mysql_error());
        ;
        $gru = mysql_insert_id();
        $data = formata_data($data);
        tempCaixa("3", $data, $valor);
        $dados = array("status" => "1");
    } else {
        $dados = array("status" => "2");
    }
    $reply->addData($dados);
}

if ($acao == 'encerrarCaixa') {
    $data = $_POST['data'];
    $continuar = statusCaixa($data);
    if ($continuar == 0) {
        $dados = array("status" => "0");
    } else if ($continuar == 1) {
        $data = reformata_data($data);
        $sql = mysql_query("select * from produto") or die(mysql_error());
        $num = mysql_num_rows($sql);
        for ($x = 0; $x < $num; $x++) {
            $obj = mysql_fetch_object($sql);
            $produto = $obj->idproduto;
            $sql2 = "select sum(soma_valor_item) as soma from temp_caixa_dia where produto_idproduto = '$produto' and data = '$data'";
            $query = mysql_query($sql2) or die(mysql_error());
            $obj2 = mysql_fetch_object($query);
            $soma = $obj2->soma;
            if ($soma <> 0) {
                $query = "insert into caixa (produto_idproduto, data, valor) VALUES ('$produto', '$data', '$soma')";
                mysql_query($query) or die(mysql_error());
            }
        }
        
        $sql = mysql_query("select * from servico") or die(mysql_error());
        $num = mysql_num_rows($sql);
        for ($x = 0; $x < $num; $x++) {
            $obj = mysql_fetch_object($sql);
            $servico = $obj->idservico;
            $sql2 = "select sum(soma_valor_item) as soma from temp_caixa_dia where servico_idservico = '$servico' and data = '$data'";
            $query = mysql_query($sql2) or die(mysql_error());
            $obj2 = mysql_fetch_object($query);
            $soma = $obj2->soma;
            if ($soma <> 0) {
                $query = "insert into caixa (servico_idservico, data, valor) VALUES ('$servico', '$data', '$soma')";
                mysql_query($query) or die(mysql_error());
            }
        }
        
        $sql = mysql_query("select * from gru where data = '$data'") or die(mysql_error());
        $num = mysql_num_rows($sql);
        for ($x = 0; $x < $num; $x++) {
            $obj = mysql_fetch_object($sql);
            $gru = $obj->numero;
            $sql2 = "select soma_valor_item as soma from temp_caixa_dia where gru_numero = '$gru' and data = '$data'";
            $query = mysql_query($sql2) or die(mysql_error());
            $obj2 = mysql_fetch_object($query);
            $soma = $obj2->soma;
            if ($soma <> 0) {
                $query = "insert into caixa (gru_numero, data, valor) VALUES ('$gru', '$data', '-$soma')";
                mysql_query($query) or die(mysql_error());
            }
        }
        
        $dados = array("status" => "1");
    } else {
        $dados = array("status" => "2");
    }
    $reply->addData($dados);
}

if ($acao == 'emitirLivroCaixa'){
    $ano = $_POST['ano'];
    $sql = "select cx.data, cx.produto_idproduto, cx.servico_idservico, cx.gru_numero, 
                    cx.valor from caixa cx where YEAR(data) = '$ano' order by data";    
    $query = mysql_query($sql) or die(mysql_error());
    $somaDia = 0;
    $somaTotal = 0;
    $dataAtual = "11-12-2012";
    while ($resultRow = mysql_fetch_assoc($query)) {
        $idproduto = $resultRow['produto_idproduto'];
        $idservico = $resultRow['servico_idservico'];
        
        if ($idproduto <> ""){
            $busca = "select nome from produto where idproduto = '$idproduto'";
            $busca = mysql_query($busca) or die(mysql_error());
            $obj = mysql_fetch_object($busca);
            $nome = utf8_encode($obj->nome);
        }
        else if ($idservico <> "") {
            $busca = "select nome from servico where idservico = '$idservico'";
            $busca = mysql_query($busca) or die(mysql_error());
            $obj = mysql_fetch_object($busca);
            $nome = utf8_encode($obj->nome);
        }       
        else {
            $nome = "GRU";
        }
        $somaTotal = $somaTotal + $resultRow['valor'];
        if ($resultRow['data'] > $dataAtual){
            $somaDia = $resultRow['valor'];
            $dataAtual = $resultRow['data'];
        }
        else {
            $somaDia = $somaDia + $resultRow['valor'];
        }
        $dados = array("nome" => $nome, "data"=>  formata_data($resultRow['data']), "valor"=>  formata_dinheiro($resultRow['valor']), 
            "somaDia"=>  formata_dinheiro($somaDia), "somaTotal"=>  formata_dinheiro($somaTotal));
        $reply->addData($dados);
    }
}

if ($acao == "alterarSenha"){
    $senhaAntiga = $_POST['senhaAntiga'];
    $novaSenha = $_POST['novaSenha'];
    $confirmaSenha = $_POST['confirmaSenha'];
    if (($senhaAntiga=="")||($novaSenha=="")||($confirmaSenha=="")){
        return;
    }
    else if($novaSenha <> $confirmaSenha){
        return;
    }
    else{
        $sql = "update usuario set senha = '$novaSenha' where idusuario = '$idusuario'";
        mysql_query($sql) or die(mysql_error());        
    }
}

if ($acao == 'dataMinima'){
    $sql = "select max(data) as data from caixa";
    $dataAtual = date("d/m/Y");
    $query = mysql_query($sql);
    $obj = mysql_fetch_object($query);
    $data = $obj->data;
    $data = formata_data($data);
    $data = $data - $dataAtual + 1;
    $dados = array("dataMin"=>$data);
    $reply->addData($dados);
}

if ($acao == 'emitirRelatorio'){
    $dataInicial = reformata_data($_POST['dataInicial']);
    $dataFinal = reformata_data($_POST['dataFinal']);
    $sql = "select cx.data, cx.produto_idproduto, cx.servico_idservico, cx.gru_numero, 
                    cx.valor from caixa cx where data >= '$dataInicial' and data <= '$dataFinal'
                    order by data";    
    $query = mysql_query($sql) or die(mysql_error());
    $somaDia = 0;
    $somaTotal = 0;
    $dataAtual = "11-12-2012";
    while ($resultRow = mysql_fetch_assoc($query)) {
        $idproduto = $resultRow['produto_idproduto'];
        $idservico = $resultRow['servico_idservico'];
        
        if ($idproduto <> ""){
            $busca = "select nome from produto where idproduto = '$idproduto'";
            $busca = mysql_query($busca) or die(mysql_error());
            $obj = mysql_fetch_object($busca);
            $nome = utf8_encode($obj->nome);
        }
        else if ($idservico <> "") {
            $busca = "select nome from servico where idservico = '$idservico'";
            $busca = mysql_query($busca) or die(mysql_error());
            $obj = mysql_fetch_object($busca);
            $nome = utf8_encode($obj->nome);
        }       
        else {
            $nome = "GRU";
        }
        $somaTotal = $somaTotal + $resultRow['valor'];
        if ($resultRow['data'] > $dataAtual){
            $somaDia = $resultRow['valor'];
            $dataAtual = $resultRow['data'];
        }
        else {
            $somaDia = $somaDia + $resultRow['valor'];
        }
        $dados = array("nome" => $nome, "data"=>  formata_data($resultRow['data']), "valor"=>  formata_dinheiro($resultRow['valor']), 
            "somaDia"=>  formata_dinheiro($somaDia), "somaTotal"=>  formata_dinheiro($somaTotal));
        $reply->addData($dados);
    }
}

print(json_encode($reply->getData()));
?>
