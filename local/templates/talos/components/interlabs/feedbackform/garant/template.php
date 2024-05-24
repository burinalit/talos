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
<section class="section_form_garant"> 
	<div class="container_small">
		<div class="form_garant_content">
		    <div class="form_title"><?= Loc::getMessage("TITLE") ?></div>
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
					<?php foreach ($arResult['FIELDS'] as $code => $field) { ?>
						<?php switch ($field['TYPE']) {
							case 'text':
							default: ?>
								<input class="form-control" id="<?php echo $code; ?>" name="<?php echo $code; ?>"
									   placeholder="<?php echo $field['NAME']; ?> *"
									   type="text"
									   value="<?php echo Feedbackform::reqInput($code, $arResult['form'][$code]); ?>"
									<?php echo $field['REQUIRED'] ? ' validate="validate" required ' : ''; ?>
								>
							<?php } ?>
					<? } ?>
				</div>
				<?php if ($arResult['AGREE_PROCESSING'] === 'Y') { ?>
				<div class="form-check">
					<input id="AGREE_PROCESSING" class="form-check-input" name="AGREE_PROCESSING" value="Y" type="checkbox" required>
					<label for="AGREE_PROCESSING"><?php echo Loc::getMessage("AGREE_PROCESSING"); ?></label>
				</div>
				<?php } ?>
				<button type="submit" class="btn btn-primary modal-default-button js-interlabs-feedbackform__dialog__send-button"><?php echo Loc::getMessage("FORM_SEND"); ?></button>
			</form>
		</div>
	</div>
</section>