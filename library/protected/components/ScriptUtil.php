<?php

/**
 * Description of ScriptUtil
 *
 */
class ScriptUtil {

    public static function registerJQuery() {
        $cs = Yii::app()->getClientScript();
        $cs->registerCoreScript('jquery');
        $jspath = dirname(Yii::app()->getHomeUrl()) . "/js/jquery.json-2.4.min.js";
        $cs->registerScriptFile($jspath);
    }

    public static function registerJQueryUI() {
        $cs = Yii::app()->getClientScript();
        $cs->registerCoreScript('jquery.ui');
        $cs->registerScriptFile($cs->getCoreScriptUrl() . '/jui/js/jquery-ui-i18n.min.js');
        $cs->registerCssFile($cs->getCoreScriptUrl() . '/jui/css/base/jquery-ui.css');
    }

    private static function registerCustomScript($relativePath) {
        $cs = Yii::app()->getClientScript();
        $jspath = dirname(Yii::app()->getHomeUrl()) . $relativePath;
        $cs->registerScriptFile($jspath);
    }
    
    public static function registerRelationsEditor() {
        ScriptUtil::registerCustomScript("/js/relationseditor.js");
    }

}

?>
