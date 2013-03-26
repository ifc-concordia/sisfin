        
<?php
include 'index.php';
include 'include/config.php';
$sql = 'select * from produto';
$query = mysql_query($sql) or die(mysql_error());
$num = mysql_num_rows($query);
?>
<br />

<div id="sucesso"></div>

<form action="#" method="POST" name="formVenda">
    <fieldset>
        <legend>Venda</legend>
        <label for="dataVenda">Data:</label>
        <input type="text" class="liberaData" id="dataVenda" onKeyUp="mascaraTexto(event,'99/99/9999')" value="<?php echo date("d/m/Y");?>" /><br />
        <label for="descricao">Descrição:</label>
        <input type="text" title="type 'a'" id="descricao" class="ui-autocomplete-input" autocomplete="off" name="descricao" /><br />
        <label for="produto">Produto</label>
        <select id="produto">
            <option value="0">Escolha...</option>
            <?php
                for($x=0;$x<$num;$x++){
                    $obj = mysql_fetch_object($query);
                    $id = $obj->idproduto;
                    $nome = utf8_encode($obj->nome);
                    print "<option value='$id'>$nome</option>";
                }
            ?>
        </select><br />
        <label for="quantidade">Quantidade</label>
        <input type="text" id="quantidade" /><br />
        <label for="valorUnitario">Valor Unitário</label>
        <input type="text" id="valorUnitario" /><br />
        <label for="valorTotal">Valor Total</label>
        <input type="text" id="valorTotal" /> <br />
        <input type="button" id="btFazerVenda" value="Inserir" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only botao" />
        <input type="button" id="btCancelar" value="Cancelar" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only botao" />
    </fieldset>
</form>
</body>
</html>
