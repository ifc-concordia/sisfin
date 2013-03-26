//Script Jquery para movimentações

function preencheServicos(setor){
    $.ajax({
        type: 'post',
        dataType: 'json',
        data: {
            acao: 'buscaServicos',
            setor:setor
        },
        url: './dados.php',
        success: function(data){ 
            $('#servico').empty()
            $('#servico').append("<option value= '0'></option>")
            for (var i in data.dados){                
                $('#servico').append
                ("<option value= " + data.dados[i].idservico + ">"+ data.dados[i].nome + "</option>")
                
            }
        },
        error: function(){
            alert("Erro");
        }
    })
}


function preencheValorUnitario(produto){
    $.ajax({
        type: 'post',
        dataType: 'json',
        data: {
            acao: 'retornaProduto',
            produto:produto
        },
        url: './dados.php',
        success: function(data){
            $("#valorUnitario").attr("value", data.dados[0].valor)
        }
    })
}

function preencheValorTotal(valor_un, quantidade){
    $.ajax({
        type: 'post',
        dataType: 'json',
        data: {
            acao:'calculaValorTotal',
            valor_un:valor_un,
            quantidade:quantidade
        },
        url: './dados.php',
        success: function(data){
            $("#valorTotal").attr("value", data.dados[0].valor)
        },
        error: function(){
            alert("erro")
        }
    })
}

function validaVenda(data, produto, quantidade, valorUnitario, valorTotal){
    if (data == "" || produto == "" || quantidade == "" || valorUnitario == "" || valorTotal == ""){
        return false
    }
    return true
}

function efetuaVenda(data, descricao, produto, quantidade, valorUnitario, valorTotal){
    $.ajax({
        type: 'post',
        dataType: 'json', 
        data: {
            acao: 'efetuaVenda',
            data:data,
            descricao:descricao,
            produto:produto,
            quantidade:quantidade,
            valorUnitario:valorUnitario,
            valorTotal:valorTotal
        },
        url: './dados.php',
        success: function(data){
            if (data.dados[0].status == 0){                
                alert("Não é possível efetuar vendas nesta data, caixa já fechado");
            }
            else{
                alert("Venda efetuada");
                top.location.href = "./formVenda.php"
            }            
        },
        error: function(){
            alert("erro")
        }
        
    })
}

//Solicitações

function fotoAluno(matricula){
    $.ajax({
        type: 'post',
        dataType: 'json',
        data: {
            acao: 'procurarFoto',
            matricula: matricula
        },
        url: './dados.php',
        success: function(data){
            $("#fotoAluno").empty()
            $("#fotoAluno").append("<img src='" + data.dados[0].caminho + "' width='120px' height = '180px'><br>" + 
                "<font><b>" + data.dados[0].pessoa + "</b></font>")
        },
        error: function(){
            $("#fotoAluno").append("<font color='red'>Erro </font>")
        }
    })
    
}

function preencheValorUnitarioServ(servico){
    $.ajax({
        type: 'post',
        dataType: 'json',
        data: {
            acao: 'retornaServico',
            servico:servico
        },
        url: './dados.php',
        success: function(data){
            $("#valorUnitario").attr("value", data.dados[0].valor)
        }
    })
}

function preencheValorTotalServ(valor_un, quantidade){
    $.ajax({
        type: 'post',
        dataType: 'json',
        data: {
            acao:'calculaValorTotal',
            valor_un:valor_un,
            quantidade:quantidade
        },
        url: './dados.php',
        success: function(data){
            $("#valorTotal").attr("value", data.dados[0].valor)
        },
        error: function(){
            alert("erro")
        }
    })
}

function validaSolictacao(data, solicitante, setor, servico, quantidade, valorUnitario,valorTotal){
    if (data == "" || solicitante == "" || setor == "" || servico == ""|| quantidade == "" || valorUnitario == "" || valorTotal == ""){
        return false
    }
    return true
}

