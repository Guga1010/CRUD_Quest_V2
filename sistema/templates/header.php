<?php
    include_once("../helpers/url.php");
?>

<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>CRUD - Quest</title>

        <link rel="stylesheet" href="<?= $BASE_URL ?>/css/style.css">

    </head>

    <body> 

    <header class="header">
        <nav class="nav">
            <ul class="list">
                <li class="li__items"><h1 class="title">Quest?</h1></li>
                <li class="li__items"><h1 class="title"><a href="../index.php" onclick="return confirm('Você tem certeza que quer sair?');" id="link__Sair">Sair</a></h1></li>
            </ul>
        </nav>
    </header>
            