<?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'generalForm',
            'enableAjaxValidation'=>false,
            'enableClientValidation'=>true,
            'focus'=>array($model,'username'),
            'clientOptions'=>array(
                'validateOnSubmit'=>true,
            ),
)); ?>

        <table width="100%">
            <tr>
                <td>
                    <h4><?= $model->getAttributeLabel('password') ?>:<span id="error_pswd"><?php echo $form->error($model,'password', array(), true, true); ?></span></h4>
                    <div class="inp"><?php $model->password = ''; echo $form->passwordField($model,'password'); ?></div>
                </td>
                <td>
                    <h4><?= $model->getAttributeLabel('repassword') ?>:<span id="error_pswd"><?php echo $form->error($model,'repassword', array(), true, true); ?></span></h4>
                    <div class="inp"><?php echo $form->passwordField($model,'repassword'); ?></div>
                </td>
            </tr>
        </table>
        <div class="submit">
                <table width=100%><tr>
                        <td><input type="image" src="/images/login_btn.gif" /></td>
                </table>
        </div>		

<?php $this->endWidget(); ?>