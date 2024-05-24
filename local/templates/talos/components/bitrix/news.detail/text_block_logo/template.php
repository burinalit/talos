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
<div class="content_block_logo">
    <div class="content_item content_logo">
	    <img src="<?= CFile::GetPath($arResult["PROPERTIES"]['TEXT_IMAGE']['VALUE'])?>" alt="logo vepr" />
	</div>
	<div class="content_item">
	    <?= $arResult["DETAIL_TEXT"]?>
	</div>
</div>	