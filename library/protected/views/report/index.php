<?php
/* @var $this ReportController */

$this->breadcrumbs = array(
    'Report',
);
?>
<h1>Report List</h1>

<ul>
    <li>
        <?php echo CHtml::link(Reports::REPORT_booksHaving2Authors, array('booksHaving2Authors')); ?> 
    </li>
    <li>
        <?php echo CHtml::link(Reports::REPORT_authorsReadBy3Readers, array('authorsReadBy3Readers')); ?> 
    </li>    
    <li>
        <?php echo CHtml::link(Reports::REPORT_randomBooks, array('randomBooks')); ?> 
    </li>
</ul>

