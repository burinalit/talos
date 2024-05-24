<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
	<div id="button-up" class="btn btn_up"><svg xmlns="http://www.w3.org/2000/svg" width="22.048" height="13.524" viewBox="0 0 22.048 13.524">
	  <path id="Контур_245" data-name="Контур 245" d="M1269,2822.284l7.489-7.489,7.488,7.489" transform="translate(-1265.467 -2812.295)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="5"/>
	</svg>
	</div>
</main>
<footer class="page_block bx-footer">
    <div class="container">
	    <section class="footer_content">
            <div class="copy">© 2023 ООО «ТАЛОС КЕЙС» / Все права защищены</div>
			<div class="polit"><a href="#">Политика конфиденциальности</a></div>
        </section>		
	</div>
</footer>
<!-- Modal -->
<div id="modal-call" class="mdl-bg hidden">
	<div class="mdl-window">
		<div class="form">
			<div class="form__content">
			    <button class="mdl-close">close</button>
				<?$APPLICATION->IncludeComponent(
					"interlabs:feedbackform",
					"callback",
					Array(
						"AGREE_PROCESSING" => "N",
						"AJAX_MODE" => "Y",
						"AJAX_OPTION_ADDITIONAL" => "",
						"AJAX_OPTION_HISTORY" => "N",
						"AJAX_OPTION_JUMP" => "N",
						"AJAX_OPTION_STYLE" => "Y",
						"EMAIL_FROM" => "sale@vepr.burinal.com",
						"EMAIL_TO" => "sale@vepr.burinal.com",
						"EVENT_TYPE" => "INTERLABS_FEEDBACK",
						"FIELD_CHECK" => array("FORM_NAME", "FORM_EMAIL", "FORM_PHONE", ""),
						"FORM_ID" => "2",
						"IBLOCK_FIELDS_USE" => array("FORM_NAME", "FORM_COMPANY", "FORM_EMAIL", "FORM_POST", "FORM_PHONE", "FORM_FILE", "FORM_MESSAGE"),
						"IBLOCK_FIELD_EMAIL" => "FORM_EMAIL",
						"IBLOCK_FIELD_PHONE" => "FORM_PHONE",
						"IBLOCK_ID" => "52",
						"IBLOCK_TYPE" => "form_call",
						"MAX_FILE_COUNT" => "1",
						"MAX_FILE_SIZE" => "5",
						"MESSAGE_ID" => "1",
						"SUBJECT" => "Оставить заявку",
						"USE_CAPTCHA" => "N"
					)
				);?>
			</div>
		</div>
	</div>
</div>
<script>
	BX.ready(function(){
		var upButton = document.querySelector('[data-role="eshopUpButton"]');
		BX.bind(upButton, "click", function(){
			var windowScroll = BX.GetWindowScrollPos();
			(new BX.easing({
				duration : 500,
				start : { scroll : windowScroll.scrollTop },
				finish : { scroll : 0 },
				transition : BX.easing.makeEaseOut(BX.easing.transitions.quart),
				step : function(state){
					window.scrollTo(0, state.scroll);
				},
				complete: function() {
				}
			})).animate();
		})
	});
</script>
</body>
</html>