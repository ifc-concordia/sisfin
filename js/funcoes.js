$(function(){  
    $("#data").datepicker({  
        dateFormat: 'dd/mm/yy',  
        dayNames: [  
        'Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'  
        ],  
        dayNamesMin: [  
        'D','S','T','Q','Q','S','S','D'  
        ],  
        dayNamesShort: [  
        'Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'  
        ],  
        monthNames: [  
        'Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro',  
        'Outubro','Novembro','Dezembro'  
        ],  
        monthNamesShort: [  
        'Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set',  
        'Out','Nov','Dez'  
        ],  
        nextText: 'Próximo',  
        prevText: 'Anterior',
        minDate: new Date()
        
        
        
     
    });  
}); 
$(function(){  
    $(".data").datepicker({  
        dateFormat: 'dd/mm/yy',  
        dayNames: [  
        'Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'  
        ],  
        dayNamesMin: [  
        'D','S','T','Q','Q','S','S','D'  
        ],  
        dayNamesShort: [  
        'Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'  
        ],  
        monthNames: [  
        'Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro',  
        'Outubro','Novembro','Dezembro'  
        ],  
        monthNamesShort: [  
        'Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set',  
        'Out','Nov','Dez'  
        ],  
        nextText: 'Próximo',  
        prevText: 'Anterior'
        
     
    });  
}); 

//$(function(){
//    $(".liberaData").datepicker({
//        DateFormat: 'dd/mm/yy',  
//        dayNames: [  
//        'Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'  
//        ],  
//        dayNamesMin: [  
//        'D','S','T','Q','Q','S','S','D'  
//        ],  
//        dayNamesShort: [  
//        'Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'  
//        ],  
//        monthNames: [  
//        'Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro',  
//        'Outubro','Novembro','Dezembro'  
//        ],  
//        monthNamesShort: [  
//        'Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set',  
//        'Out','Nov','Dez'  
//        ],  
//        nextText: 'Próximo',  
//        prevText: 'Anterior',
//        
//        minDate: new Date()
//    })
//})

// ---------------- Funções para os setores

function gravaSetor(){
    nome = $("#nome").val();
    $.ajax({
        type: 'post',
        data: {
            acao: 'gravaSetor',
            nome: nome
        },
        url: "./dados.php",
        dataType: "json",
        success: function(){
            alert("Setor cadastrado com sucesso");
            top.location.href = "./formSetor.php";
        },
        error: function(){
            alert("Não foi possivel concluir a gravação!");
        }
        
    })
}

function dialogoSetor(setor){
    $.ajax({
        type: 'post',
        data: {
            acao: 'retornaSetor',
            setor:setor
        },
        url: './dados.php',
        dataType: 'json',
        success: function(data){
            $("#dialogEditaSetor").empty();
            $("#dialogEditaSetor").append("<input type='text' id='setor' value='" + data.dados[0].nome + "' />" +
                "<input type='hidden' id='idsetor' value='" + data.dados[0].idsetor + "' />");
        },
    
        error: function(){
            alert("erro");
        }
    })
}

function atualizaSetor(setor, idsetor){
    $.ajax({
        type: 'post',
        data: {
            acao: 'atualizaSetor',
            setor:setor,
            idsetor: idsetor
        },
        url: './dados.php',
        dataType: 'json',
        success: function(){
            alert("Gravação efetuada com sucesso")
            top.location.href="./formSetor.php"
        },
        error: function(){
            alert("Erro")
        }
    })
}





// --------------Funções para os produtos -------------------------------

function gravaProduto(){
    nome = $("#nome").val();
    valor = $("#valor").val();
    $.ajax({
        type: 'post',
        data: {
            acao: 'gravaProduto',
            nome: nome,
            valor: valor
        },
        url: "./dados.php",
        dataType: "json",
        success: function(){
            alert("Produto cadastrado com sucesso");
            top.location.href = "./formProduto.php";
        },
        error: function(){
            alert("Não foi possivel concluir a gravação!");
        }
        
    })
}

