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
<?if($arParams["DISPLAY_NAME"]!="N" && $arResult["NAME"]):?>
	<h1 class="title_block"><?=$arResult["NAME"]?></h1>
<?endif;?>
<div class="content_block">
<?= $arResult["DETAIL_TEXT"]?>
</div>
<? if($arResult["PROPERTIES"]['ABOUT_CHECK']['VALUE_XML_ID'] == 'YES'): ?>
    <div class="property_block">
	    <div class="property_block_item">
			<img src="<?=SITE_TEMPLATE_PATH?>/images/about1.svg" class="about_img" />
			<span>Высокое качество по Российским ценам</span>
		</div>
		<div class="property_block_item">
			<img src="<?=SITE_TEMPLATE_PATH?>/images/about2.svg" class="about_img" />
			<span>Высокотехнологичное производство в России</span>
		</div>
		<div class="property_block_item">
			<img src="<?=SITE_TEMPLATE_PATH?>/images/about3.svg" class="about_img" />
			<span>Сервисный центр</span>
		</div>
	</div>
<?endif;?>
<?if($arResult["PROPERTIES"]['TEXT_LINK']['VALUE']):?>
	<a href="<?= $arResult["PROPERTIES"]['TEXT_LINK']['VALUE']?>" class="btn link_block"><?=$arResult["PROPERTIES"]['TEXT_LINK']['DESCRIPTION']?></a>
<?endif;?>