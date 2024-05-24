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
<div class="preims_section">
	<div class="preims_sect_items owl-carousel">
		<? $count = count($arResult["ITEMS"]);			
		foreach($arResult["ITEMS"] as $key => $arItem): ?>
		<div class="preims_item" id="<?=$this->GetEditAreaId($arItem['ID']);?>" style="background-image: url('<?=$arItem["DETAIL_PICTURE"]['SRC']?>')">
			<div class="preims_item_content">
				<div class="preims_title_sect">Преимущества</div>
				<div class="preims_info">
					<div class="preims_info_title"><?=$arItem['NAME']?></div>
					<div class="preims_info_desc"><?=$arItem['DETAIL_TEXT']?></div>
				</div>
				<div class="preims_count"> <?= sprintf("%02d", $key+1)?> | <?= sprintf("%02d", $count)?></div>
			</div>
		</div>
		<? endforeach; ?>
	</div>
	
</div>
<script>
jQuery(document).ready(function(){
    jQuery('.preims_sect_items').owlCarousel({
        margin:4,
        nav:true,
		loop:true,
		items: 1,
		dots:false,
		animateIn: 'fadeIn',
        animateOut: 'fadeOut',
    });
	
});
</script>