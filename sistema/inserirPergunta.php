<?php
    include_once("templates/header.php");
?>

<?php
    if(isset($_GET['inserir_pergunta'])){

        $msg = "";

        include "connection.php";

        $id_tema = 0;
        if(isset($_GET['tema']))
        {   
            $id_tema = $_GET['tema'];
        }
        else if(isset($_GET['tema_add']))
        {   
            
            $sqlTema = "INSERT INTO tema (desc_tema) VALUES ('". $_GET['tema_add'] . "')";
            $resSqlTema = $db->query($sqlTema);

            $sqlSelectIdMaxTema = "SELECT MAX(id_tema) FROM tema";
            $resSqlSelectIdMaxTema = $db->query($sqlSelectIdMaxTema);
            $dadosIdMaxTema = $resSqlSelectIdMaxTema->fetchArray();

            $id_tema = $dadosIdMaxTema[0];
        }

        $desc_pergunta = $_GET['pergunta'];

        $correta_alternativa = $_GET['correta_alternativa'];
        $errada_alternativa1 = $_GET['errada_alternativa1'];
        $errada_alternativa2 = $_GET['errada_alternativa2'];
        $errada_alternativa3 = $_GET['errada_alternativa3'];

        $sqlAlternativa = "INSERT INTO alternativa (correta_alternativa, errada_alternativa1, errada_alternativa2, errada_alternativa3" .
               ") VALUES ('$correta_alternativa', '$errada_alternativa1', '$errada_alternativa2', '$errada_alternativa3')";
        $resSqlPergunta = $db->query($sqlAlternativa);

        $sqlSelectIdMaxAlter = "SELECT MAX(id_alternativa) FROM alternativa";
        $resSqlSelectIdMaxAlter = $db->query($sqlSelectIdMaxAlter);
        $dadosIdMaxAlter = $resSqlSelectIdMaxAlter->fetchArray();

        $sqlPergunta = "INSERT INTO pergunta (desc_pergunta, id_tema_pergunta,id_alternativa_pergunta" .
               ") VALUES ('$desc_pergunta', $id_tema, $dadosIdMaxAlter[0])";
        $resSqlPergunta = $db->query($sqlPergunta);
    
        $res = "Pergunta incluida!";

        $db->close();
        

    }

    if(isset($res)){
        $msg = "<p style='background: rgb(152,251,152); color: rgb(0,100,0);'>
            $res
        </p>";
    }
?>

    <main class="main">

        <?php
            if(isset($msg) and $msg != ""){
                echo '<div class="msg">';
                    echo $msg;
                echo '</div>';
            } 
        ?>

        <section class="add-question">

            <div class="container">

                <form class="formAdd" method="GET" action="inserirPergunta.php">

                    <legend>Adicionar Questão</legend>

                    <label class="fa__labels" for="tema">Tema:</label>

                    <?php
                        if(isset($_GET['tema_add'])){
                            $desc_tema = $_GET['tema_add'];
                            echo "<select id='select-theme' name='tema_add' class='select-theme'>";
                            echo "<option value='$desc_tema'>$desc_tema</option>";
                            echo "</select>";
                        }
                        else
                        {
                            echo "<select id='select-theme' name='tema' class='select-theme' required>";
                       
                                echo "<option value='' selected disabled>Selecione um tema</option>";
                    
                                    include "connection.php";
                                    $sqlTema = "SELECT id_tema, desc_tema FROM tema";
                                    $resSqlTema = $db->query($sqlTema);
                                    while($dadosTema = $resSqlTema->fetchArray()){
                                        echo "<option value='$dadosTema[0]'>$dadosTema[1]</option>";
                                    }
                                    $db->close();
                            echo "</select>";
                        }
                        
                    ?>

                    <label class="fa__labels" for="fa__question">Questão:</label>
                    <input id="fa__question" class="input__QuestaoSelecionada" name="pergunta" type="text" data-faQuestion required>
                    
                    <label class="fa__labels" for="fa__answer">Alternativa Correta:</label>
                    <input id="fa__answer" class="input__QuestaoSelecionada" name="correta_alternativa" type="text" data-faAnswer required>

                    <label class="fa__labels" for="fa__alt1">Alternativa Incorreta 1:</label>
                    <input id="fa__alt1" class="input__QuestaoSelecionada" name="errada_alternativa1" type="text" data-faAlt1 required>

                    <label class="fa__labels" for="fa__alt2">Alternativa Incorreta 2:</label>
                    <input id="fa__alt2" class="input__QuestaoSelecionada" name="errada_alternativa2" type="text" data-faAlt2 required>

                    <label class="fa__labels" for="fa__alt3">Alternativa Incorreta 3:</label>
                    <input id="fa__alt3" class="input__QuestaoSelecionada" name="errada_alternativa3" type="text" data-faAlt3 required>

                    <div class="fa__container">
                        <input id="fa__button--add" type="submit" class="fa__button" value="Incluir" name="inserir_pergunta" data-buttonAdd>
                        <input id="fa__button--close" type="button" class="fa__button back-button" value="Voltar" onclick="window.location.href='index.php'">
                    </div>

                </form>

            </div>

        </section>

    </main>
        
<?php
    include_once("templates/footer.php");   
?>