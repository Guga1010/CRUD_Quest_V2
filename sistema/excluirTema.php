<?php
    include_once("templates/header.php");
?>

<script type="text/javascript">
        function confirmDelete() {
            return confirm("Tem certeza de que deseja excluir esse tema?");
        }
</script>

<?php
    

    if(isset($_GET['msg'])){
        $msg = "<p style='background: rgb(152,251,152); color: rgb(0,100,0);'> " .
            $_GET['msg'] .
        "</p>";
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

                <form class="formAdd" action="operacoesBD.php" method="GET" onsubmit="return confirmDelete();">

                    <legend>Excluir Tema</legend>

                    <label class="fa__labels" for="tema">Selecionar Tema:</label>

                    <select id="select-theme" name="tema" class="select-theme" required>

                        <option value="" selected disabled>Selecione um tema</option>

                        <?php

                            include "connection.php";

                            $sqlTema = "SELECT id_tema, desc_tema FROM tema";
                            $resSqlTema = $db->query($sqlTema);
                            
                            while($dadosTema = $resSqlTema->fetchArray())
                            {
                                echo "<option value='$dadosTema[0]'>$dadosTema[1]</option>";
                            }

                            $db->close();

                        ?>


                    </select>

                    <div class="fa__container">

                        <button type="submit" name="excluir_tema">Excluir</button>

                        <!-- <input id="fa__button--add" type="submit" class="fa__button" value="Excluir" data-buttonAdd> -->

                        <input id="fa__button--close" type="button" class="fa__button back-button" value="Voltar" onclick="window.location.href='index.php'">
                        
                    </div>

                </form>

            </div>

        </section>

    </main>
        
<?php
    include_once("templates/footer.php");   
?>