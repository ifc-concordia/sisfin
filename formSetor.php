<?php
include "index.php";
?>
<br />
<form action="#" method="POST" name="formSetor">
    <fieldset>
        <legend>Setores</legend>
        <label for="nome">Nome:</label>
        <input type="text" id="nome" /><br />
        <input type="button" id="btGravaSetor" value="Inserir" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only botao" />
    </fieldset>
</form>
<br />

<div id="listaSetores">
    <?php
    require 'include/config.php';
    $sql = mysql_query("select * from setor");
    $num = mysql_num_rows($sql);
    if ($num == 0) {
        echo "Não existem setores cadastrados até o momento";
    } else {
        ?>
        <fieldset>
            <legend>Setores Cadastrados</legend>
            <table>
                <thead>
                    <tr><th></th>
                        <th>Setor</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                }
                for ($x = 0; $x < $num; $x++) {
                    $obj = mysql_fetch_object($sql);
                    ?>

                    <tr class="linhaTabela">
                        <td class="mouse"><a class="linkSetor" id="mouse" > <?php echo $obj->idsetor ?></a></td>
                        <td><?php echo $obj->nome ?></td>                    
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </fieldset>

</div>

<div id="dialogEditaSetor" title="Alterar Setor">
   

</div>