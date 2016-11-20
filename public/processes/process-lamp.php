<?php
session_start();

if($_POST['update']) {
    touch(__DIR__ . '/../../data/lamp' . $_POST['zone'] . '_off.txt');
} else {
    touch(__DIR__ . '/../../data/lamp' . $_POST['zone'] . '_on.txt');
}

header('Location: /index.php');