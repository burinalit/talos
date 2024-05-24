<?php
/**
 * Created by PhpStorm.
 * User: akorolev
 * Date: 01.10.2018
 * Time: 11:59
 */

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
use \Bitrix\Main\Localization\Loc;
Loc::loadLanguageFile(__FILE__);
CUtil::InitJSCore(array('interlabs_feedbackform')); ?>
<section class="page_block feedform_block"> 
	<div class="container">
		<div class="feedform_content">
		    <div class="title_block">Свяжитесь с нами</div>
			<div class="interlabs-feedbackform__container-succsess<?php if ($arResult['isSaveFeedback'] == false) {                
				echo ' hidden';
			}else{$arResult['form']=array();} ?>">
				<label><?php echo Loc::getMessage("FORM_SAVED"); ?></label>
			</div>
			<div class="interlabs-feedbackform__container__errors">
				<?php if (isset($arResult['validateErrors']) && count($arResult['validateErrors']) > 0) { ?>
					<?php foreach ($arResult['validateErrors'] as $error) { ?>
						<label class="interlabs-feedbackform__container__errors__item"
							   data-field="<?php echo isset($error['field']) ? $error['field'] : ''; ?>">
							<?php echo $error['message']; ?>
						</label>
					<?php } ?>
				<?php } ?>
			</div>
			<form method="post" enctype="multipart/form-data" action="" data-validatefields='<?php echo json_encode($arResult['template']['validate']); ?>' class="<?php echo $arResult['AJAX_MODE'] === 'Y' ? ' ' : ''; ?>">
				<?php if ($arResult['AJAX_MODE'] === 'Y') { ?>
					<input name="AJAX_CALL" value="N" type="hidden">
				<?php } ?>
				<input type="hidden" name="interlabs__feedbackform" value="Y">
				<input type="hidden" name="interlabs__feedbackform_FORM_ID" value="<?php echo $arParams['FORM_ID'] ?>">
				<div class="input-group">
					<?php foreach ($arResult['FIELDS'] as $code => $field){ ?>
						<?php switch ($field['TYPE']) {
							case 'text':  
							if(isset($field['CODE']['DEFAULT_VALUE']) && $field['CODE']['DEFAULT_VALUE'] === 'a:2:{s:4:"TYPE";s:4:"HTML";s:4:"TEXT";s:0:"";}'): ?>							
							    <div class="input_textarea_elem">
									<textarea id="<?php echo $code; ?>" placeholder="<?php echo $field['NAME']; ?>" name="<?php echo $code; ?>"
										<?php echo $field['REQUIRED'] ? ' validate="validate" required ' : ''; ?>
									><?php echo Feedbackform::reqInput($code, ''); ?></textarea>
								</div>	
							<?php else: ?>
							<div class="input_text_elem">
								<input class="form-control" id="<?php echo $code; ?>" name="<?php echo $code; ?>"
									   placeholder="<?php echo $field['NAME']; ?> <?php echo $field['REQUIRED'] ? '*' : ''; ?>"
									   type="text"
									   value="<?php echo Feedbackform::reqInput($code, $arResult['form'][$code]); ?>"
									<?php echo $field['REQUIRED'] ? ' validate="validate" required ' : ''; ?>
								>
							</div>	
							<?php endif; ?>
						<?php break; } 
						switch ($field['TYPE']) {
							case 'file': ?>
							    <div class="input_text_elem">
									<label class="file">
										<?php $idFileField = 'file-' . uniqid($code); ?>
										<label id="<?php echo $idFileField; ?>-label"><?php echo $field['NAME']; ?></label>   
										<a onclick="document.getElementById('<?php echo $idFileField; ?>').click();return false;">+</a>
										<input placeholder="" id="<?php echo $idFileField; ?>"
											   type="file"
											   name="<?php echo $code; ?>"
											   onchange="var inp =document.getElementById('<?php echo $idFileField; ?>');var l=[];for (var i = 0; i < inp.files.length; ++i) {l.push(inp.files.item(i).name.match(/[^\/\\]+$/));}var label=document.getElementById('<?php echo $idFileField; ?>-label');label.innerHTML=l.join(', ');if(l.length>0){var arr=label.className.split(' '); if (arr.indexOf('selected') == -1) {label.className += ' ' + 'selected';}}else{label.className += arr.join(' ').replace('selected',''); }">
										
									</label>
								</div>	
						<?php break;
						} switch ($field['TYPE']) {
							case 'textarea': ?>
							<div class="input_textarea_elem">
								<textarea id="<?php echo $code; ?>" placeholder="<?php echo $field['NAME']; ?>" name="<?php echo $code; ?>"
									<?php echo $field['REQUIRED'] ? ' validate="validate" required ' : ''; ?>
								><?php echo Feedbackform::reqInput($code, ''); ?></textarea>
							</div>		
						<?php break;
						} ?>
					<? } ?>
				</div>
				<div class="button-group">
				    <div class="agree_el">Нажимая на кнопку «Отправить», вы даете согласие на обработку своих персональных данных</div>
					<button type="submit" class="btn btn_submit btn-primary modal-default-button js-interlabs-feedbackform__dialog__send-button"><?php echo Loc::getMessage("FORM_SEND"); ?></button>
				</div>
			</form>
		</div>
	</div>
</section>