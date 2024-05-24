<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use Bitrix\Main\Application;
$context = Application::getInstance()->getContext();
$request = Application::getInstance()->getContext()->getRequest();

$this->GetEditAreaId($arSection['ID']);
$arSection['SECTION_PAGE_URL'];
GetMessage("ELEMENT_COUNT");

$category = $arParams['SECTION_ID']; 

$listElements = array();
$rsParentSection = CIBlockSection::GetList(
		Array('sort' => 'ASC'),
		Array('IBLOCK_ID' => 2, 'ACTIVE' => 'Y', 'SECTION_ID' => 0)
	);	
while ($arParentSection = $rsParentSection->GetNext())
{
	if($arParentSection['DEPTH_LEVEL'] != 1)
	    $child_class = 'category_childs';
	$listElements[] = $arParentSection;
}
$arFilter = array("IBLOCK_ID"=>2, "ID" => $category);
$arSelect =  array("NAME", "DESCRIPTION", "DETAIL_PICTURE");
$rsResult = CIBlockSection::GetList(array("SORT"=>"ASC"), $arFilter, false, $arSelect);
while($ob = $rsResult->GetNext()) {
     $sectionName = $ob["NAME"];
     $sectionDescr = $ob["DESCRIPTION"];
	 $sectionImage = $ob["DETAIL_PICTURE"];
}
?>
<section class="catalog_sections">
    <div class="container">
    <div class="sect_content">
			<div class="tabs-item">
			    <div class="content_left">
				    <div class="title_page_block">
					    <div class="page_elem back_elem">
						    <a href="<?= SITE_DIR ?>" class="back_page"><span>Назад</span></a>
						</div>
						<div class="page_elem title_elem">
						    <?$APPLICATION->IncludeComponent(
								"bitrix:breadcrumb", "top",
								Array("PATH" => "",
									"SITE_ID" => "s1",
									"START_FROM" => "0"),
							false, Array('HIDE_ICONS' => 'Y'));?>
							<h1 class="title_page"><? echo $sectionName; ?></h1>
						</div>
					</div>
					<div class="content_block">
					    <div class="description"><? echo $sectionDescr; ?></div>
						<div class="buttons">
						    <a href="#" class="btn btn_text">Подробнее о линейке</a>
							<a href="#" class="btn btn_text">Спецификация</a>
						</div>
					</div>
				</div>
				<div class="content_right" style="background-image:url(<?= CFile::GetPath($sectionImage)?>);"></div>
			</div>
	</div>
	<div class="sect_tabs">
	    <ul class="tabs-nav categories tab <?= $child_class ?>">
		<?php foreach($listElements as $key => $elem): if($key == 0) $first_elem = $elem['ID']; 
		    if($elem['ID'] == $category) $class_el = 'active'; else $class_el = '';
		    $fSections = CIBlockSection::GetList(false, Array("IBLOCK_ID" => 2, "ID" => $elem['ID'], "ACTIVE"=>"Y", "GLOBAL_ACTIVE"=>"Y", "SECTION_ACTIVE" => "Y"), false, Array("UF_SECT_ICON"), false);
			$flSections = $fSections->Fetch(); $icon = $flSections['UF_SECT_ICON']; ?>
			<li class="li_<?= $class_el ?> liclass_<?= $elem['ID'] ?>"><a class="filter_category_id <?= $class_el ?>" href="<?= $elem['SECTION_PAGE_URL'] ?>"><span class="icon icon_case<?= $icon ?>"></span><span class="text"><? echo $elem['NAME']; ?></span></a></li>
		<?php endforeach; ?>	
		</ul>
	</div>
	</div>
</section>