<div class="main" id="central_block">
    <?php if(!$news || !count($news->entities)): ?>
        <?= Yii::t('User', 'Wall is empty.'); ?>
    <?php else: ?>
        <?php foreach($news->entities as $model): ?>
            <?php 
                try {
                    $this->render('news/_'.$model->template, array('model' => $model));
                } catch (Exception $exc) {
                    d($exc->getCode());
//                    echo $exc->getTraceAsString();
                }
            ?>
        <?php endforeach; ?>
    <?php endif; ?>
    
</div>

<?php 
    $cs = Yii::app()->getClientScript();  
    $cs->registerScript(
        'ajaxFilterNews',
        'jQuery(function($){$(\'body\').on(\'click\',\'.ajaxNewDelete\',function(){var link = this;  $.post(this).success(function() {$(link).parent().remove(); });   return false;}); });',
      CClientScript::POS_END
    );
?>