function dialogoProduto(produto){
    $.ajax({
        type: 'post',
        data: {
            acao: 'retornaProduto',
            produto:produto
        },
        url: './dados.php',
        dataType: 'json',
        success: function(data){
            $("#dialogEditaProduto").empty();
            $("#dialogEditaProduto").append("<label>Nome:</label><input type='text' id='produto' value='" + data.dados[0].nome + "' /><br />" +
                "<label>Valor:</label><input type='text' class='valor' value='" + data.dados[0].valor + "' />" +
                "<input type='hidden' id='idproduto' value='" + data.dados[0].idproduto + "' />");
        },
    
        error: function(){
            alert("erro");
        }
    })
}

function atualizaProduto(produto, idproduto, valor){
    $.ajax({
        type: 'post',
        data: {
            acao: 'atualizaProduto',
            produto:produto,
            idproduto:idproduto,
            valor:valor
        },
        url: './dados.php',
        dataType: 'json',
        success: function(){
            alert("Gravação efetuada com sucesso")
            top.location.href="./formProduto.php"
        },
        error: function(){
            alert("Erro")
        }
    })
}


//---------------------------Funções para os serviços-----------------------
function gravaServico(){
    nome = $("#nome").val();
    valor = $("#valor").val();
    setor = $("#setor option:selected").val()
    $.ajax({
        type: 'post',
        data: {
            acao: 'gravaServico',
            nome: nome,
            valor: valor,
            setor:setor
        },
        url: "./dados.php",
        dataType: "json",
        success: function(){
            alert("Serviço cadastrado com sucesso");
            top.location.href = "./formServico.php";
        },
        error: function(){
            alert("Não foi possivel concluir a gravação!");
        }
        
    })
}

function dialogoServico(servico){
    $.ajax({
        type: 'post',
        data: {
            acao: 'retornaServico',
            servico:servico
        },
        url: './dados.php',
        dataType: 'json',
        success: function(data){
            $("#dialogEditaServico").empty();
            $("#dialogEditaServico").append("<label>Descrição:</label><input type='text' id='servico' value='" + data.dados[0].nome + "' />" +
                "<input type='hidden' id='idservico' value='" + data.dados[0].idservico + "' /><br />" +
                "<label>Valor: </label><input type='text' class='valor' value='" + data.dados[0].valor + "' /><br />" + 
                "<label>Setor: </label><select id='dlgsetor'><option value='" + data.dados[0].idsetor + "'>" + data.dados[0].setor +"</option></select>");
        },
    
        error: function(){
            alert("erro");
        }
    })
}

function preencheSetores(){
    $.ajax({
        type: 'post',
        data: {
            acao: 'listaSetores'
        },
        url: './dados.php',
        dataType: 'json',
        success: function(data){
            for (i in data.dados)
                $("dlgsetor").append("<option value='" + data.dados[i].idsetor + "'>" + data.dados[i].nome + "</option>")
        }
    })
}

function atualizaServico(nome, idservico, valor){
    $.ajax({
        type: 'post',
        data: {
            acao: 'atualizaServico',
            nome:nome,
            idservico:idservico,
            valor:valor
        },
        url: './dados.php',
        dataType: 'json',
        success: function(){
            alert("Gravação efetuada com sucesso")
            top.location.href="./formServico.php"
        },
        error: function(){
            alert("Erro")
        }
    })
}
//--------------------------------Senha --------------------------------------

function alteraSenha(senhaAntiga, novaSenha, confirmaSenha){
    if ((senhaAntiga == "")||(novaSenha == "")||(confirmaSenha == "")){
        alert("Campo em branco")
    }
    else if (!(novaSenha == confirmaSenha)){
        alert("A confirmação difere da nova senha")
    }
    else{
        $.ajax({
            type: 'post',
            url: './dados.php',
            dataType: 'json',
            data:{
                acao: 'alterarSenha',
                senhaAntiga:senhaAntiga,
                novaSenha:novaSenha,
                confirmaSenha:confirmaSenha
            },
            success: function(data){
                alert("Senha modificada com sucesso");
                top.location.href = "./logout.php";                
            },
            error: function(){
                alert("Erro")
            }
        })
    }
}

