<?php
    include_once("templates/header.php");
?>

<?php
    if(isset($_GET['desc_tema'])){

        $msg = "";

        include "connection.php";

        $desc_tema = $_GET['desc_tema'];

        $sqlTema = "INSERT INTO tema (desc_tema) VALUES ('$desc_tema')";
        $db->query($sqlTema);

        $res = "Tema incluido!";

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
                <form class="formAdd" action="">
                    <legend>Adicionar Tema</legend>

                    <label class="fa__labels" for="fa__question">Tema:</label>
                    <input id="fa__question" class="input__QuestaoSelecionada" name="desc_tema" type="text" data-faQuestion required>

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