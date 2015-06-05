<?php
    use Poller\Core\Helper\ViewUtil;
    use Poller\Core\Helper\URL;
?>
<!doctype html>
<html class="no-js">
<head>
    <meta charset="utf-8">
    <title><?= $this->getData('title'); ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">
    <link rel="shortcut icon" href="<?= URL::getPublicURL('favicon.ico'); ?>">
    <?php
        ViewUtil::css('bootstrap.css', 'scripts/vendor/bootstrap/dist/css');
        ViewUtil::css('main.css');
    ?>
</head>
<body>
<!--[if lt IE 10]>
<p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

    <div class="container">
       <header></header>
