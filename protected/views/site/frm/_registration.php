<?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'formReg',
            'action' => array('/site/registration'),
            'enableAjaxValidation'=>true,
            'enableClientValidation'=>true,
            'focus'=>array($model,'username'),
            'htmlOptions' => array('style' => 'margin-bottom: 20px; height: 100px'),
            'clientOptions'=>array(
                'validateOnSubmit'=>true,
            ),
)); ?>

        <h4><?= Yii::t('Site', 'Insert youre email'); ?></h4>
        <span id="error_reg_email" class="error"><?php echo $form->error($model,'email', array(), true, true); ?></span>
        <div class="inp"><?php echo $form->textField($model,'email'); ?></div>

        <div class="agree"><label><?php echo $form->checkBox($model,'agree'); ?> Я согласен с правилами</label></div>
        <span id="error_reg_rules" class="error"><?php echo $form->error($model,'agree', array(), true, true); ?></span>
        <div class="rules"><a href="$vars[href_rules]"><?= Yii::t('Site', 'Terms of Use'); ?></a></div>

        <input type="image" src="/images/reg_btn.gif" />


<?php $this->endWidget(); ?>