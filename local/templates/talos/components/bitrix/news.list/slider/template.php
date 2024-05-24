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
<div class="main-slider desktop">
    <div class="main-slider-block slider single-item">
		<? foreach($arResult["ITEMS"] as $key => $arItem): ?>
		<div class="slide_item" id="<?=$this->GetEditAreaId($arItem['ID']);?>" style="background-image: url('<?=$arItem["DETAIL_PICTURE"]['SRC']?>')">
		    <div class="container">
				<div class="slide_item_content">
					<div class="title_elem"><?=$arItem['PROPERTIES']['SLIDER_TITLE']['VALUE']?></div>
					<div class="text_elem"><?=$arItem['PROPERTIES']['SLIDER_TEXT']['VALUE']['TEXT']?></div>
					<?php if($arItem['PROPERTIES']['SLIDER_LINK']['VALUE']):?>
					<div class="link_elem">	
						<a href="<?= $arItem['PROPERTIES']['SLIDER_LINK']['VALUE']?>" class="btn btn_slider"><span><?= $arItem['PROPERTIES']['SLIDER_LINK']['DESCRIPTION']?></span></a>
					</div>	
					<?php endif; ?>
				</div>
			</div>
		</div>
		<? endforeach; ?>
	</div>
</div>
<div class="main-slider mobile">
    <div class="container">
		<div class="main-slider-block slidermob single-item">
			<? foreach($arResult["ITEMS"] as $key => $arItem): ?>
			<div class="slide_item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
			    <img src="<?=$arItem["PREVIEW_PICTURE"]['SRC']?>" alt="<?=$arItem['PROPERTIES']['SLIDER_TITLE']['VALUE']?>" />
				<div class="slide_item_content">
					<h2><?=$arItem['PROPERTIES']['SLIDER_TITLE']['VALUE']?></h2>
				</div>
			</div>
			<? endforeach; ?>
		</div>
	</div>
</div>
<script>
$(".slider").slick({
  infinite: true,
  arrows: false,
  fade: true,
  dots: false,
  autoplay: false,
  speed: 800,
  slidesToShow: 1,
  slidesToScroll: 1
});

$(".slidermob").slick({
  infinite: true,
  arrows: false,
  fade: true,
  dots: true,
  autoplay: false,
  slidesToShow: 1,
  slidesToScroll: 1
});	
</script>