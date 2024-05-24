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

$cat = $arParams["CATEGORY_PROPS"];
?>
<div class="propers_elems">
	<? foreach($arResult["ITEMS"] as $key => $arItem): 
	if($arItem['PROPERTIES']['CAT_RAZD']['VALUE'] == $cat):
	$top = $arItem['PROPERTIES']['CAT_TOP']['VALUE'];
	$left = $arItem['PROPERTIES']['CAT_LEFT']['VALUE'];
	$right = $arItem['PROPERTIES']['CAT_RIGHT']['VALUE'];
	$bottom = $arItem['PROPERTIES']['CAT_BOTTOM']['VALUE'];
	?>
		<div class="prop_elem" style="top: <?= $top ?>; left: <?= $left ?>; right: <?= $right ?>; bottom: <?= $bottom ?>;">
			<div class="prop_content">
				<div class="prop_title"><?= $arItem['NAME']?></div>
				<div class="prop_desc">
					<?= $arItem['DETAIL_TEXT']?>
				</div>
			</div>
		</div>
	<? endif; endforeach; ?>
</div>