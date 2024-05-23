<?php
    include_once("templates/header.php");
?>

<?php

    if(isset($_GET['submit_excluir'])){

        $msg = "";

        include "connection.php";

        $id_pergunta = $_GET['pergunta'];

        $sqlIdAlternativa = "SELECT id_alternativa_pergunta FROM pergunta WHERE id_pergunta = $id_pergunta";
        $resSqlIdAlternativa = $db->query($sqlIdAlternativa);
        $dadosAlternativa = $resSqlIdAlternativa->fetchArray();

        $sqlExcluiAlternativa = "DELETE FROM alternativa WHERE id_alternativa = $dadosAlternativa[0]";
        $db->query($sqlExcluiAlternativa);

        $sqlExcluiPergunta = "DELETE FROM pergunta WHERE id_pergunta = $id_pergunta";
        $db->query($sqlExcluiPergunta);

        $res = "Pergunta excluida!";

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

        <section class="delete-question">
            <div class="container">
                <form class="formDelete" method="GET">

                    <legend>Excluir Pergunta</legend>

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
                        <input id="fa__button--delete" type="submit" name="submit_excluir" class="fa__button" value="Deletar" data-buttonDelete>
                        <a href="index.php" class="back-button">Voltar</a>
                    </div>
                </form>
            </div>
        </section>
    </main>
        
<?php
    include_once("templates/footer.php");   
?>