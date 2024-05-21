<?php
    include_once("templates/header.php");
?>

<?php

    $formEmail = "";

    if (isset($_POST['button_log']))
    {

        include "connection.php";

        $msg = "";

        if(isset($_POST['button_log']))
        {

            $formEmail = $_POST['email_log'];
            $formPassword = $_POST['password_log'];

            if(($db->query("SELECT * FROM usuario WHERE email_usuario = '$formEmail' AND senha_usuario = '$formPassword'"))->fetchArray())
            {
                sleep(2);
                header("Location: ./sistema/");
            }
            else
            {
                $res = "Verifique  seu e-mail e senha ou crie uma conta.";
            }
        }

        if(isset($res)){
            $msg = "<p style='background: rgb(255,200,100); color: rgb(255,69,0);'>
                $res
            </p>";
        }

        $db->close();
    }
?>

<main>

    <?php
        if(isset($msg) and $msg != ""){
            echo '<div class="msg">';
                echo $msg;
            echo '</div>';
        } 
    ?>

    <div class="login-container">

        <form class="login-form" method="post">

            <h2 class="login-title">Login</h2>

            <input type="email" class="login-input" name="email_log" placeholder="Email" required>
            <input type="password" class="login-input" name="password_log" placeholder="Senha" required>

            <button type="submit" name="button_log" class="login-button">Entrar</button>

            <p>Não tem uma conta? <a href="cadastro.php">Cadastre-se aqui</a></p>
        </form>

    </div>
    
    
</main>
        
<?php
    include_once("templates/footer.php");   
?>