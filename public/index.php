<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Automated Watering</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>body { padding-top: 70px; }</style>
</head>

<body>
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="/index.php">Automate d'arrosage</a>
            </div>
        </div>
    </nav>

    <?php
        if (file_exists("../data/ini.txt")) {
            $ini = parse_ini_file( "../data/ini.txt", true);
            for( $i = 1; $i <= $ini["settings"]["zones_number"]; $i++ ) { ?>
                <div class="container">
                    <div class="panel panel-default">
                        <div class="panel-heading">Zone <?php echo($i); ?></div>
                        <div class="panel-body">
                            <?php if(!$ini["valves"]["valve_".$i]) {?>
                            <form method="POST" class="form-inline">
                                <div class="form-group">
                                    <label for="arrosage<?php echo($i); ?>">Arrosage</label>
                                    <input type="text" class="form-control" id="arrosage<?php echo($i); ?>">
                                </div>
                                <button type="submit" class="btn btn-success">
                                    Allumer
                                </button>
                            </form>
                            <?php } else {?>
                                <form method="POST" class="form-inline">
                                    <div class="form-group">
                                        <label for="arrosage<?php echo($i); ?>">Arrosage</label>
                                        <input type="hidden" class="form-control" id="arrosage<?php echo($i); ?>">
                                    </div>
                                    En train d'arroser
                                </form>
                            <?php }?>
                            <form method="POST" class="form-inline">
                                <div class="form-group">
                                    <label for="lampe<?php echo($i); ?>">Éclairage</label>
                                    <input type="hidden" class="form-control" id="lampe<?php echo($i); ?>">
                                </div>
                                <button type="submit" class="btn <?php echo($ini["lighting"]["lamp_".$i] ? "btn-danger" : "btn-success"); ?>">
                                    <?php echo($ini["lighting"]["lamp_".$i] ? "Éteindre" : "Allumer"); ?>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
    <?php }}; ?>
</body>
</html>

