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
<div class="slider_struct">
    <h2 class="title">Структура Группы компаний «ВЕПРЬ»</h2>
    <div class="container_small">
		<div class="slider_struct_content owl-carousel">
			<? foreach($arResult["ITEMS"] as $key => $arItem): ?>
			<div class="slide_item">
				<h2><?=$arItem['NAME']?></h2>
				<div class="slide_item_content">
					<?=$arItem['DETAIL_TEXT']?>
					<?php if($arItem['PROPERTIES']['STRUCT_ELEMENTS']['VALUE']):?>
						<ul>
						<?php foreach($arItem['PROPERTIES']['STRUCT_ELEMENTS']['VALUE'] as $item): ?>
							<li><?= $item?></li>
						<?php endforeach; ?>
						</ul>
					<?php endif; ?>
				</div>
			</div>
			<? endforeach; ?>
		</div>
	</div>
</div>