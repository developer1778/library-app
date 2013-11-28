<?php

/**
 * Description of EntityController
 *
 */
class EntityController extends Controller {
    
    protected function registerRelationsEditor() {
        ScriptUtil::registerJQuery();
        ScriptUtil::registerJQueryUI();
        ScriptUtil::registerRelationsEditor();
    }
    
    protected function doActionFind() {
        $term = $_REQUEST["term"];
        
        $table = '{{'.$this->id.'}}';
        
        $result = array();
        if (strlen($term) >= 2) {

            $cmd = Yii::app()->db->createCommand("select id, name from ". $table .
                    " where name like :pattern ");
            $pattern = "%$term%";
            $cmd->bindParam(":pattern", $pattern);
            $rows = $cmd->queryAll();

            foreach ($rows as $row) {
                array_push($result, array("value" => $row["id"], "label" => $row["name"]));
            }
        }

        echo CJavaScript::jsonEncode($result);
        Yii::app()->end();
    }
    
}

?>
