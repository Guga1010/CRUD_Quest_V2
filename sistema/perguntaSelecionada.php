<?php
    include_once("templates/header.php");
?>


<?php
    session_start();

    if(isset($_GET['question'])){

        include "connection.php";

        $formQuestion = $_GET['question'];

        $form_correctAnswer = $_GET['correct-answer'];
        $form_wrongAnswer1 = $_GET['alt1'];
        $form_wrongAnswer2 = $_GET['alt2'];
        $form_wrongAnswer3 = $_GET['alt3'];

        $id_pergunta = $_SESSION['id_pergunta'];

        $sqlPergunta = "SELECT id_alternativa_pergunta FROM pergunta WHERE id_pergunta = $id_pergunta";
        $resSqlPergunta= $db->query($sqlPergunta);
        $dadosPergunta = $resSqlPergunta->fetchArray();
        
        $sqlUpdateAlternativas = "UPDATE alternativa SET correta_alternativa = '$form_correctAnswer', errada_alternativa1 = '$form_wrongAnswer1'," . 
        "errada_alternativa2 = '$form_wrongAnswer2',errada_alternativa3 = '$form_wrongAnswer3' WHERE id_alternativa = $dadosPergunta[0]";
        $db->query($sqlUpdateAlternativas);

        $sqlUpdatePerguntas = "UPDATE pergunta SET desc_pergunta = '$formQuestion' WHERE id_pergunta = $id_pergunta";
        $db->query($sqlUpdatePerguntas);
    

    }
?>

    <?php

        include "connection.php";

        
        if(isset($_GET['select-question'])){
            echo "if";
            $id_pergunta = $_GET['select-question'];
            $_SESSION['id_pergunta'] = $id_pergunta;
        }
        else
        {   
            echo "else";
            $id_pergunta = $_SESSION['id_pergunta'];
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
                <form class="formSelected" action="" method="GET">
                    <legend>Questão selecionada</legend>

                    <label class="fa__labels" for="question">Questão:</label>
                    
                    <input id="question" name="question" type="text" value="<?= $dadosPergunta[0] ?>" placeholder="Digite a nova questão:" required>

                    <label class="fa__labels" for="correct-answer">Resposta correta:</label>
                    <input id="correct-answer" name="correct-answer" type="text" value="<?= $dadosAlternativa[0] ?>" required>

                    <label class="fa__labels" for="alt1">Alternativa 1:</label>
                    <input id="alt1" name="alt1" type="text" value="<?= $dadosAlternativa[1] ?>" required>

                    <label class="fa__labels" for="alt2">Alternativa 2:</label>
                    <input id="alt2" name="alt2" type="text" value="<?= $dadosAlternativa[2] ?>" required>

                    <label class="fa__labels" for="alt3">Alternativa 3:</label>
                    <input id="alt3" name="alt3" type="text" value="<?= $dadosAlternativa[3] ?>" required>

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