function efetuaSolicitacao(data, solicitante, setor, servico, quantidade, valorUnitario, valorTotal){
    $.ajax({
        type: 'post',
        dataType: 'json', 
        data: {
            acao: 'efetuaSolicitacao',
            data:data,
            solicitante:solicitante,
            setor:setor,
            servico:servico,
            quantidade:quantidade,
            valorUnitario:valorUnitario,
            valorTotal:valorTotal
        },
        url: './dados.php',
        success: function(data){
            if (data.dados[0].status == 0){                
                alert("Não é possível efetuar Solicitações nesta data, caixa já fechado");
            }
            else{
                alert("Solictação efetuada");
                top.location.href = "./formSolicitacao.php"
            }            
        },
        error: function(){
            alert("erro")
        }
        
    })
}


//solicitações
function carregaSolicitacoesPendentes(usuario){
    $.ajax({
        type: 'post',
        dataType: 'json',
        data: {
            acao: 'carregaSolicitacoesPendentes',
            usuario:usuario
        },
        url: './dados.php',
        success: function(data){ 
            if (data.dados == ""){
                $("#atender").empty();
                $("#atender").append("<font color = 'red'>Usuario não tem solicitações pendentes</font>");
            }
            else{
                $("#atender").empty();
                conteudo = "<table><tbody><th></th><th>Setor</th><th>Data</th><th>Servico" + 
                "</th><th>Quantidade</th><th></th></tbody>";
                for (var i in data.dados){   
                    conteudo = conteudo + "<tr class='linhaTabela'><td><a class='mouse'>" + data.dados[i].idsolicitacao + "</a></td>" +
                    "<td>"+data.dados[i].setor + "</td>" +
                    "<td>" + data.dados[i].data + "</td>" +
                    "<td>" + data.dados[i].servico + "</td>" +
                    "<td>" + data.dados[i].quantidade + "</td></tr>";
                }
                conteudo = conteudo + "</table>"
                $("#atender").append(conteudo)
            }
            
        }
    })
}

function consultaUsuario(usuario, senha){
    $.ajax({
        type: 'post',
        dataType: 'json',
        data: {
            acao: 'consultaUsuario',
            usuario:usuario,
            senha:senha
        },
        url: './dados.php',
        success: function(data){
            if (data.dados[0].num == 0){
                alert("Esse cara ta zuando? Usuario ou senha errado, mande ele digitar outra vez")
            }
            else{
                carregaSolicitacoesPendentes(usuario)
            }
        }
    })
}

function dialogoAtendimento(solicitacao){
    $("#dialogAtendimento").empty();
    $("#dialogAtendimento").html("<label>Quantidade</label><input type='text' id='quantidade' />" +
        "<input type='hidden' id='solicitacao' value='" + solicitacao + "'/>")
}

function atendeSolicitacao(quantidadePedida, solicitacao){
    $.ajax({
        type: 'post',
        dataType: 'json',
        url: './dados.php',
        data: {
            acao: 'atendeSolicitacao',
            quantidadePedida:quantidadePedida,
            solicitacao:solicitacao
        },
        success: function(data){
            retorno = data.dados[0].retorno
            if (retorno == 0){
                alert("Quantidade muito alta")
            }
            else{
                alert("Atendimento feito com sucesso");
                top.location.href="./formAtendimento.php"
            }
        },
        error: function(){
            alert("Erro mano, deu um fronho aí nesse trem :(")
        }
    })
}

//GRU

function cadastraGRU(numero,valor, data){
    $.ajax({
        type: 'post',
        dataType: 'json',
        url: './dados.php',
        data: {
            acao: 'cadastraGRU',
            numero:numero,
            valor:valor,
            data:data
        },
        success: function(data){
            alert("GRU cadastrada com sucesso")
            top.location.href = "./formGRU.php"
        },
        error: function(){
            alert("Erro")
        }
    })
}

