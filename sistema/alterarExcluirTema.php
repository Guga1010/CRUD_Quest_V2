<?php
    include_once("templates/header.php");
?>

<?php
    if(isset($_GET['selecionar_tema'])){

        include "connection.php";

        $id_tema = $_GET['selecionar_tema'];

        $sqlTema = "DELETE FROM tema WHERE id_tema = $id_tema";
        $db->query($sqlTema);

    }
?>

    <main class="main">
        <section class="add-question">
            <div class="container">
                <form class="formAdd" action="">
                    <legend>Alterar/Excluir Tema</legend>

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

                    <div class="fa__container">

                        <input id="fa__button--add" type="submit" class="fa__button" value="Excluir" data-buttonAdd>

                        <input id="fa__button--close" type="button" class="fa__button back-button" value="Voltar" onclick="window.location.href='index.php'">
                    </div>

                </form>
            </div>
        </section>
    </main>
        
<?php
    include_once("templates/footer.php");   
?>