<?php
    use Splendr\Core\Helper\Notification;
    use Splendr\Core\Helper\ViewUtil;
    use Splendr\Core\Helper\URL;
    use Splendr\Core\Helper\Login;
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

    <?php if ($this->getData('navIsEnabled', true)) { ?>
    <!--/* From http://bootsnipp.com/snippets/featured/fancy-navbar-login-sign-in-form */ -->
    <nav class="navbar navbar-inverse" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?= URL::getAbsoluteUrl() ?>">Splendr</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>Product</b> <span class="caret"></span></a>
                        <ul id="product-dp" class="dropdown-menu">
                        <li><a href="<?= URL::getControllerURL('product', 'index') ?>">Show all</a></li>
                        <li><a href="<?= URL::getControllerURL('product', 'add') ?>">Add</a></li>
                        </ul>
                    </li>
                    <? if (Login::isCurrentUserLoggedIn()): ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>ProductBoards</b> <span class="caret"></span></a>
                        <ul id="board-dp" class="dropdown-menu">
                            <li><a href="<?= URL::getControllerURL('board', 'index') ?>">Show all</a></li>
                            <li><a href="<?= URL::getControllerURL('board', 'add') ?>">Add</a></li>
                        </ul>
                    </li>
                    <? endif; ?>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>Search</b> <span class="caret"></span></a>
                        <ul id="search-dp" class="dropdown-menu">
                            <li>
                                <div class="row">
                                    <div class="col-md-12">
                                        <form id="search_form" class="form form-inline" action="<?= URL::getControllerURL('product', 'search', '${query}') ?>" method="GET" role="search accept-charset="UTF-8">
                                            <div class="form-group">
                                                <input name="query" type="text" class="form-control" placeholder="Product name or url">
                                                <button type="submit" class="btn btn-primary" title="search product" ><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>


                <ul class="nav navbar-nav navbar-right">
                    <? if (!Login::isCurrentUserLoggedIn()): ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>Login</b> <span class="caret"></span></a>
                        <ul id="login-dp" class="dropdown-menu">
                            <li>
                                <div class="row">
                                    <div class="col-md-12">
                                        Login via
                                        <div class="social-buttons">
                                            <a href="#" class="btn btn-fb"><i class="fa fa-facebook"></i> Facebook</a>
                                            <a href="#" class="btn btn-tw"><i class="fa fa-twitter"></i> Twitter</a>
                                        </div>
                                        or
                                        <form class="form" role="form" method="post" action="<?= URL::getControllerURL('login','login') ?>" accept-charset="UTF-8" id="login-nav">
                                            <div class="form-group">
                                                <label class="sr-only" for="exampleInputEmail2">Email address</label>
                                                <input  type="email" name="email" class="form-control" id="exampleInputEmail2" placeholder="Email address" required>
                                            </div>
                                            <div class="form-group">
                                                <label class="sr-only" for="exampleInputPassword2">Password</label>
                                                <input type="password" name="password" class="form-control" id="exampleInputPassword2" placeholder="Password" required>
                                                <div class="help-block text-right"><a href="">Forget the password ?</a></div>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary btn-block">Sign in</button>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox"> keep me logged-in
                                                </label>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="bottom text-center">
                                        New here ? <a href="<?= URL::getControllerURL('login', 'register') ?>"><b>Join Us</b></a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <? else:?>
                    <li>
                        <a href="#">
                            <span class="glyphicon glyphicon-user">
                                <?= Login::geCurrentLoggedUser()->__toString() ?>
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= URL::getControllerURL('login', 'logout') ?>">Logout</a>
                    </li>
                    <?endif;?>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
    <?php } ?>
    <div class="container">
        <?php Notification::show(); ?>
