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
$regions = array();
$arFilter = Array("IBLOCK_ID"=>5, "ACTIVE"=>"Y");
$arGroupBy = Array("PROPERTY_DEALEARS_REGION");
$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter, $arGroupBy);

while($arFields = $res->GetNext()) {
    $regions[] = $arFields['PROPERTY_DEALEARS_REGION_VALUE'];
}
$result = array_unique($regions); 
$elements = array();
foreach($result as $region) {
	foreach($arResult["ITEMS"] as $inner_key => $item) {
		if($item['PROPERTIES']['DEALEARS_REGION']['VALUE'] == $region)
			$elements[$region][$inner_key] = $item;
		else continue;
	}
}
?>
<div class="contacts_tabs dealers_items_tab">
	<ul class="accordion-tabs2">
	<?php 
	$key = 0;
	foreach($result as $region): if($key == 0) $class="is-active"; else $class=""; $key++;?>
		<li class="tab-head-cont">
			<a href="#" class="<?= $class?>"><?= $key?>. <?= $region?></a>
			<section class="content_block_serv">
			<?php foreach($elements[$region] as $element): ?>
			<div class="infoblock">
			    <p><?= $element['NAME']?><br><?= $element['PROPERTIES']['DEALEARS_ADR']['VALUE']?></p>
                <?php if($element['PROPERTIES']['DEALEARS_SITE']['VALUE']):?>
				    <p class="info">Сайт: <a href="<?= $element['PROPERTIES']['DEALEARS_SITE']['VALUE']?>"><?= $element['PROPERTIES']['DEALEARS_SITE']['VALUE']?></a></p>
				<?php endif; ?>
				<?php if($element['PROPERTIES']['DEALEARS_PHONE']['VALUE']):?>
				    <p class="info">Телефон: <a href="tel:<?= $element['PROPERTIES']['DEALEARS_PHONE']['VALUE']?>"><?= $element['PROPERTIES']['DEALEARS_PHONE']['VALUE']?></a></p>
				<?php endif; ?>
				<?php if($element['PROPERTIES']['DEALEARS_SITE']['VALUE']):?>
				    <p class="info">Email: <a href="mail:<?= $element['PROPERTIES']['DEALEARS_EMAIL']['VALUE']?>"><?= $element['PROPERTIES']['DEALEARS_EMAIL']['VALUE']?></a></p>
				<?php endif; ?>
			</div>
            <?php endforeach; ?>				
			</section>
		</li>
	<?php endforeach; ?>	
	</ul>
</div>