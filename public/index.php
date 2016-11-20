<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="author" content="Thomas ARNAUD, Bruno BUIRET, Alexis RABILLOUD" />
        <title>Automated Watering</title>
        <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css" media="screen" />
        <style type="text/css">
            body {
                padding-top: 70px;
            }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="/index.php">Automate d'arrosage</a>
                </div>
            </div>
        </nav>
        <div class="container">
            <?php if (file_exists(__DIR__ . '/../data/automaton.ini')):
                $ini = parse_ini_file(__DIR__ . '/../data/automaton.ini', true);
                for( $i = 1; $i <= $ini['settings']['zones_number']; $i++ ): ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Zone <?php echo($i); ?>
                        </div>
                        <div class="panel-body">
                            <?php if(!$ini['valves']['valve_'.$i]): ?>
                                <form method="post" class="form-inline" action="/processes/process-watering.php">
                                    <input type="hidden" name ="zone" value="<?php echo($i); ?>" />
                                    <div class="form-group <?php if(isset($_SESSION['err' . $i]) && $_SESSION['err' . $i]) echo('has-error'); ?>">
                                        <label for="<?php echo($i); ?>">Arrosage</label>
                                        <div class="input-group">
                                            <?php if(!$ini['pump']['pump']): ?>
                                                <input type="text" name="update" class="form-control" id="<?php echo($i); ?>" />
                                                <span class="input-group-btn">
                                                <button type="submit" class="btn btn-success">
                                                    Allumer
                                                </button>
                                            </span>
                                            <?php else: ?>
                                                <input type="text" name="update" class="form-control" id="<?php echo($i); ?>" disabled="disabled" />
                                                <span class="input-group-btn">
                                                <button type="submit" class="btn btn-success" disabled="disabled">
                                                    Allumer
                                                </button>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                        <?php if(isset($_SESSION['err' . $i]) && $_SESSION['err' . $i]): ?>
                                            <span class="help-block">La quantité d'eau pour l'arrosage doit être entière et inférieure à la capacité de la cuve.</span>
                                        <?php endif; ?>
                                    </div>
                                </form>
                            <?php else: ?>
                                <p>Arrosage en cours</p>
                            <?php endif; ?>
                            <form method="post" class="form-inline" action="/processes/process-lamp.php">
                                <input type="hidden" name ="zone" value="<?php echo($i); ?>" />
                                <div class="form-group">
                                    <label for="lampe<?php echo($i); ?>">Éclairage</label>
                                    <button name ="update" type="submit" class="btn <?php echo($ini['lighting']['lamp_'.$i] ? 'btn-danger' : 'btn-success'); ?>" value="<?php echo($ini['lighting']['lamp_'.$i]); ?>">
                                        <?php echo($ini['lighting']['lamp_'.$i] ? 'Éteindre' : 'Allumer'); ?>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php endfor; ?>
            <?php else: ?>
                <p>L'automate n'a encore été configuré.</p>
            <?php endif; ?>
        </div>

        <script type="text/javascript" src="/js/jquery.min.js"></script>
        <script type="text/javascript" src="/js/bootstrap.min.js"></script>
    </body>
</html>
<?php
// Erase errors after they have been displayed.
$_SESSION = array();