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
				case 'file[]': ?>
					<label for="<?php echo $code; ?>"><?php echo $field['NAME']; ?><?php echo $field['REQUIRED'] ? '<span class="field-required">*</span>' : ''; ?></label>
					<label class="file">
						<?php $idFileField = 'file-' . uniqid($code); ?>
						<input id="<?php echo $idFileField; ?>" type="file" value=""
							   name="<?php echo $code; ?>[]" multiple
							   onchange="var inp =document.getElementById('<?php echo $idFileField; ?>');var l=[];for (var i = 0; i < inp.files.length; ++i) {l.push(inp.files.item(i).name.match(/[^\/\\]+$/));}var label=document.getElementById('<?php echo $idFileField; ?>-label');label.innerHTML=l.join(', ');if(l.length>0){var arr=label.className.split(' '); if (arr.indexOf('selected') == -1) {label.className += ' ' + 'selected';}}else{label.className += arr.join(' ').replace('selected',''); }">
						<a onclick="document.getElementById('<?php echo $idFileField; ?>').click();return false;">Îבחמנ</a>
						<label id="<?php echo $idFileField; ?>-label"><?php echo Loc::getMessage("INPUT_FILE_DEFAULT"); ?></label>
					</label>

					<?php
					break;

				case 'file':
					?>
					<label for="<?php echo $code; ?>"><?php echo $field['NAME']; ?><?php echo $field['REQUIRED'] ? ' <span class="field-required">*</span>' : ''; ?></label>
					<label class="file">
						<?php $idFileField = 'file-' . uniqid($code); ?>
						<input id="<?php echo $idFileField; ?>"
							   type="file"
							   name="<?php echo $code; ?>"
							   onchange="var inp =document.getElementById('<?php echo $idFileField; ?>');var l=[];for (var i = 0; i < inp.files.length; ++i) {l.push(inp.files.item(i).name.match(/[^\/\\]+$/));}var label=document.getElementById('<?php echo $idFileField; ?>-label');label.innerHTML=l.join(', ');if(l.length>0){var arr=label.className.split(' '); if (arr.indexOf('selected') == -1) {label.className += ' ' + 'selected';}}else{label.className += arr.join(' ').replace('selected',''); }">
						<a onclick="document.getElementById('<?php echo $idFileField; ?>').click();return false;">Îבחמנ</a>
						<label id="<?php echo $idFileField; ?>-label"><?php echo Loc::getMessage("INPUT_FILE_DEFAULT"); ?></label>
					</label>
					<?php
					break;

				case 'datepicker':
					?>
					<label for="<?php echo $code; ?>"><?php echo $field['NAME']; ?><?php echo $field['REQUIRED'] ? '<span class="field-required">*</span>' : ''; ?></label>
					<input id="<?php echo $code; ?>" type="text" value="" class="date"
						   name="<?php echo $code; ?>"
						   value="<?php echo Feedbackform::reqInput($code, ''); ?>"
						   onclick="BX.calendar({node: this, field: this, bTime: false});">
					<?php
					break;
				case 'select':
					?>
					<label for="<?php echo $code; ?>"><?php echo $field['NAME']; ?><?php echo $field['REQUIRED'] ? '<span class="field-required">*</span>' : ''; ?></label>
					<select id="<?php echo $code; ?>" name="<?php echo $code; ?>"
						<?php echo $field['REQUIRED'] ? ' validate="validate" required ' : ''; ?>
					>
						<?php foreach ($field['VALUES'] as $id => $text) { ?>
							<option value="<?php echo $id; ?>"
								<?php echo Feedbackform::reqInput($code) == $id ? ' selected ' : ''; ?>
							><?php echo $text; ?>
							</option>
							<?php
						} ?>
					</select>
					<?php
					break;
				case 'select[]':
					?>
					<label for="<?php echo $code; ?>"><?php echo $field['NAME']; ?><?php echo $field['REQUIRED'] ? '<span class="field-required">*</span>' : ''; ?></label>
					<select multiple id="<?php echo $code; ?>" name="<?php echo $code; ?>[]"
						<?php echo $field['REQUIRED'] ? ' validate="validate" required ' : ''; ?>
					>
						<?php foreach ($field['VALUES'] as $id => $text) { ?>
							<option value="<?php echo $id; ?>"
								<?php echo in_array($id, Feedbackform::reqInput($code, [])) ? ' selected ' : ''; ?>
							>
								<?php echo $text; ?></option>
							<?php
						} ?>
					</select>
					<?php
					break;
				case 'radio':
					?>
					<?php foreach ($field['VALUES'] as $id => $text) { ?>
					<div class="c-radio">
						<input id="<?php echo $code . '-' . $id; ?>" name="<?php echo $code; ?>"
							   type="radio" value="<?php echo $id; ?>"
							<?php echo Feedbackform::reqInput($code) == $id ? ' checked ' : ''; ?>
						>
						<label for="<?php echo $code . '-' . $id; ?>"><?php echo $text; ?></label>
					</div>
					<?php
				}
					break;
				case 'checkbox[]':
					?>
					<?php foreach ($field['VALUES'] as $id => $text) { ?>
					<div class="c-checkbox">
						<input id="<?php echo $code . '-' . $id; ?>" name="<?php echo $code; ?>[]"
							   type="checkbox" value="<?php echo $id; ?>"
							<?php echo in_array($id, Feedbackform::reqInput($code, [])) ? ' checked ' : ''; ?>
						>
						<label for="<?php echo $code . '-' . $id; ?>"><?php echo $text; ?></label>
					</div>
					<?php
				}
					break;
				case 'textarea': ?>
					<textarea class="form-control" id="<?php echo $code; ?>" placeholder="<?php echo $field['NAME']; ?>" name="<?php echo $code; ?>"
						<?php echo $field['REQUIRED'] ? ' validate="validate" required ' : ''; ?>
					><?php echo Feedbackform::reqInput($code, ''); ?></textarea>
					<?php
					break;
				case 'text':
				default: ?>
					<input class="form-control" id="<?php echo $code; ?>" name="<?php echo $code; ?>"
						   placeholder="<?php echo $field['NAME']; ?>"
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