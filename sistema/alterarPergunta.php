<?php
    include_once("templates/header.php");
?>

    <main class="main">
        <section class="update-question">
            <div class="container" id="section__Alterar">
                <form class="formUpdate" action="perguntaSelecionada.php?teste=1" method="GET">
                    <legend>Atualizar Questão/Alternativas</legend>

                    <label class="fa__labels" for="select-theme">Tema:</label>
                    <?php
                        $tema = 0;
                        $pergunta = 0;
                        if(isset($_GET['tema']) and $_GET['tema'] != 0){
                            $tema = $_GET['tema'];
                        }
                        if(isset($_GET['pergunta']) and $_GET['pergunta'] != 0){
                            $pergunta = $_GET['pergunta'];  
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

                        echo "<option value='alterarPergunta.php'>Selecione um tema...</option>";

                            $sqlTema = "SELECT id_tema, desc_tema FROM tema WHERE id_tema != $tema";
                            $resSqlTema = $db->query($sqlTema);
                            while($dadosTema = $resSqlTema->fetchArray()){
                                $link = "alterarPergunta.php?tema=$dadosTema[0]";
                                echo "<option value='$link'>$dadosTema[1]</option>";
                            }
                            $db->close();
                            
                        echo "</select>";
                    ?>
                    

                    <label class="fa__labels" for="select-question">Questão:</label>
                    <?php
                        if(isset($_GET['tema']) and $_GET['tema'] != 0)
                        {
                            echo ' <select name="pergunta">';
                            
                            include "connection.php";

                            $id_tema = $_GET['tema'];

                            echo "<option value=''>Selecione uma pergunta...</option>";

                            $sqlPergunta = "SELECT id_pergunta, desc_pergunta FROM pergunta WHERE id_tema_pergunta = $id_tema";
                            $resSqlPergunta= $db->query($sqlPergunta);

                            while($dadosPergunta = $resSqlPergunta->fetchArray()){
                                echo "<option value='$dadosPergunta[0]'>$dadosPergunta[1]</option>";
                            }
                            $db->close();
                        }   
                        else
                        {
                            echo '<select name="pergunta" disabled>';
                            echo "<option value=''>Selecione um tema...</option>";
                        } 

                        echo "</select>";
                    ?>

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