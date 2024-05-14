<?php
    include_once("templates/header.php");
?>

<?php
    if(isset($_GET['desc_tema'])){

        include "connection.php";

        $desc_tema = $_GET['desc_tema'];

        $sqlTema = "INSERT INTO tema (desc_tema) VALUES ('$desc_tema')";
        $db->query($sqlTema);

    }
?>

    <main class="main">
        <section class="add-question">
            <div class="container">
                <form class="formAdd" action="">
                    <legend>Adicionar Tema</legend>

                    <label class="fa__labels" for="fa__question">Tema:</label>
                    <input id="fa__question" name="desc_tema" type="text" data-faQuestion required>

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