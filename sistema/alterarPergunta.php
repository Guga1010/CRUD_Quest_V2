<?php
    include_once("templates/header.php");
?>

    <main class="main">
        <section class="update-question">
            <div class="container" id="section__Alterar">
                <form class="formUpdate" action="perguntaSelecionada.php" method="GET">
                    <legend>Atualizar Questão/Alternativas</legend>

                    <!--
                    <label class="fa__labels" for="select-theme">Selecione um tema:</label>
                    <select id="select-theme" name="selecionar_tema" class="select-theme" required>

                        <option value="" selected disabled>Selecione um tema</option>

                        <?php
                            /*
                            include "connection.php";
                            $sqlTema = "SELECT id_tema, desc_tema FROM tema";
                            $resSqlTema = $db->query($sqlTema);
                            while($dadosTema = $resSqlTema->fetchArray()){
                                echo "<option value='$dadosTema[0]'>$dadosTema[1]</option>";
                            }
                            $db->close();
                            */
                        ?>

                    </select>
                        -->

                    <label class="fa__labels" for="select-question">Selecione a Questão para atualizar:</label>
                    <select id="select-question" name="select-question" class="select-question" required>
                        <option value="" selected disabled>Selecione a Questão</option>

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
                        <button type="submit" class="fa__button">Atualizar</button>
                        <a href="index.php" class="back-button">Voltar</a>
                    </div>
                </form>
            </div>
        </section>
    </main>
        
<?php
    include_once("templates/footer.php");   
?>