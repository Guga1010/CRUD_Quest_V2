<?php
    include_once("templates/header.php");
?>


<?php

    $formEmail = "";

    if (isset($_POST['button_register']))
    {

        include "connection.php";

        $msg = "";

        if(isset($_POST['button_register']))
        {

            $formName = $_POST['name_register'];
            $formEmail = $_POST['email_register'];
            $formPassword = $_POST['password_register'];

            if(($db->query("SELECT * FROM usuario WHERE email_usuario = '$formEmail'"))->fetchArray())
            {
                $res = "Uma conta já existe com esse e-mail. Faça login ou cadastre com outro e-mail.";
            }
            else
            {
                if($db->query("INSERT INTO usuario (nome_usuario,email_usuario,senha_usuario) VALUES ('$formName','$formEmail','$formPassword')"))
                {
                    sleep(2);
                    header("Location: ./sistema/");
                }
                else
                {
                    $res = "ERRO: " . $db->lastErrorMsg();
                }
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
              

    <div class="register-container">

        <form class="register-form" method="POST" >

            <h2 class="register-title">Cadastro</h2>

            <input type="text" class="register-input" name="name_register" placeholder="Nome" required>
            <input type="email" class="register-input" name="email_register"  placeholder="Email" required>
            <input type="password" class="register-input" name="password_register" placeholder="Senha" required>

            <button type="submit" class="register-button" name="button_register">Cadastrar</button>

            <p>Já tem uma conta? <a href="login.php">Faça login aqui</a></p>

        </form>

    </div>
    
    
</main>
        
<?php
    include_once("templates/footer.php");   
?>