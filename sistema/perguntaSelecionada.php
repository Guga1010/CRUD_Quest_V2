<?php
    include_once("templates/header.php");
?>

    <?php

        include "connection.php";

        $id_pergunta = 0;
        if(isset($_GET['pergunta'])){
            $id_pergunta = $_GET['pergunta'];
        }
        

        $sqlPergunta = "SELECT desc_pergunta, id_alternativa_pergunta FROM pergunta WHERE id_pergunta = $id_pergunta";
        $resSqlPergunta= $db->query($sqlPergunta);
        $dadosPergunta = $resSqlPergunta->fetchArray();

        $sqlAlternativa = "SELECT correta_alternativa, errada_alternativa1,errada_alternativa2,errada_alternativa3 FROM alternativa WHERE id_alternativa = $dadosPergunta[1]";
        $resSqlAlternativa= $db->query($sqlAlternativa);
        $dadosAlternativa = $resSqlAlternativa->fetchArray();

    ?>

    <main class="main">

        

        <section class="selected-question">

            <div class="container">

                <form class="formSelected" action="operacoesBD.php" method="GET">

                    <legend>Questão selecionada</legend>

                    <input type="hidden" name="pergunta" value="<?= $id_pergunta ?>">

                    <label class="fa__labels" for="question">Questão:</label>
                    
                    <input id="question" class="input__QuestaoSelecionada" name="question" type="text" value="<?= $dadosPergunta[0] ?>" placeholder="Digite a nova questão:" required>

                    <label class="fa__labels" for="correct-answer">Resposta correta:</label>
                    <input id="correct-answer" class="input__QuestaoSelecionada" name="correct-answer" type="text" value="<?= $dadosAlternativa[0] ?>" required>

                    <label class="fa__labels" for="alt1">Alternativa 1:</label>
                    <input id="alt1" class="input__QuestaoSelecionada" name="alt1" type="text" value="<?= $dadosAlternativa[1] ?>" required>

                    <label class="fa__labels" for="alt2">Alternativa 2:</label>
                    <input id="alt2" class="input__QuestaoSelecionada" name="alt2" type="text" value="<?= $dadosAlternativa[2] ?>" required>

                    <label class="fa__labels" for="alt3">Alternativa 3:</label>
                    <input id="alt3" class="input__QuestaoSelecionada" name="alt3" type="text" value="<?= $dadosAlternativa[3] ?>" required>

                    <div class="fa__container">

                        <button type="submit" name="atualizar_pergunta">Atualizar</button>

                        <a href="index.php" class="back-button">Voltar</a>

                    </div>

                </form>

            </div>

        </section>

    </main>


<?php
    include_once("templates/footer.php");   
?>