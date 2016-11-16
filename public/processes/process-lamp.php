<?php
    if($_POST["update"]) {
        touch(__DIR__ . "/../../data/" . "valve" . $_POST["zone"]);
    } else {
        touch(__DIR__ . "/../../data/" . "valve" . $_POST["zone"]);
    }

header("location: ../");