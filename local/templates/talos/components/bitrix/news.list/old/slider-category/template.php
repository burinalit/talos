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
<div class="main-slider small">
	<div class="main-slider-block owl-carousel">
	    <? foreach($arResult["ITEMS"] as $arItem):  
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>
		<div class="slide-one mask-top mask-bottom" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
			<div class="slider-image" style="background-image: url('<?=CFile::GetPath($arItem["PROPERTIES"]["SLIDER_IMAGE"]["VALUE"])?>')"></div>
			<div class="slider-text">
				<h3><?=$arItem["NAME"]?></h3>
				<a href="<?=$arItem["PROPERTIES"]["SLIDER_LINK"]["VALUE"]?>" class="btn">Подробнее</a>
			</div>
		</div>
		<? endforeach; ?>
	</div>
</div>