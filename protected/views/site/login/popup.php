<div class="wcontent" id="popupLogin">
	<div class="contentLogin">
		<h2>Вход на сайт</h2>
		<div class="response" style="display:none; height: 100px; margin-bottom: 20px;">
			<div></div>
			<a href="javascript:void(0);" onclick='$("#popupLogin .contentLogin .response").hide();$("#formLogin").show();'>Попробовать еще раз</a>
		</div>
                    <?php $this->renderPartial('frm/_login', array('model' => new Form_Login())) ?>
		<div class="social">
		</div>
			
	</div><!-- /contentnLogin -->
</div>
