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
<? foreach ($arResult["ITEMS"] as $key => $arItem){ ?>
	<div class="section_catalog_list_item">
		<div class="title_items">  
			<h2><?=$arItem['NAME']?></h2>
		</div>	
		<img src="<?= CFile::GetPath($arItem['PROPERTIES']["SERVICE_IMAGE"]['VALUE']) ?>" class="image_items" alt="<?= $arItem["NAME"]?>" />
		<img src="<?= CFile::GetPath($arItem['PROPERTIES']["SERVICE_RETINA"]['VALUE']) ?>" class="image_items_hover" alt="<?= $arItem["NAME"]?>" />
	</div>
<?php  } ?>