<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use Bitrix\Main\Application;
$context = Application::getInstance()->getContext();
$request = Application::getInstance()->getContext()->getRequest();

$GLOBALS['SECTION_FILTER_CATEGORY'] = $arCurSection['ID'];

$this->GetEditAreaId($arSection['ID']);

if($_GET['category']) $category = $_GET['category'];
else $category = 7; 

$listElements = array();
$rsParentSection = CIBlockSection::GetList(
		Array('sort' => 'ASC'),
		Array('IBLOCK_ID' => 2, 'ACTIVE' => 'Y', 'SECTION_ID' => $GLOBALS['SECTION_FILTER_CATEGORY'])
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
    <div class="sect_content">
			<div class="tabs-item" id="tab-<?= $key ?>">
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
							<div class="subtitle_page">Анатомия продукции</div>
							<h1 class="title_page"><? echo $sectionName; ?></h1>
						</div>
					</div>
					<div class="content_block">
					    <div class="description"><? echo $sectionDescr; ?></div>
						<div class="buttons">
						    <a id="btn_case<?= $category ?>" class="btn btn_case" data-mdl-id="modal-search">Выбрать кейс</a>
							<a href="#" class="btn btn_text">Спецификация</a>
						</div>
					</div>
				</div>
				<div class="content_right" style="background-image:url(<?= CFile::GetPath($sectionImage)?>);">    
					<?$APPLICATION->IncludeComponent(
						"bitrix:news.list",
						"sect_propers",
						Array(
							"ACTIVE_DATE_FORMAT" => "d.m.Y",
							"ADD_SECTIONS_CHAIN" => "N",
							"AJAX_MODE" => "N",
							"AJAX_OPTION_ADDITIONAL" => "",
							"AJAX_OPTION_HISTORY" => "N",
							"AJAX_OPTION_JUMP" => "N",
							"AJAX_OPTION_STYLE" => "Y",
							"CACHE_FILTER" => "N",
							"CACHE_GROUPS" => "Y",
							"CACHE_TIME" => "36000000",
							"CACHE_TYPE" => "N",
							"CHECK_DATES" => "Y",
							"DETAIL_URL" => "",
							"DISPLAY_BOTTOM_PAGER" => "N",
							"DISPLAY_DATE" => "Y",
							"DISPLAY_NAME" => "Y",
							"DISPLAY_PICTURE" => "Y",
							"DISPLAY_PREVIEW_TEXT" => "Y",
							"DISPLAY_TOP_PAGER" => "N",
							"FIELD_CODE" => array("DETAIL_PICTURE",""),
							"FILTER_NAME" => "",
							"HIDE_LINK_WHEN_NO_DETAIL" => "N",
							"IBLOCK_ID" => "53",
							"IBLOCK_TYPE" => "information",
							"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
							"INCLUDE_SUBSECTIONS" => "Y",
							"MESSAGE_404" => "",
							"NEWS_COUNT" => "100",
							"PAGER_BASE_LINK_ENABLE" => "N",
							"PAGER_DESC_NUMBERING" => "N",
							"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
							"PAGER_SHOW_ALL" => "N",
							"PAGER_SHOW_ALWAYS" => "N",
							"PAGER_TEMPLATE" => ".default",
							"PAGER_TITLE" => "",
							"PARENT_SECTION" => "0",
							"PARENT_SECTION_CODE" => "",
							"PREVIEW_TRUNCATE_LEN" => "",
							"PROPERTY_CODE" => array("SLIDER_TITLE","SLIDER_TEXT","SLIDER_LINK",""),
							"SET_BROWSER_TITLE" => "Y",
							"SET_LAST_MODIFIED" => "N",
							"SET_META_DESCRIPTION" => "Y",
							"SET_META_KEYWORDS" => "Y",
							"SET_STATUS_404" => "N",
							"SET_TITLE" => "N",
							"SHOW_404" => "N",
							"SORT_BY1" => "SORT",
							"SORT_BY2" => "SORT",
							"SORT_ORDER1" => "ASC",
							"SORT_ORDER2" => "ASC",
							"STRICT_SECTION_CHECK" => "N",
							"CATEGORY_PROPS" => $category
						)
					);?>
				</div>
			</div>
	</div>
	<div class="sect_tabs">
	    <ul class="tabs-nav categories tab <?= $child_class ?>">
		<?php foreach($listElements as $key => $elem): if($key == 0) $first_elem = $elem['ID']; 
		    if($elem['ID'] == $category) $class_el = 'active'; else $class_el = '';
		    $fSections = CIBlockSection::GetList(false, Array("IBLOCK_ID" => 2, "ID" => $elem['ID'], "ACTIVE"=>"Y", "GLOBAL_ACTIVE"=>"Y", "SECTION_ACTIVE" => "Y"), false, Array("UF_SECT_ICON"), false);
			$flSections = $fSections->Fetch(); $icon = $flSections['UF_SECT_ICON']; ?>
			<li class=""><a class="filter_category_id <?= $class_el ?>" data-filter-category-id="<?= $elem['ID']?>" href="#"><span class="icon icon_case<?= $icon ?>"></span><span class="text"><? echo $elem['NAME']; ?></span></a></li>
		<?php endforeach; ?>	
		</ul>
	</div>
</section>
<div id="modal-search" class="mdl-bg hidden">
	<div class="mdl-window">
		<div class="form">
			<div class="form__content">
				<button class="mdl-close">close</button>
				<?$APPLICATION->IncludeComponent(
					"bitrix:catalog.smart.filter",
					"sections",
					Array(
						"CACHE_GROUPS" => "Y",
						"CACHE_TIME" => "36000000",
						"CACHE_TYPE" => "A",
						"CONVERT_CURRENCY" => "N",
						"DISPLAY_ELEMENT_COUNT" => "Y",
						"FILTER_NAME" => "arrFilter",
						"FILTER_VIEW_MODE" => "horizontal",
						"HIDE_NOT_AVAILABLE" => "N",
						"IBLOCK_ID" => "2",
						"IBLOCK_TYPE" => "catalog",
						"PAGER_PARAMS_NAME" => "arrPager",
						"POPUP_POSITION" => "left",
						"PREFILTER_NAME" => "smartPreFilter",
						"PRICE_CODE" => array(),
						"SAVE_IN_SESSION" => "N",
						"SECTION_CODE" => "",
						"SECTION_CODE_PATH" => "",
						"SECTION_DESCRIPTION" => "-",
						"SECTION_ID" => $category,
						"SECTION_TITLE" => "-",
						"SEF_MODE" => "Y",
						"SEF_RULE" => "/catalog/#SECTION_CODE#/filter/#SMART_FILTER_PATH#/",
						"SMART_FILTER_PATH" => "",
						"TEMPLATE_THEME" => "blue",
						"XML_EXPORT" => "N"
					)
				);?>				
			</div>
		</div>
	</div>
</div>
					
<script>
$(function(){
	$(".filter_category_id").click(function(){
	  var modalNumber =  $(this).data("filter-category-id");
	  $(this).parent().addClass("active");
	  window.location.href="?category="+modalNumber;			  
	});
});
</script>