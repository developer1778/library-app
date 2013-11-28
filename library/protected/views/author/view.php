<?php
/* @var $this AuthorController */
/* @var $model Author */

$this->breadcrumbs = array(
    'Authors' => array('index'),
    $model->name,
);

$this->menu = array(
    array('label' => 'List Author', 'url' => array('index')),
    array('label' => 'Create Author', 'url' => array('create')),
    array('label' => 'Update Author', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Delete Author', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Manage Author', 'url' => array('admin')),
);
?>

<h1>View Author #<?php echo $model->id; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'name',
        'create_time',
        array(
            'label' => 'Update Time',
            'type' => 'text',
            'value' => $model->update_time === Constants::NullDate ? '' : $model->update_time
        ),
        array(
            'label' => 'Books',
            'type' => 'text',
            'value' => DBUtil::relationNames($books) 
        )
    ),
));
?>
