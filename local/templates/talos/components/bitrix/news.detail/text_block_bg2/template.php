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
<div class="slide_content" style="background-image: url('<?= CFile::GetPath($arResult['PROPERTIES']["TEXT_IMAGE"]["VALUE"]) ?>')">
	<div class="container_small">
		<h2><?=$arResult['NAME']?></h2>
		<?=$arResult['DETAIL_TEXT']?>
	</div>
</div>