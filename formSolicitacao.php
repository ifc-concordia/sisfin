<?php
include 'index.php';
include 'include/config.php'
?>
<br />

<div>
    <form action="#" method="POST" name="formSolicitacao">
        <fieldset>                
            <legend>Solicitação</legend>
            <div style="float: left; width: 85%">
                <label for="dataSolicitacao">Data:</label>                    
                <input type="text" class="liberaData" id="dataSolicitacao" onKeyUp="mascaraTexto(event,'99/99/9999')" value="<?php echo date("d/m/Y"); ?>"/><br />
                <label for="solicitante">Solicitante</label>
                <input type="text" id="solicitante" class="ui-autocomplete-input" autocomplete="off" name="solicitante" /><br />
                <label for="setor">Setor</label>
                <select id="setor">
                    <option value="0">Escolha...</option>
                    <?php
                     //   $sql = "select * from setor";
                        $sql = mysql_query("select * from setor") or die(mysql_error());
                        $num = mysql_num_rows($sql);
                        for ($x=0;$x<$num;$x++){
                            $obj = mysql_fetch_object($sql);
                            print "<option value='$obj->idsetor'>$obj->nome</option>";
                        }
                        
                    ?>
                </select><br />
                <label for="servico">Serviço</label>
                <select id="servico">
                    <option value="0">----Escolha um setor----</option>
                </select><br />
                <label for="quantidade">Quantidade</label>
                <input type="text" id="quantidade" /><br />
                <label for="valorUnitario">Valor Unitário</label>
                <input type="text" id="valorUnitario" /><br />
                <label for="valorTotal">Valor Total</label>
                <input type="text" id="valorTotal" /> <br />
            
            <input type="button" id="btSolicitar" value="Inserir" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only botao" />
            <input type="button" id="btCancelar" value="Cancelar" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only botao" />
            </div>
            <div style="float: right; width: 15%" id="fotoAluno" >
                
            </div>
        </fieldset>
    </form>
</div>
