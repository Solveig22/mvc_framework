<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= WEBROOT.'assets'.DS.'css'.DS.'bootstrap.css' ?>">
    <link rel="stylesheet" href="<?= WEBROOT.'assets'.DS.'css'.DS.'main.css' ?>">
    <title><?= $this->page_title() ?></title>

    <?= $this->content('head'); ?>

</head>
<body>

    <nav class="navbar navbar-expand-sm navbar-dark bg-dark mb-5">
        <div class="container">
            <a href="<?=HREF.'home/index'?>" class="navbar-brand">PHP MVC</a>
            <button class="navbar-toggler" data-toggle="collapse" data-target="#nav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="nav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a href="<?=HREF .'home/index'?>" class="nav-link">Home</a></li>
                    <li class="nav-item"><a href="<?=HREF .'home/index'?>" class="nav-link">About</a></li>
                    <li class="nav-item"><a href="<?=HREF .'home/index'?>" class="nav-link">Services</a></li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <?php if(empty($_SESSION)): ?>
                    <li class="nav-item"><a href="<?=HREF.'register/login'?>" class="nav-link">Login</a></li>
                    <?php endif; ?>
                    <?php if(!empty($_SESSION)): ?>
                    <li class="nav-item"><a href="<?=HREF.'register/logout'?>" class="nav-link">Logout</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <?= $this->content('body') ?>

    <script src="<?=WEBROOT.DS.'assets'.DS.'js'.'jquery.js'?>"></script>
    <script src="<?=WEBROOT.DS.'assets'.DS.'js'.'bootstrap.js'?>"></script>
    <script src="<?=WEBROOT.DS.'assets'.DS.'js'.'app.js'?>"></script>
</body>
</html>