function encerrarCaixa(data){
    $.ajax({
        type: 'post',
        dataType: 'json',
        url: './dados.php',
        data: {
            acao: 'encerrarCaixa',
            data:data
        },
        success: function(data){
            if (data.dados[0].status == 0){
                alert("Nesta data o caixa ja foi fechado, pode chorar");
            }
            else if (data.dados[0].status == 1){
                alert("Fechamento Efetuado, tchau por hoje, vamos descansar?");
                top.location.href = "./index.php";
            }                
        },
        error: function(){
            alert("Erro bizonho escalando a montanha do himalaia, chame o badanha");
            alert("Entendeu né? deu problema ao fechar o caixa, corram para as colinas");
        }
    })
}

function mostraSolicitacoesUsuarios(usuario){
    $.ajax({
        type: 'post',
        dataType: 'json',
        data: {
            acao: 'carregaSolicitacoesPendentes',
            usuario:usuario
        },
        url: './dados.php',
        success: function(data){
            if (data.dados == ""){
                $("#listaCreditos").empty();
                $("#listaCreditos").append("<font color = 'red'>Usuario não tem solicitações pendentes</font>");
            }
            else{
                $("#listaCreditos").empty();
                conteudo = "<table><tbody><th>Servico" + 
                "</th><th>Quantidade</th></tbody>";
                for (var i in data.dados){   
                    conteudo = conteudo + "<tr class='linhaTabela'>" +                    
                    "<td>" + data.dados[i].servico + "</td>" +
                    "<td>" + data.dados[i].quantidade + "</td></tr>";
                }
                conteudo = conteudo + "</table>"
                $("#listaCreditos").append(conteudo)
            }
        }
    })

}

function emiteLivroCaixa(ano){
    $.ajax({
        type: 'post',
        dataType: 'json',
        url: './dados.php',
        data: {
            acao: 'emitirLivroCaixa',
            ano:ano
        },
        success: function(data){
            $("#livroCaixa").empty();
            conteudo = "";
            if (data.dados == ""){
                conteudo = "Sem movimentações"
            }
            
            else{
                conteudo = "<table><thead><th>Data</th><th>Historico</th><th>Valor</th><th>Valor dia</th><th>Valor em Caixa</th></thead><tbody>";
                for (var i in data.dados){
                    conteudo = conteudo + "<tr class= 'linhaTabela'><td>" + data.dados[i].data + "</td><td>" + data.dados[i].nome + "</td>" + 
                    "<td>" + data.dados[i].valor + "</td><td>" + data.dados[i].somaDia + "</td><td>" + 
                    data.dados[i].somaTotal + "</td></tr>"
                }
                conteudo = conteudo + "</tbody></table>"  
            }
            $("#livroCaixa").append(conteudo);
        }
    })
}

function geraRelatorio(dataInicial, dataFinal){
    $.ajax({
        type: 'post',
        dataType: 'json',
        url: './dados.php',
        data: {
            acao: 'emitirRelatorio',
            dataInicial: dataInicial,
            dataFinal: dataFinal
        },
        success: function(data){
            $("#relatorio").empty();
            conteudo = "";
            if (data.dados == ""){
                conteudo = "Sem movimentações"
            }
             else{
                conteudo = "<table><thead><th>Data</th><th>Historico</th><th>Valor</th><th>Valor dia</th><th>Valor total</th></thead><tbody>";
                for (var i in data.dados){
                    conteudo = conteudo + "<tr class= 'linhaTabela'><td>" + data.dados[i].data + "</td><td>" + data.dados[i].nome + "</td>" + 
                    "<td>" + data.dados[i].valor + "</td><td>" + data.dados[i].somaDia + "</td><td>" + 
                    data.dados[i].somaTotal + "</td></tr>"
                }
                conteudo = conteudo + "</tbody></table>"  
            }
            $("#relatorio").append(conteudo);
        },
        error: function(){
            alert("Erro")
        }
    })
}

