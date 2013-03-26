<?php
include "index.php";
require "include/config.php";
include 'include/funcoes.php';
?>

<br />
<form action="#" method="POST" name="formGru">
    <fieldset style="width: 620px">
        <legend>GRU</legend>
        <label for="numero">Numero:</label>
        <input type="text" id="numero" /><br />
        <label for="valor">Valor: </label>
        <input type="text" id="valor" /><br />
        <label for="dataGRU">Data</label>
        <input type="text" class="liberaData" id="dataGRU" onKeyUp="mascaraTexto(event,'99/99/9999')"  /><br />
        <input type="button" id="btCadastrarGRU" value="Inserir" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only botao" />
    </fieldset>
</form>
<br />

<div id="listaGRU">
    <fieldset>
        <legend>GRUs Cadastrados</legend>
        <table>
            <thead>
                <tr><th>Numero</th>
                    <th>Valor</th>
                    <th>Data</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = mysql_query("select * from gru");
                $num = mysql_num_rows($sql);
                for ($x = 0; $x < $num; $x++) {
                    $obj = mysql_fetch_object($sql);
                    ?>
                    <tr class="linhaTabela">
                        <td><?php echo utf8_encode($obj->numero) ?></td>  
                        <td><?php echo formata_dinheiro($obj->valor) ?></td> 
                        <td><?php echo formata_data($obj->data) ?></td> 
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </fieldset>
</div>