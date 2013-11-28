<?php

/**
 * Description of DBUtil
 *
 */
class DBUtil {

    const DIRECT = 1;
    const REVERSE = 2;

    public static function saveRelations($entity1, $entity2, $ids1, $ids2, $order = DBUtil::DIRECT) {
        if ($order === DBUtil::DIRECT) {
            $table = '{{' . $entity1 . '_' . $entity2 . '_xref}}';
        } else {
            $table = '{{' . $entity2 . '_' . $entity1 . '_xref}}';
        }

        $connection = Yii::app()->db;
        foreach ($ids1 as $id1) {
            $connection->createCommand('delete from ' . $table . ' where ' . $entity1 . '_id = :id')->execute(array(
                ':id' => $id1
            ));
            if ($ids2) {
                foreach ($ids2 as $id2) {
                    if (!$id2)
                        continue;
                    $cmd = $connection->createCommand('insert into ' . $table . ' (' . $entity1 . '_id, ' . $entity2 . '_id) values (:id1, :id2)');
                    $cmd->bindValue(':id1', $id1);
                    $cmd->bindValue(':id2', $id2);
                    $cmd->execute();
                }
            }
        }
    }

    public static function loadRelations($entity1, $entity2, $id, $order = DBUtil::DIRECT) {
        if ($order === DBUtil::DIRECT) {
            $table = '{{' . $entity1 . '_' . $entity2 . '_xref}}';
        } else {
            $table = '{{' . $entity2 . '_' . $entity1 . '_xref}}';
        }
        $connection = Yii::app()->db;
        return $connection->createCommand('select e2.id, e2.name from tbl_' . $entity2 . ' e2 ' .
                        ' inner join ' . $table . ' xref on e2.id = xref.' . $entity2 . '_id ' .
                        ' where xref.' . $entity1 . '_id = :id')->queryAll(true, array(
                    ':id' => $id
                ));
    }

    public static function relationNames($relations) {
        $s = '';
        $i = 0;
        $length = count($relations);
        foreach ($relations as $relation) {
            $s .= ' ' . $relation['name'];
            if ($i < $length - 1) {
                $s .= ',';
            }
            $i++;
        }
        return $s;
    }

}

?>
