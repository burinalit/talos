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
<div class="container_small">
	<?if($arParams["DISPLAY_NAME"]!="N" && $arResult["NAME"]):?>
		<h2><?=$arResult["NAME"]?></h2>
	<?endif;?>
	<?= $arResult["DETAIL_TEXT"]?>
</div>