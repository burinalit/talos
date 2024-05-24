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

CModule::IncludeModule("iblock");
$count = count($arResult["ITEMS"]);	
?>
<section class="page_block app_section">
    <div class="container">
	    <div class="title_section">
		    <div class="title_block">Сферы применения</div>
			<div class="desc_block">
			    <div class="slide_count"> <span id="sl_num_active">01</span> | <?= sprintf("%02d", $count)?></div>
				<div class="navig">
				    <button type="button" role="presentation" class="prev"><span>‹</span></button>
					<button type="button" role="presentation" class="next"><span>›</span></button>
				</div>
			</div>
		</div>
    </div>
	<div class="app_sect_items owl-carousel">
		<? foreach($arResult["ITEMS"] as $key => $arItem): ?>
		<div class="app_item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		    <img src="<?=$arItem["DETAIL_PICTURE"]['SRC']?>" class="app_item_img" />
			<div class="app_item_content">
				<div class="app_title"><?=$arItem['NAME']?></div>
				<div class="app_desc"><?=$arItem['DETAIL_TEXT']?></div>
			</div>
		</div>
		<? endforeach; ?>
	</div>
</section>
<script>
function leftFillNum(num, targetLength) {
  return num.toString().padStart(targetLength, "0");
}

jQuery(document).ready(function(){
    jQuery('.app_sect_items').owlCarousel({
        margin:26,
        nav:true,
		loop:true,
		items: 2,
		center: true,
    });
	var owl4 = jQuery('.app_section .owl-carousel');
    owl4.owlCarousel();
    jQuery('.app_section .navig .next').click(function() {
        owl4.trigger('next.owl.carousel');
    })
    jQuery('.app_section .navig .prev').click(function() {
        owl4.trigger('prev.owl.carousel');
    });
	
	owl4.on("changed.owl.carousel", function(event) {
    var page = leftFillNum(event.page.index + 1, 2);
	var el = document.getElementById('sl_num_active');
	if (typeof el.innerText !== 'undefined')
		el.innerText = page;
	else
		el.textContent = page;
  });
	
});
</script>