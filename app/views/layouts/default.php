<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= WEBROOT.'assets'.DS.'css'.DS.'main.css' ?>">
    <link rel="stylesheet" href="<?= WEBROOT.'assets'.DS.'css'.DS.'bootstrap.css' ?>">
    <title><?= $this->page_title() ?></title>

    <?= $this->content('head'); ?>

</head>
<body>
    <?= $this->content('body') ?>
</body>
</html>