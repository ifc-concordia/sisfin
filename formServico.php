<?php
include "index.php";
require "include/config.php";
include "include/funcoes.php"
?>
<br />
<form action="#" method="POST" name="formServico">
    <fieldset style="width: 620px">
        <legend>Serviços</legend>
        <label for="nome">Nome:</label>
        <input type="text" id="nome" /><br />
        <label for="valor">Valor Unitário: </label>
        <input type="text" id="valor" /><br />
        <label for="setor">Setor</label>
        <select id="setor">
            <option value="0">Escolha...</option>
            <?php
            $sql = mysql_query("select * from setor");
            $num = mysql_num_rows($sql);
            for ($x = 0; $x < $num; $x++) {
                $obj = mysql_fetch_object($sql);
                print "<option value = '$obj->idsetor'>$obj->nome</option>";
            }
            ?>
        </select><br/>
        <input type="button" id="btGravaServico" value="Inserir" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only botao" />
    </fieldset>
</form>
<br />

<div id="listaServicos">
    <?php
    require 'include/config.php';
    $sql = mysql_query("select sv.idservico, sv.nome as servico, sv.valor_un, st.nome as setor from servico sv, setor st where sv.setor_idsetor = st.idsetor");
    $num = mysql_num_rows($sql);
    if ($num == 0) {
        echo "Não existem serviços cadastrados";
    } else {
        ?>
        <fieldset>
            <legend>Serviços Cadastrados</legend>
            <table>
                <thead>
                    <tr><th></th>
                        <th>Serviço</th>
                        <th>Valor Unitário</th>
                        <th>Setor</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    for ($x = 0; $x < $num; $x++) {
                        $obj = mysql_fetch_object($sql);
                        ?>

                        <tr class="linhaTabela">
                            <td class="mouse"><a class="linkServico"><?php echo $obj->idservico ?></a></td>
                            <td><?php echo utf8_encode($obj->servico) ?></td>  
                            <td><?php echo formata_dinheiro($obj->valor_un) ?></td> 
                            <td><?php echo $obj->setor ?></td> 
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </fieldset>
        <?php
    }
    ?>
</div>

<div id="dialogEditaServico" title="Edição de serviço" >
    
</div>