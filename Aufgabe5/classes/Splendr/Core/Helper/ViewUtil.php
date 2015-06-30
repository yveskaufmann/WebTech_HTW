<?php
/**
 * Created by PhpStorm.
 * User: fxdapokalypse
 * Date: 04.06.15
 * Time: 23:58
 */

namespace Splendr\Core\Helper;

class ViewUtil {

    public static function script($script) {
        $url = URL::getScriptURL($script);
        ?> <script src="<?php echo $url; ?>"></script>
    <?php
    }

    public static function css($script, $alternativeBase = null) {
        if (! is_null($alternativeBase)) {
            $url = URL::combine(URL::getAbsoluteUrl(), array('public_html', $alternativeBase, $script));
        } else {
            $url = URL::getCssURL($script, $alternativeBase);
        }
        ?> <link rel="stylesheet" href="<?php echo $url; ?>">
    <?php
    }

}