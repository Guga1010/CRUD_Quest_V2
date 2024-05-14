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
    
    }
?>



    <main class="main">
        <section class="delete-question">
            <div class="container">
                <form class="formDelete" action="">
                    <legend>Excluir Pergunta</legend>

                    <label class="fa__labels" for="select-theme">Selecionar Tema:</label>

                    <select id="select-theme" name="select-theme" class="select-theme" required>

                        <option value="" selected disabled>Selecione um tema</option>

                        <?php

                            include "connection.php";
                            $sqlTema = "SELECT id_tema, desc_tema FROM tema";
                            $resSqlTema = $db->query($sqlTema);
                            while($dadosTema = $resSqlTema->fetchArray()){
                                echo "<option value='$dadosTema[0]'>$dadosTema[1]</option>";
                            }
                            $db->close();
                        ?>


                    </select>

                    <label class="fa__labels" for="select-question">Selecione uma Questão para excluir:</label>
                    <select id="select-question" name="select_questao" class="select-question" required>


                        <option value="" selected disabled>Selecione uma questão</option>
                       
                        <?php

                            include "connection.php";
                            $sqlPergunta = "SELECT id_pergunta, desc_pergunta FROM pergunta";
                            $resSqlPergunta= $db->query($sqlPergunta);
                            while($dadosPergunta = $resSqlPergunta->fetchArray()){
                                echo "<option value='$dadosPergunta[0]'>$dadosPergunta[1]</option>";
                            }
                            $db->close();
                        ?>


                    </select>

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