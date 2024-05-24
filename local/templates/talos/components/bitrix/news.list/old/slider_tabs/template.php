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

// получаем разделы
$dbResSect = CIBlockSection::GetList(
   Array("SORT"=>"ASC"),
   Array("IBLOCK_ID"=>16)
);
//Получаем разделы и собираем в массив
while($sectRes = $dbResSect->GetNext())
{
 $arSections[] = $sectRes;
}
//Собираем  массив из Разделов и элементов
foreach($arSections as $arSection){   
 foreach($arResult["ITEMS"] as $key=>$arItem){  
   if($arItem['IBLOCK_SECTION_ID'] == $arSection['ID']){
   $arSection['ELEMENTS'][] =  $arItem;
   }
 } 
 $arElementGroups[] = $arSection; 
}
$arResult["ITEMS"] = $arElementGroups; ?>
<section class="about_tabs">
	<h1 class="title_section">Полный комплекс технологического процесса</h1>
	<div class="about_tabs_block">
	    <div class="container_geograf">
		<ul class="tabs-nav">
		<?php foreach($arResult["ITEMS"] as $key => $item){ $key++; ?>
			<li><a href="#tab-<?= $key ?>">
			<img src="<?= CFile::GetPath($item['PICTURE']) ?>" alt="<?= $item['NAME'] ?>"/>
				<span><?= $key ?>. <?= $item['NAME'] ?></span>
			</a></li>
		<?php } ?>		
		</ul>	
		</div>
		<div class="container">
		<div class="tabs-items">
		<?php foreach($arResult["ITEMS"] as $key => $item){ $key++; ?>
			<div class="tabs-item" id="tab-<?= $key ?>">
			<?if($item['ELEMENTS']): 
			    foreach($item['ELEMENTS'] as $elem): ?>
				    <img src="<?= $elem['PREVIEW_PICTURE']['SRC'] ?>" alt="<?= $item['NAME'] ?>"/>
			<?php endforeach; endif; ?>
			</div>
		<?php } ?>						
		</div>
		</div>
	</div>	
</section>

<script>
$(function() {
	var tab = $('.about_tabs_block .tabs-items > div'); 
	tab.hide().filter(':first').show(); 
	
	// Клики по вкладкам.
	$('.about_tabs_block .tabs-nav a').click(function(){
		tab.hide(); 
		tab.filter(this.hash).show(); 
		$('.about_tabs_block .tabs-nav a').removeClass('active');
		$(this).addClass('active');
		return false;
	}).filter(':first').click();
 
	// Клики по якорным ссылкам.
	$('.tabs-target').click(function(){
		$('.about_tabs_block .tabs-nav a[href=' + $(this).data('id')+ ']').click();
	});
});
</script>