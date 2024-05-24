<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;
Loc::loadLanguageFile(__FILE__);
CUtil::InitJSCore(array('interlabs_feedbackform')); ?>

<div class="tenders_form_item">
	<div class="section_title">
		<h6><?php echo Loc::getMessage("FORM_SECTION_TITLE"); ?></h6>
	</div>
<div class="interlabs-feedbackform__container-succsess <?php if ($arResult['isSaveFeedback'] == false) echo 'hidden'; else $arResult['form']=array();?>">
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
				case 'file[]': ?>
				<div class="input_line input_line_files">
				    <?php $idFileField = 'file-' . uniqid($code); ?>
					<div class="field__wrapper">
						<input name="<?php echo $code; ?>[]" type="file" name="file" id="<?php echo $idFileField; ?>" class="field field__file" multiple onchange="var inp =document.getElementById('<?php echo $idFileField; ?>');var l=[];for (var i = 0; i < inp.files.length; ++i) {l.push(inp.files.item(i).name.match(/[^\/\\]+$/));}var label=document.getElementById('<?php echo $idFileField; ?>-label');label.innerHTML=l.join(', ');if(l.length>0){var arr=label.className.split(' '); if (arr.indexOf('selected') == -1) {label.className += ' ' + 'selected';}}else{label.className += arr.join(' ').replace('selected',''); }">
						<label class="field__file-wrapper" for="<?php echo $code; ?>">
							<div class="field__file-fake">Файл не выбран</div>
							<div class="field__file-button">Выбрать файл</div>
						</label>
						<span class="file_title"><?php echo Loc::getMessage("files"); ?></span> 
					</div>
				</div>
				<?php break; ?>
				<?php case 'textarea': ?>
				<div class="input_line">
					<textarea class="form-control" id="<?php echo $code; ?>" placeholder="<?php echo Loc::getMessage("textarea"); ?>" name="<?php echo $code; ?>"
						<?php echo $field['REQUIRED'] ? ' validate="validate" required ' : ''; ?>
					><?php echo Feedbackform::reqInput($code, ''); ?></textarea>
				</div>
				<?php break; ?>
				<?php case 'text':
				default: ?>
				<div class="input_line">
				<?php if($code == 'FORM_NAME') $title = Loc::getMessage("fio"); 
				      else $title = $field['NAME']; ?>
					<input class="form-control" id="<?php echo $code; ?>" name="<?php echo $code; ?>"
						   placeholder="<?php echo $title; ?>"
						   type="text"
						   value="<?php echo Feedbackform::reqInput($code, $arResult['form'][$code]); ?>"
						<?php echo $field['REQUIRED'] ? ' validate="validate" required ' : ''; ?> >
				</div>	
				<?php } ?>
	    <? } ?>
	</div>
	<?php if ($arResult['AGREE_PROCESSING'] === 'Y') { ?>
	<div class="form-check input_line">
	    <input id="AGREE_PROCESSING" class="form-check-input" name="AGREE_PROCESSING" value="Y" type="checkbox" required>
        <label for="AGREE_PROCESSING"><?php echo Loc::getMessage("AGREE_PROCESSING"); ?></label>
	</div>
	<?php } ?>
	<button type="submit" class="btn js-interlabs-feedbackform__dialog__send-button"><?php echo Loc::getMessage("FORM_SEND"); ?></button>
</form>
</div>