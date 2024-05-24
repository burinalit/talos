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
<div class="main-banner mask-top-big">
	<div class="banner-image" style="background-image: url('<?=$arResult["DETAIL_PICTURE"]["SRC"]?>"></div>
	<div class="banner-text"><?php $APPLICATION->ShowTitle(false); ?></div>
</div>