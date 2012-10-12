<div id="<?= $model->name ?>_<?= $model->id ?>">
    <?php echo CHtml::link(
                Yii::t('Site', 'Delete'), 
                array('user/deletenew', 'entity' => $model->name, 'id' => $model->id), 
                array('style'=>'float: right;', 'class' => 'ajaxNewDelete')
            ); ?>
    <div class="clear"></div>
    <?php echo $model->params['param1']; ?>
    <?php echo $model->params['param2']; ?>
</div>