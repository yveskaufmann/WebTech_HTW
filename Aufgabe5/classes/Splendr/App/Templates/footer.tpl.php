<?php
    use Splendr\Core\Helper\ViewUtil;
    use Splendr\Core\Helper\URL;
?>
    </div>
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h2 class="section-heading"><span class="glyphicon glyphicon-heart"></span> from the Splendr team!</h2>
                </div>
                <div class="col-lg-4 col-lg-offset-2 text-center">
                    <p> <a href="<?= URL::getControllerURL('Index', 'contact') ?>">Contact</a></p>
                </div>
                <div class="col-lg-4 text-center">
                    <p><a href="<?= URL::getControllerURL('Index', 'imprint') ?>">Imprint</a></p>
                </div>
            </div>
        </div>
    </footer>

    <?php
        ViewUtil::script('vendor/jquery/dist/jquery.js');
        ViewUtil::script('vendor/bootstrap/dist/js/bootstrap.js');
        ViewUtil::script('main.js');
    ?>
</body>
</html>