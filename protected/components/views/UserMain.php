<div class="main" style="float: left;">
    <div class="header">
        <table><tr>
                <td>
                    <?php if ($model->profile->avatar): ?>
                        <?php echo CHtml::link(
                                    CHtml::image($model->profile->avatar, $model->login, array('style' => 'width:50px; height:50px; border: 1px solid black', 'class' => 'avatar', 'border' => 0)),
                                    array('/user/index', 'id' => $model->id)
                                ); ?>
                    <?php else: ?>
                        <?php echo CHtml::image('/images/users/default_avatar.png', 'default avatar', array('style' => 'width:50px; height:50px; border: 1px solid black', 'class' => 'avatar', 'border' => 0)); ?>
                    <?php endif; ?>
                </td>
                <td style="border-bottom: 2px solid black">
                    <h1 style="margin: 3px;"><?php echo $model->login . ' (' . $model->profile->full_name . ')'; ?></h1>
                    <?php if (Yii::app()->user->id == $model->id): ?>
                        <?= CHtml::link(Yii::t('Site', 'Edit User Info'), array('/user/edit')); ?>
                    <?php endif; ?>
                </td>
            </tr></table>    
    </div>

    <div class="outer">

        <div class="container">
            <div class="content">
                <div class="intend"></div>
            </div><!--/content-->
        </div><!--/container-->

        <div class="sidebar">
            <ul>
                <li><a href="javascript:void(0)">Профиль</a></li>
                <li>
                    <a href="javascript:void(0)"><b>Лента</b></a>
                    <ul>
                        <li><a href="javascript:void(0)">комментарии <span style="background-color:black; color: white; margin-left:5px;">2</span></a> </li>
                        <li><a href="javascript:void(0)">плюсы и минусы</a></li>
                        <li><a href="javascript:void(0)">согласен / не согласен</a></li>
                        <li><a href="javascript:void(0)">отзывы</a></li>
                        <li><a href="javascript:void(0)">снижение цены <span style="background-color:black; color: white; margin-left:5px;">1</span></a></li>
                        <li><a href="javascript:void(0)">появление цены</a></li>
                    </ul>
                </li>
                <li><a href="javascript:void(0)">Закладки</a></li>
                <li><a href="javascript:void(0)">Настройки</a></li>
            </ul>        </div><!--/sidebar-->

    </div><!--/outer-->
</div>