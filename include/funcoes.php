<?php

function formata_data($data) { //função para formatar a data recebida
    //recebe o parâmetro e armazena em um array separado por -
    $data = explode('-', $data);
    //armazena na variavel senha os valores do vetor data e concatena 
    $data = $data[2] . "/" . $data[1] . "/" . $data[0];

    //retorna a string da ordem correta, formatada
    return $data;
}

function reformata_data($data) { //função para formatar a data recebida
    //recebe o parâmetro e armazena em um array separado por /
    $data = explode('/', $data);
    //armazena na variavel senha os valores do vetor data e concatena 
    $data = $data[2] . "-" . $data[1] . "-" . $data[0];

    //retorna a string da ordem correta, formatada
    return $data;
}

function formata_dinheiro($valor) {
    $valor = str_replace(".", ",", $valor);
    $valor = "R$" . $valor;
    return $valor;
}

function reformata_dinheiro($valor) {
    $valor = str_replace(",", ".", $valor);
    $valor = str_replace("R$", "", $valor);
    return $valor;
}

function statusCaixa($dia) { //Não mudar essa função
    reformata_data($dia);
    $sql = "select * from caixa where data = '$dia'";
    $query = mysql_query($sql) or die(mysql_error());
    $num = mysql_num_rows($query);
    if ($num >= 1){
        $status = 0;
    }
    else if ($num < 1){
        $status = 1;
    }
    return $status;
}

function retornaSomaTempCaixa($data) {
    $sql = "select max(soma_valor_total) as soma from temp_caixa_dia where data = '$data' order by idtemp_caixa_dia DESC LIMIT 1";
    $query = mysql_query($sql);
    $num = mysql_num_rows($query);
    if ($num == 0) {
        $total = 0;
    } else {
        $obj = mysql_fetch_object($query);
        $total = $obj->soma;
    }
    return $total;
}

function retornaSomaTempCaixaProd($produto) {
    $sql = "select soma_valor_item as soma from temp_caixa_dia where produto_idproduto = '$produto' order by  idtemp_caixa_dia DESC LIMIT 1";
    $query = mysql_query($sql) or die(mysql_error());
    $num = mysql_num_rows($query);
    if ($num == 0) {
        $soma = 0;
    } else if ($num > 0) {
        $obj = mysql_fetch_object($query);
        $soma = $obj->soma;
    }
    return $soma;
}

function retornaSomaTempCaixaServ($servico) {
    $sql = "select max(soma_valor_item) as soma from temp_caixa_dia where servico_idservico = '$servico'";
    $query = mysql_query($sql);
    $num = mysql_num_rows($query);
    if ($num == 0) {
        $soma = 0;
    } else if ($num > 0) {
        $obj = mysql_fetch_object($query);
        $soma = $obj->soma;
    }
    return $soma;
}

function retornaSomaTempCaixaGru($gru) {
    $sql = "select max(soma_valor_item) as soma from temp_caixa_dia where gru_numero = '$gru'";
    $query = mysql_query($sql);
    $num = mysql_num_rows($query);
    if ($num == 0) {
        $soma = 0;
    } else if ($num > 0) {
        $obj = mysql_fetch_object($query);
        $soma = $obj->soma;
    }
    return $soma;
}

function tempCaixa($operacao, $data, $valor) {
    /*
     * Operações:
     * 1-Venda
     * 2-Solicitação
     * 3-GRU
     * 
     */
    $status = statusCaixa($data);
    if ($status == 0) {
        return FALSE;
    } else {
        if ($operacao == 1) {
            $data = reformata_data($data);
            $tipo = "E";
            $produto = $_POST['produto'];
            $soma = 0;
            $total = retornaSomaTempCaixa($data);
            $soma = retornaSomaTempCaixaProd($produto);
            $soma = $soma + $valor;
            $total = $total + $valor;
            $sql = "insert into temp_caixa_dia(data, soma_valor_item, tipo_e_s, produto_idproduto, soma_valor_total) VALUES
                ('$data', '$soma', '$tipo', '$produto', '$total')";
            $query = mysql_query($sql) or die(mysql_error());
            if ($query) {
                return TRUE;
            }
        } else if ($operacao == 2) {
            $data = reformata_data($data);
            $tipo = "E";
            $servico = $_POST['servico'];
            $soma = 0;
            $total = retornaSomaTempCaixa($data);
            $soma = retornaSomaTempCaixaServ($servico);
            $soma = $soma + $valor;
            $total = $total + $valor;
            $sql = "insert into temp_caixa_dia(data, soma_valor_item, tipo_e_s, servico_idservico, soma_valor_total) VALUES
                ('$data', '$soma', '$tipo', '$servico', '$total')";
            $query = mysql_query($sql) or die(mysql_error());
            if ($query) {
                return TRUE;
            }
        }
        else if ($operacao == 3){
            $data = reformata_data($data);
            $tipo = "S";
            $gru = $_POST['numero'];
            $soma = 0;
            $total = retornaSomaTempCaixa($data);
            $soma = retornaSomaTempCaixaGru($gru);
            $soma = $soma + $valor;
            $total = $total - $valor;
            $sql = "insert into temp_caixa_dia(data, soma_valor_item, tipo_e_s, gru_numero, soma_valor_total) VALUES
                ('$data', '$soma', '$tipo', '$gru', '$total')";
            $query = mysql_query($sql) or die(mysql_error());
            if ($query) {
                return TRUE;
            }
        }
        else{
            return FALSE;
        }
    }
}

function retornaSomaTotalCaixa(){
    $sql = "select * from caixa";
    $query = mysql_query($sql);
    $total = 0;
    $num = mysql_num_rows($query);
    for ($x=0;$x<$num;$x++){ //Gambiarra pra não perder o costume, vou fazer um for pra pegar o ultimo valor porque não sei fazer isso
        $obj = mysql_fetch_object($query);
        $total = $obj->valor_soma;
    }
    return $total;
}

function retornaSomaTotalCaixaDia($data){
    $sql = "select * from caixa where data = '$data'";
    $query = mysql_query($sql);
    $total = 0;
    $num = mysql_num_rows($query);
    for ($x=0;$x<$num;$x++){ //Gambiarra pra não perder o costume, vou fazer um for pra pegar o ultimo valor porque não sei fazer isso
        $obj = mysql_fetch_object($query);
        $total = $obj->valor_dia;
    }
    return $total;
}

?>
