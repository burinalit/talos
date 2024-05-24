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
<div class="section_home_items">
<div class="section_home_info owl-carousel">
<?foreach($arResult["ITEMS"] as $arItem):?>
    <div class="section_home_item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
			<img class="preview_picture" src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
				title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>" />
		<?endif?>
		<div class="item_content">
			<?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
				<span class="title"><?echo $arItem["NAME"]?></span>
			<?endif;?>
			<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
				<p><?echo $arItem["PREVIEW_TEXT"];?></p>
			<?endif;?>
		</div>
	</div>
<?endforeach;?>
</div>
</div>