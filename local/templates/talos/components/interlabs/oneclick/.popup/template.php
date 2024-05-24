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
global $APPLICATION;

use Bitrix\Main\Localization\Loc;

/**
 * $arResult=[
 *   PRODUCT_ID => int
 *   user => [NAME,PHONE, EMAIL]
 *
 *
 * ];
 */
$data = [
    "PRODUCT_ID" => $arResult['PRODUCT_ID']
];
$data = json_encode($data);

CUtil::InitJSCore(array('interlabs_oneclick_popup')); ?>
<div class="price-product">
    <a href="javascript:void(0);" class="btn interlabs-one-click-buy" data-productid="<?php echo $arResult['PRODUCT_ID']; ?>" data-data='<?php echo $data; ?>' id="one-click-buy-<?php echo $arResult['PRODUCT_ID']; ?>">Узнать цену</a>	
</div>
<div class="interlabs-oneclick__container" id="interlabs-oneclick__container-<?php echo $arResult['PRODUCT_ID']; ?>"
     style="<?php if (isset($arResult['success']) && isset($arResult['success']['message'])) {
     } else {
         echo 'display:none;';
     } ?>">
    <div class="interlabs-oneclick__container__dialog modal-mask form-modal">
        <div class="modal-wrapper">
            <div class="modal-container">
				<button data-dismiss="modal" aria-label="Close" class="js-interlabs-oneclick__dialog__close close mdl-close">close</button>
				<h3>Узнать цену</h3>
				<div class="errors common js-step-1"
					 style="<?php if (isset($arResult['success']) && isset($arResult['success']['message'])) {
						 echo 'display:none;';
					 } ?>">
					<?php if ($arResult['PRODUCT_ID'] == $_REQUEST['PRODUCT_ID'] && isset($arResult['validateErrors']) && count($arResult['validateErrors']) > 0) {
						foreach ($arResult['validateErrors'] as $error) {
							echo "<div>{$error['message']}</div>";
						} ?>
					<?php } ?>
				</div>
				<form action="" class="js-step-1" method="post" enctype="multipart/form-data" onsubmit=""
					  style="<?php if (isset($arResult['success']) && isset($arResult['success']['message'])) {
						  echo 'display:none;';
					  } ?>">
					<?= bitrix_sessid_post() ?>
					<input name="PRODUCT_ID" value="<?php echo $arResult['PRODUCT_ID']; ?>" type="hidden"/>
					<input name="interlabs__oneclick" value="Y" type="hidden"/>
					
					<div class="input-group">
						<input class="form-control" name="NAME" placeholder="<?php echo Loc::getMessage("fio"); ?>" type="text"
							   value="<?php echo Oneclick::reqInputByProduct("NAME", $arResult['user']['NAME'], $arResult['PRODUCT_ID']); ?>" required>
						<div class="error error-NAME"></div>
						<input class="form-control" name="PHONE" placeholder="<?php echo Loc::getMessage("phone"); ?>" type="text"
							   value="<?php echo Oneclick::reqInputByProduct("PHONE", $arResult['user']['PHONE'], $arResult['PRODUCT_ID']); ?>" required>
						<div class="error error-PHONE"></div>
					<?php if ($arResult['USE_FIELD_EMAIL'] === 'Y') { ?>
							<input class="form-control" name="EMAIL" placeholder="email" type="text"
								   value="<?php echo Oneclick::reqInputByProduct("EMAIL", $arResult['user']['EMAIL'], $arResult['PRODUCT_ID']); ?>" required>
							<div class="error error-EMAIL"></div>
					<?php } ?>

					<?php if ($arResult['USE_FIELD_COMMENT'] === 'Y') { ?>
							<textarea
								class="form-control" name="COMMENT"><?php echo Oneclick::reqInputByProduct("COMMENT", '', $arResult['PRODUCT_ID']); ?></textarea>
							<div class="error error-COMMENT"></div>
					<?php } ?>
                    </div>
					<?php if ($arResult['AGREE_PROCESSING'] === 'Y') {
						$AGREE_PROCESSING_TEXT_dialog_CSS_ID = 'AGREE_PROCESSING_TEXT_dialog' . uniqid('AGREE_PROCESSING_TEXT_dialog');
					?>
					<div class="form-check">
						<input id="AGREE_PROCESSING" class="form-check-input" name="AGREE_PROCESSING" value="Y"
							   type="checkbox" required>
						<label class="form-check-label" for="AGREE_PROCESSING"><?php echo Loc::getMessage("AGREE_PROCESSING"); ?></label>
						<div class="error error-AGREE_PROCESSING"></div>
					</div>
					<?php } ?>
					<button class="btn modal-default-button js-interlabs-oneclick__dialog__send-button"
						href="javascript:void(0);" type="submit"><?php echo Loc::getMessage('send'); ?></button>
				</form>
				<div class="js-interlabs-oneclick__result js-step-2">
					<?php if (isset($arResult['success']) && isset($arResult['success']['message'])) {
						echo $arResult['success']['message'];
					} ?>
				</div>
            </div>
        </div>
    </div>
</div>
<?php if (count($_POST) > 0 && isset($_POST['AJAX_CALL'])) { ?>
    <script type="text/javascript">
        if (typeof window['interlabsOneClickComponentApp'] === 'function') {
            interlabsOneClickComponentApp();
        }
    </script>
<?php } ?>