$(document).ready(function(){
    $('#dialogAtendimento').dialog({
        autoOpen: false,
        width: 800,
        buttons: {
            "Fechar": function() {
                $(this).dialog("close");
            },
            "Salvar": function(){
                quantidade = $(this).find("#quantidade").val();
                solicitacao = $(this).find("#solicitacao").val();
                atendeSolicitacao(quantidade, solicitacao)
            //$(this).dialog("close"); 
            //top.location.href='formAtendimento.php'
            }
        }
    })
    
    
    $("#produto").change(function(){
        produto = $("#produto option:selected").val();
        preencheValorUnitario(produto)
    })
    
    $("#valorTotal").focusin(function(){
        valor_un = $("#valorUnitario").val();
        quantidade = $("#quantidade").val();
        preencheValorTotal(valor_un, quantidade)
        
    })
    
    $("#btFazerVenda").click(function(){
        data = $("#dataVenda").val();
        produto = $("#produto").find("option:selected").val();
        quantidade = $("#quantidade").val();
        valorUnitario = $("#valorUnitario").val();
        descricao = $("#descricao").val();
        valorTotal = $("#valorTotal").val();
        if (!validaVenda(data, produto, quantidade, valorUnitario, valorTotal)){
            alert("Campo em branco")
        }
        else if (validaVenda(data, produto, quantidade, valorUnitario, valorTotal)){
            efetuaVenda(data, descricao, produto, quantidade, valorUnitario, valorTotal)
        }
    })
    
    //Solicitações
    
    $("#solicitante").focusout(function(){
        matricula = $(this).val();
        fotoAluno(matricula)
    });
    
    $("#setor").change(function(){
        setor = $(this).find("option:selected").val();
        preencheServicos(setor);
    })
    
    $("#servico").change(function(){
        servico = $(this).find("option:selected").val();
        preencheValorUnitarioServ(servico);
    })
    
    $("#btSolicitar").click(function(){
        data = $("#dataSolicitacao").val();
        solicitante = $("#solicitante").val();
        setor = $("#setor").find("option:selected").val();
        servico = $("#servico").find("option:selected").val();
        quantidade = $("#quantidade").val();
        valorUnitario = $("#valorUnitario").val();
        valorTotal = $("#valorTotal").val();
        if (!validaSolictacao(data, solicitante, setor, servico, quantidade, valorUnitario, valorTotal)){
            alert("Campo em branco")
        }
        else if (validaSolictacao(data, solicitante, setor, servico, quantidade, valorUnitario, valorTotal)){
            efetuaSolicitacao(data, solicitante, setor, servico, quantidade, valorUnitario, valorTotal)
        }
    })
    
    //Atendimento
    
    $("#btAtender").click(function(){
        usuario = $("#identificacao").val();
        senha = $("#senha").val();
        consultaUsuario(usuario,senha)
        
    })
    
    $("#atender").delegate(".mouse", "click", function(){
        solicitacao = $(this).text();
        $("#dialogAtendimento").dialog('open');
        dialogoAtendimento(solicitacao);
        
    })
    
    //GRU 
    
    $("#btCadastrarGRU").click(function(){
        numero = $("#numero").val();
        valor = $("#valor").val();
        data = $("#dataGRU").val();
        cadastraGRU(numero,valor, data);
    })
    
    //Encerra Caixa
    
    $("#btEncerrarCaixa").click(function(){
        data = $("#dataEncerrar").val()
        encerrarCaixa(data);
    })
    
    $("#btConsultaCredito").click(function(){
        usuario = $("#solicitante").val();
        mostraSolicitacoesUsuarios(usuario)
    })
    
    $("#solicitante").keypress(function(e){            
        if(e.which == 13){
            usuario = $(this).val();
            mostraSolicitacoesUsuarios(usuario);
            e.preventDefault();
        }
    })
    
    $("#btAnoLivroCaixa").click(function(){
        ano = $("#ano").val();
        emiteLivroCaixa(ano)
    })
    
    $("#ano").keypress(function(e){
        if(e.which == 13){
            ano = $(this).val();
            emiteLivroCaixa(ano);
            e.preventDefault();
        }
    })
    
    $("#btRelatorio").click(function(){
        dataInicial = $("#dataInicial").val();
        dataFinal = $("#dataFinal").val();
        geraRelatorio(dataInicial, dataFinal);
    })
    
})