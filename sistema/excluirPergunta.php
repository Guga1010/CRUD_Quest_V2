<?php
    include_once("templates/header.php");
?>

<?php

    if(isset($_GET['select_questao'])){

        include "connection.php";


        $id_pergunta = $_GET['select_questao'];

        $sqlIdAlternativa = "SELECT id_alternativa_pergunta FROM pergunta WHERE id_pergunta = $id_pergunta";
        $resSqlIdAlternativa = $db->query($sqlIdAlternativa);
        $dadosAlternativa = $resSqlIdAlternativa->fetchArray();

        $sqlExcluiAlternativa = "DELETE FROM alternativa WHERE id_alternativa = $dadosAlternativa[0]";
        $db->query($sqlExcluiAlternativa);

        $sqlExcluiPergunta = "DELETE FROM pergunta WHERE id_pergunta = $id_pergunta";
        $db->query($sqlExcluiPergunta);

        $db->close();
    
    }
?>



    <main class="main">
        <section class="delete-question">
            <div class="container">
                <form class="formDelete" action="">

                    <legend>Excluir Pergunta</legend>

                    <label class="fa__labels" for="select-theme">Tema:</label>
                    <?php

                        $tema = 0;
                        if(isset($_GET['tema']) and $_GET['tema'] != 0){
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

                        echo "<option value='excluirPergunta.php'>Selecione um tema...</option>";

                            $sqlTema = "SELECT id_tema, desc_tema FROM tema WHERE id_tema != $tema";
                            $resSqlTema = $db->query($sqlTema);
                            while($dadosTema = $resSqlTema->fetchArray()){
                                $link = "excluirPergunta.php?tema=$dadosTema[0]";
                                echo "<option value='$link'>$dadosTema[1]</option>";
                            }
                            $db->close();
                            
                        echo "</select>";
                        
                    ?>
                    

                    <label class="fa__labels" id="h1__exclusao" for="select-question">Questão:</label>
                    

                        <?php
                        /* Continuar as alterações nas perguntas */
                            echo ' <select name="pergunta"
                                onchange="this.options[this.selectedIndex].value &&
                                (window.location = this.options[this.selectedIndex].value);"
                            >';
                            
                            include "connection.php";

                            echo '<option value="">Selecione uma pergunta...</option>';

                            $sqlPergunta = "SELECT id_pergunta, desc_pergunta FROM pergunta";
                            $resSqlPergunta= $db->query($sqlPergunta);
                            while($dadosPergunta = $resSqlPergunta->fetchArray()){
                                $link = "excluirPergunta.php?tema=&pergunta=$dadosPergunta[0]";
                                echo "<option value='$link'>$dadosPergunta[1]</option>";
                            }
                            $db->close();

                            
                            echo "</select>";
                        ?>
                        
                       
    



                    <div class="fa__container">
                        <input id="fa__button--delete" type="submit" class="fa__button" value="Deletar" data-buttonDelete>
                        <a href="index.php" class="back-button">Voltar</a>
                    </div>
                </form>
            </div>
        </section>
    </main>
        
<?php
    include_once("templates/footer.php");   
?>