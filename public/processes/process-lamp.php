<?php
    if($_POST["update"]) {
        touch(__DIR__ . "/../../data/lamp" . $_POST["zone"] . "_off.txt");
    } else {
        touch(__DIR__ . "/../../data/lamp" . $_POST["zone"] . "_off.txt");
    }

header("location: ../");