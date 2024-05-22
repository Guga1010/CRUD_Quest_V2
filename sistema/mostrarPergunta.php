<?php
    include_once("templates/header.php");
?>

    <legend>Listar Pergunta(s)</legend>

                    <label class="fa__labels" for="select-theme">Tema:</label>
                    <?php

                        $tema = 0;
                        if(isset($_GET['tema']) and $_GET['tema'] != 0)
                        {
                            $tema = $_GET['tema'];
                        }
                        
                        echo '<select name="tema"
                            onchange="this.options[this.selectedIndex].value &&
                                (window.location = this.options[this.selectedIndex].value);"
                        >';

                        include "connection.php";

                        if($tema != 0){
                            $sqlTemaEscolhido = "SELECT id_tema, desc_tema FROM tema WHERE id_tema = $tema ;";
                            $resSqlTemaEscolhido = $db->query($sqlTemaEscolhido);
                            $dadosTemaEscolhido = $resSqlTemaEscolhido->fetchArray();
                            echo "<option value=''>$dadosTemaEscolhido[1]</option>";
                        }

                        echo "<option value='mostrarPergunta.php'>Selecione um tema...</option>";
                            
                            $sqlTema = "SELECT id_tema, desc_tema FROM tema WHERE id_tema != $tema";
                            $resSqlTema = $db->query($sqlTema);

                            while($dadosTema = $resSqlTema->fetchArray()){
                                $link = "mostrarPergunta.php?tema=$dadosTema[0]";
                                echo "<option value='$link'>$dadosTema[1]</option>";
                            }
                            $db->close();
                            
                        echo "</select>";
                        
                    ?>

<table>
    <thead>
        <tr>
            <th>Código</th>
            <th>Descrição</th>
            <th>Tema</th>
            <th>Alternativas</th>
        </tr>
    </thead>
    <tbody>
    <?php   

        include "connection.php";
        if($tema != 0){
            $sqlPergunta = "SELECT id_pergunta,desc_pergunta,desc_tema,id_alternativa_pergunta
         FROM pergunta
         INNER JOIN tema ON pergunta.id_tema_pergunta = tema.id_tema
         WHERE pergunta.id_tema_pergunta = $tema;";
        }else{
            $sqlPergunta = "SELECT id_pergunta,desc_pergunta,desc_tema,id_alternativa_pergunta
         FROM pergunta
         INNER JOIN tema ON pergunta.id_tema_pergunta = tema.id_tema;";
        }
        

        $resSqlPergunta = $db->query($sqlPergunta);

        while($dadosPergunta = $resSqlPergunta->fetchArray())
        {
            echo "<tr>";
            echo "<td>$dadosPergunta[0]</td>";
            echo "<td>$dadosPergunta[1]</td>";
            echo "<td>$dadosPergunta[2]</td>";
            echo "<td><input type='button' value='Abrir'></td>";
            echo "</tr>";
        }
        $db->close();
    ?>
    </tbody>
</table>

<main>
    
</main>
        
<?php
    include_once("templates/footer.php");   
?>