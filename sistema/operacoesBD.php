<?php
    if($_SERVER['REQUEST_METHOD'] === 'GET'){
       
        if(isset($_GET['excluir_pergunta'])){

            include "connection.php";

            $id_pergunta = $_GET['pergunta'];

            $sqlIdAlternativa = "SELECT id_alternativa_pergunta FROM pergunta WHERE id_pergunta = $id_pergunta";
            $resSqlIdAlternativa = $db->query($sqlIdAlternativa);
            $dadosAlternativa = $resSqlIdAlternativa->fetchArray();

            $sqlExcluiAlternativa = "DELETE FROM alternativa WHERE id_alternativa = $dadosAlternativa[0]";
            $db->query($sqlExcluiAlternativa);

            $sqlExcluiPergunta = "DELETE FROM pergunta WHERE id_pergunta = $id_pergunta";
            $db->query($sqlExcluiPergunta);

            $msg = "Pergunta excluida!";

            $db->close();

            header("Location: excluirPergunta.php?msg=" . $msg);
            exit();
        }

        else if(isset($_GET['excluir_tema'])){
            include "connection.php";

            $id_tema = $_GET['tema'];
        
            $sqlTema = "DELETE FROM tema WHERE id_tema = $id_tema";
            $db->query($sqlTema);
    
            $sqlPergunta = "SELECT id_alternativa_pergunta FROM pergunta WHERE id_tema_pergunta = $id_tema";
            $resSqlPergunta = $db->query($sqlPergunta);
            while($dadosPergunta = $resSqlPergunta->fetchArray()){
                $sqlAlternativa = "DELETE FROM alternativa WHERE id_alternativa = $dadosPergunta[0]";
                $db->query($sqlAlternativa);
                $sqlExcluiPergunta = "DELETE FROM pergunta WHERE id_alternativa_pergunta = $dadosPergunta[0]";
                $db->query($sqlExcluiPergunta);
            }
            
            $msg = "Tema excluido!";

            $db->close();

            header("Location: excluirTema.php?msg=" . $msg);
            exit();
        }
        else if(isset($_GET['atualizar_pergunta'])){

            include "connection.php";

            $formQuestion = $_GET['question'];

            $form_correctAnswer = $_GET['correct-answer'];
            $form_wrongAnswer1 = $_GET['alt1'];
            $form_wrongAnswer2 = $_GET['alt2'];
            $form_wrongAnswer3 = $_GET['alt3'];

            $id_pergunta = $_GET['pergunta'];

            $sqlPergunta = "SELECT id_alternativa_pergunta FROM pergunta WHERE id_pergunta = $id_pergunta";
            $resSqlPergunta= $db->query($sqlPergunta);
            $dadosPergunta = $resSqlPergunta->fetchArray();
            
            $sqlUpdateAlternativas = "UPDATE alternativa SET correta_alternativa = '$form_correctAnswer', errada_alternativa1 = '$form_wrongAnswer1'," . 
            "errada_alternativa2 = '$form_wrongAnswer2',errada_alternativa3 = '$form_wrongAnswer3' WHERE id_alternativa = $dadosPergunta[0]";
            $db->query($sqlUpdateAlternativas);

            $sqlUpdatePerguntas = "UPDATE pergunta SET desc_pergunta = '$formQuestion' WHERE id_pergunta = $id_pergunta";
            $db->query($sqlUpdatePerguntas);

            $msg = "Pergunta atualizada!";

            $db->close();

            header("Location: alterarPergunta.php?msg=" . $msg);
            exit();

        }

    }
?>