<?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'profileForm',
            'enableAjaxValidation'=>true,
            'enableClientValidation'=>true,
            'focus'=>array($model,'username'),
            'htmlOptions' => array(
                'enctype'=>'multipart/form-data'
            ),
            'clientOptions'=>array(
                'validateOnSubmit'=>true,
            ),
)); ?>

<div class="row">
    <?php echo $form->label($model->profile,'full_name', array(), true, true); ?>
    <?php echo $form->textField($model->profile,'full_name', array(), true, true); ?>
    <?php echo $form->error($model->profile,'full_name', array(), true, true); ?>
</div>

<div class="row">
    <?php echo $form->label($model->profile,'avatar', array(), true, true); ?>
    <?php echo $form->fileField($model->profile,'avatar', array(), true, true); ?>
    <?php if($model->profile->avatar): ?>
        <?php echo CHtml::image($model->profile->avatar); ?>
    <?php endif; ?>
    <?php echo $form->error($model->profile,'avatar', array(), true, true); ?>
</div>

<div class="row">
    <?php echo $form->label($model->profile,'city_id', array(), true, true); ?>
    <?php echo $form->textField($model->profile,'city_id', array(), true, true); ?>
    <?php echo $form->error($model->profile,'city_id', array(), true, true); ?>
</div>

<div class="row">
    <?php echo $form->label($model->profile,'sex', array(), true, true); ?>
    <?php echo $form->textField($model->profile,'sex', array(), true, true); ?>
    <?php echo $form->error($model->profile,'sex', array(), true, true); ?>
</div>

<div class="row">
    <?php echo $form->label($model->profile,'birthday', array(), true, true); ?>
    <?php echo $form->textField($model->profile,'birthday', array(), true, true); ?>
    <?php echo $form->error($model->profile,'birthday', array(), true, true); ?>
</div>

        <div class="submit">
                <table width=100%><tr>
                        <td><input type="image" src="/images/login_btn.gif" /></td>
                </table>
        </div>		

<?php $this->endWidget(); ?>