<?php
/* @var $this BookController */
/* @var $model Book */

$this->breadcrumbs = array(
    'Books' => array('index'),
    $model->name,
);

$this->menu = array(
    array('label' => 'List Book', 'url' => array('index')),
    array('label' => 'Create Book', 'url' => array('create')),
    array('label' => 'Update Book', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Delete Book', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Manage Book', 'url' => array('admin')),
);
?>

<h1>View Book #<?php echo $model->id; ?></h1>

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
            'label' => 'Authors',
            'type' => 'text',
            'value' => DBUtil::relationNames($authors) 
        ),
        
        array(
            'label' => 'Readers',
            'type' => 'text',
            'value' => DBUtil::relationNames($readers) 
        )
        
    ),
));
?>
