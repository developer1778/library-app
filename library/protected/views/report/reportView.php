<?php
/* @var $this ReportController 
 */

$this->breadcrumbs = array(
    'Report' => array('/report'),
    $reportName,
);
?>
<h1><?php echo $reportName; ?></h1>

<p>
    Total items: <?php echo count($reportData); ?>
</p>

<ul>
<?php foreach ($reportData as $item) { ?>
    <li>
        <?php echo CHtml::link($item['name'], array($linkControllerName.'/view', 'id' => $item['id'])); ?>
    </li>
<?php } ?>    
</ul>
    

	
