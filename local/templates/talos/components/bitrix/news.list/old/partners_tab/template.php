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
$this->setFrameMode(true);?>
<div class="partners_items_content">
    <?php foreach($arResult["ITEMS"] as $item): ?>
	    <div class="partners_item">
		    <img src="<?= $item['PREVIEW_PICTURE']['SRC']?>" alt="<?= $item['NAME']?>"/>
		</div>
	<?php endforeach; ?>	
</div>