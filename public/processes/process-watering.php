<?php
    session_start();

    if(ctype_digit($_POST["update"]) && $_POST["update"] > 0 && $_POST["update"] < 100) {
        $_SESSION['err'] = false;
        file_put_contents(__DIR__ . "/../../data/" . "valve" . $_POST["zone"] . ".txt", $_POST["update"]);
    } else {
        $_SESSION['err'] = true;
    }

    header("location: ../");