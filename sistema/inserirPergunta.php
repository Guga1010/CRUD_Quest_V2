<?php
    include_once("templates/header.php");
?>

<?php
    if(isset($_GET['desc_pergunta'])){
        include "connection.php";

        $id_tema = $_GET['selecionar_tema'];

        $desc_pergunta = $_GET['desc_pergunta'];

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

    }
?>

    <main class="main">
        <section class="add-question">
            <div class="container">
                <form class="formAdd" action="">
                    <legend>Adicionar Questão</legend>

                    <label class="fa__labels" for="select-theme">Selecionar Tema:</label>

                    <select id="select-theme" name="selecionar_tema" class="select-theme" required>
                       
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

                    <label class="fa__labels" for="fa__question">Questão:</label>
                    <input id="fa__question" name="desc_pergunta" type="text" data-faQuestion required>

                    <label class="fa__labels" for="fa__answer">Alternativa Correta:</label>
                    <input id="fa__answer" name="correta_alternativa" type="text" data-faAnswer required>

                    <label class="fa__labels" for="fa__alt1">Alternativa Incorreta 1:</label>
                    <input id="fa__alt1" name="errada_alternativa1" type="text" data-faAlt1 required>

                    <label class="fa__labels" for="fa__alt2">Alternativa Incorreta 2:</label>
                    <input id="fa__alt2" name="errada_alternativa2" type="text" data-faAlt2 required>

                    <label class="fa__labels" for="fa__alt3">Alternativa Incorreta 3:</label>
                    <input id="fa__alt3" name="errada_alternativa3" type="text" data-faAlt3 required>

                    <div class="fa__container">
                        <input id="fa__button--add" type="submit" class="fa__button" value="Incluir" data-buttonAdd>
                        <input id="fa__button--close" type="button" class="fa__button back-button" value="Voltar" onclick="window.location.href='index.php'">
                    </div>
                </form>
            </div>
        </section>
    </main>
        
<?php
    include_once("templates/footer.php");   
?>