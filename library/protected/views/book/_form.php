<?php
/* @var $this BookController */
/* @var $model Book */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'book-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

        <div id="relationsAuthors"></div>
        
        <div id="relationsReaders"></div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script type="text/javascript">
$(function() {
    $('#relationsAuthors').relationsEditor({
        autocompleteUrl: '<?php echo CHtml::normalizeUrl(array('author/find')); ?>',
        headerText: 'Authors',
        hiddenFieldName: 'relationsAuthors',
        data: <?php echo CJavaScript::jsonEncode($authors); ?>
    });
    $('#relationsReaders').relationsEditor({
        autocompleteUrl: '<?php echo CHtml::normalizeUrl(array('reader/find')); ?>',
        headerText: 'Readers',
        hiddenFieldName: 'relationsReaders',
        data: <?php echo CJavaScript::jsonEncode($readers); ?>
    });
});
</script>