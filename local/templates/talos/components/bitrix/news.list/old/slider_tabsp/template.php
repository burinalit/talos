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
   Array("IBLOCK_ID"=>19)
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
	<div class="about_tabs_block">
	    <div class="container_geograf">
		<ul class="tabs-nav">
		<?php foreach($arResult["ITEMS"] as $item){ ?>
			<li><a href="<?= $item['CODE'] ?>.php" >
			<img src="<?= CFile::GetPath($item['PICTURE']) ?>" alt="<?= $item['NAME'] ?>"/>
				<span><?= $item['NAME'] ?></span>
			</a></li>
		<?php } ?>		
		</ul>	
		</div>
	</div>	
</section>