function dataMinima(){
    $.ajax({
        type: 'post',
        url: './dados.php',
        dataType: 'json',
        data: {
            acao: 'dataMinima'
        },
        success: function(data) {
            dataUltimoFechamento = data.dados[0].dataMin            
            $(".liberaData").datepicker("option", "minDate", dataUltimoFechamento)
        }
    })
}

//----------------------------Execução do script------------------------------

$(document).ready(function(){
//    $.ajax({
//        type: 'post',
//        url: './dados.php',
//        dataType: 'json',
//        data: {
//            acao: 'dataMinima'
//        },
//        success: function(data) {
//            dataUltimoFechamento = data.dados[0].data
//        }
//    })
    dataMinima();
//    alert(dataMin + "dataMin")
//    alert("oi")
    dataHoje = new Date();
    cConfigDatePicker = {        
        dateFormat: 'dd/mm/yy',
        dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],  
        dayNamesMin: ['D','S','T','Q','Q','S','S','D'],  
        dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],  
        monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],  
        monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
        
        beforeShowDay:
        function(date) {
            var day = date.getDay();
            return [(day !== 0), ''];
        },
        nextText: 'Próximo',
        prevText: 'Anterior'
    };
  
    $(".liberaData").datepicker(cConfigDatePicker);
    
    $('#dialogEditaSetor').dialog({
        autoOpen: false,
        width: 800,
        buttons: {
            "Fechar": function() {
                $(this).dialog("close");
            },
            "Salvar": function(){
                setor = $("#setor").val();
                idsetor = $("#idsetor").val();
                atualizaSetor(setor, idsetor);
                $(this).dialog("close");
                
            }
        }
    })
    
    $('#dialogEditaProduto').dialog({
        autoOpen: false,
        width: 800,
        buttons: {
            "Fechar": function() {
                $(this).dialog("close");
            },
            "Salvar": function(){
                produto = $("#produto").val();
                idproduto = $("#idproduto").val();
                valor = $(".valor").val();
                atualizaProduto(produto, idproduto, valor)
                $(this).dialog("close");
                
            }
        }
    })
    
    $('#dialogEditaServico').dialog({
        autoOpen: false,
        width: 800,
        buttons: {
            "Fechar": function() {
                $(this).dialog("close");
            },
            "Salvar": function(){
                nome = $("#servico").val();
                idservico = $("#idservico").val();
                valor = $(".valor").val();
                atualizaServico(nome, idservico, valor)
                $(this).dialog("close");
                
            }


        }
    })
    
    //---------Fim da programação dos dialogos--------------------------------------
    //-----------------------------SETOR--------------------------------------------
    $("#btGravaSetor").click(function(){
        gravaSetor();
    });

    $(".linkSetor").click(function(){
        setor = $(this).text();
        $("#dialogEditaSetor").dialog('open');
        dialogoSetor(setor);
    });
    
    //--------------------------PRODUTO--------------------------------------------
    $("#btGravaProduto").click(function(){
        gravaProduto();
    });
    
    $(".linkProduto").click(function(){
        produto = $(this).text();
        $("#dialogEditaProduto").dialog('open');
        dialogoProduto(produto);
    });
    
    //---------------------------SERVIÇO--------------------------------------------
    $("#btGravaServico").click(function(){
        gravaServico();
    });
    
    $(".linkServico").click(function(){
        servico = $(this).text();
        $("#dialogEditaServico").dialog('open');
        dialogoServico(servico);
              
    });
    
    $("#btAlterarSenha").click(function(){
        senhaAntiga = $("#senhaAntiga").val();
        novaSenha = $("#senhaNova").val();
        confirmaSenha = $("#confirmaSenhaNova").val();        
        alteraSenha(senhaAntiga, novaSenha, confirmaSenha)
       
    })
    //---------------------------


})