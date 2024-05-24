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
<div class="main-slider">
	<div class="main-slider-block slider single-item desktop">
		<div class="slide_item" style="background-image: url('<?= CFile::GetPath($arResult['PROPERTIES']["TEXT_IMAGE"]["VALUE"]) ?>')">
			<div class="slide_item_content">
				<h2><?=$arResult['NAME']?></h2>
				<?=$arResult['DETAIL_TEXT']?>
			</div>
		</div>
	</div>
	<div class="main-slider-block slider single-item mobile">
		<div class="slide_item">
		    <img src="<?= CFile::GetPath($arResult['PROPERTIES']["TEXT_IMAGE"]["VALUE"]) ?>" alt="<?=$arResult['NAME']?>" /> 
			<div class="slide_item_content">
				<h2><?=$arResult['NAME']?></h2>
			</div>
		</div>
	</div>
</div>