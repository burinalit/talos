<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<div class="params_section">
	<? foreach($arResult["ITEMS"] as $arItem): ?>
		<div class="params_elem">
		    <div class="params_title"><?= $arItem['PROPERTIES']['PARAM_ZN']['VALUE']?></div>
			<div class="params_desc"><?= $arItem['PROPERTIES']['PARAM_DESC']['VALUE']?></div>
		</div>
	<? endforeach; ?>	
</div>