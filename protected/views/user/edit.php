<div class="darker png_scale" style="display: none;"></div>

<?php $this->widget('UserMain', array('model' => $model)); ?>

<div style="float: left;">
    
    <?php
        $this->widget('zii.widgets.jui.CJuiTabs', array(
            'tabs' =>
                    array(
                        Yii::t('Site', 'General') => $this->renderPartial('edit/general', array('model'=>$model),true),
                        Yii::t('Site', 'Profile') => $this->renderPartial('edit/profile', array('model'=>$model),true),
                    ),
            'options' => array(
               'collapsible' => true,
            ),
        ));
    ?>
</div>
<div class="clear"></div>
<div class="footer">
    <div class="copy">&copy; 2006&mdash;2012 Migom.by&nbsp;<strong>Минск</strong>, <strong>Беларусь</strong>&nbsp;&nbsp;</div>
</div>