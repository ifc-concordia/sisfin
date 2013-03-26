<?php
include "index.php";
include 'include/funcoes.php';
?>
<br />
<form action="#" method="POST" name="formProduto">
    <fieldset style="width: 620px">
        <legend>Produtos</legend>
        <label for="nome">Nome:</label>
        <input type="text" id="nome" /><br />
        <label for="valor">Valor Unitário: </label>
        <input type="text" id="valor" /><br />
        <input type="button" id="btGravaProduto" value="Inserir" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only botao" />
    </fieldset>
</form>
<br />



<div id="listaProdutos">
    <?php
    require 'include/config.php';
    $sql = mysql_query("select * from produto");
    $num = mysql_num_rows($sql);
    if ($num == 0) {
        echo "Não existem produtos cadastrados até o momento";
    } else {
        ?>
        <fieldset>
            <legend>Produtos Cadastrados</legend>
            <table>
                <thead>
                    <tr><th></th>
                        <th>Produto</th>
                        <th>Valor Unitário</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                }
                for ($x = 0; $x < $num; $x++) {
                    $obj = mysql_fetch_object($sql);
                    ?>

                    <tr class="linhaTabela">
                        <td class="mouse"><a class="linkProduto"><?php echo $obj->idproduto ?></a></td>
                        <td><?php echo utf8_encode($obj->nome) ?></td>  
                        <td><?php echo formata_dinheiro($obj->valor_un) ?></td>  
                    </tr>

                    <?php
                }
                ?>
            </tbody>
        </table>
    </fieldset>

</div>

<div id="dialogEditaProduto" title="Edição de Produto">
    
</div>