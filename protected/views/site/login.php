<div class="wcontent" id="popupLogin">
	<div class="contentLogin">
		<h2>Вход на сайт</h2>
		<div class="response" style="display:none; height: 100px; margin-bottom: 20px;">
			<div></div>
			<a href="javascript:void(0);" onclick='$("#popupLogin .contentLogin .response").hide();$("#formLogin").show();'>Попробовать еще раз</a>
		</div>
		
		<?php $this->renderPartial('frm/_login', array('model' => $model)) ?>
		
		<h2>Войти из сети</h2>
		<div class="social">
			<?php
				$this->widget('ext.eauth.EAuthWidget', array('action' => 'site/login'));
			?>
		</div>
			
	</div><!-- /contentnLogin -->
	
	<div class="contentRegistration">
		<div class="title">
			<h2>Регистрация</h2>
			нового пользователя на Migom.by
		</div>
		<div class="response" style="display:none">
			<div></div>
			<a href="javascript:void(0);" onclick='$("#popupLogin .contentRegistration .response").hide();$("#formReg").show();'>Попробовать еще раз</a>		
		</div>
		
		<?php $this->renderPartial('frm/_registration', array('model' => $regModel)) ?>
	</div>
</div>
