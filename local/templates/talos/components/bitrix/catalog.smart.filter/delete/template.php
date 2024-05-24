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

use Bitrix\Iblock\SectionPropertyTable;

$this->setFrameMode(true);
$filter = array(
    "IBLOCK_ID" => 2,
    "SECTION_ID" => $arResult['SECTION']['ID']
);
global $arrFilter;
$filter = array_merge($filter, $arrFilter);

$cnt = CIBlockElement::GetList(
    array(),
    array($filter),
    array(),
    false,
    array('ID', 'NAME')
); 
?>
<div class="line_block count_positions">
    <span class="title">Найдено: </span><span class="res"><?= $cnt ?> позиций</span>
</div>
<div class="line_block search_cat">
	<?$APPLICATION->IncludeComponent(
		"bitrix:catalog.search",
		"",
		Array(
			"ACTION_VARIABLE" => "action",
			"AJAX_MODE" => "N",
			"AJAX_OPTION_ADDITIONAL" => "",
			"AJAX_OPTION_HISTORY" => "N",
			"AJAX_OPTION_JUMP" => "N",
			"AJAX_OPTION_STYLE" => "Y",
			"BASKET_URL" => "/personal/basket.php",
			"CACHE_TIME" => "36000000",
			"CACHE_TYPE" => "A",
			"CHECK_DATES" => "N",
			"CONVERT_CURRENCY" => "N",
			"DETAIL_URL" => "",
			"DISPLAY_BOTTOM_PAGER" => "Y",
			"DISPLAY_COMPARE" => "N",
			"DISPLAY_TOP_PAGER" => "N",
			"ELEMENT_SORT_FIELD" => "sort",
			"ELEMENT_SORT_FIELD2" => "id",
			"ELEMENT_SORT_ORDER" => "asc",
			"ELEMENT_SORT_ORDER2" => "desc",
			"HIDE_NOT_AVAILABLE" => "N",
			"HIDE_NOT_AVAILABLE_OFFERS" => "N",
			"IBLOCK_ID" => "",
			"IBLOCK_TYPE" => "catalog",
			"LINE_ELEMENT_COUNT" => "3",
			"NO_WORD_LOGIC" => "N",
			"OFFERS_LIMIT" => "5",
			"PAGER_DESC_NUMBERING" => "N",
			"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
			"PAGER_SHOW_ALL" => "N",
			"PAGER_SHOW_ALWAYS" => "N",
			"PAGER_TEMPLATE" => ".default",
			"PAGER_TITLE" => "Товары",
			"PAGE_ELEMENT_COUNT" => "30",
			"PRICE_CODE" => array(),
			"PRICE_VAT_INCLUDE" => "Y",
			"PRODUCT_ID_VARIABLE" => "id",
			"PRODUCT_PROPERTIES" => array(),
			"PRODUCT_PROPS_VARIABLE" => "prop",
			"PRODUCT_QUANTITY_VARIABLE" => "quantity",
			"PROPERTY_CODE" => array("", ""),
			"RESTART" => "N",
			"SECTION_ID_VARIABLE" => "SECTION_ID",
			"SECTION_URL" => "",
			"SHOW_PRICE_COUNT" => "1",
			"USE_LANGUAGE_GUESS" => "Y",
			"USE_PRICE_COUNT" => "N",
			"USE_PRODUCT_QUANTITY" => "N",
			"USE_SEARCH_RESULT_ORDER" => "N",
			"USE_TITLE_RANK" => "N"
		)
	);?>
</div>		
<div class="line_block delete_filter">
		<form name="<?echo $arResult["FILTER_NAME"]."_form"?>" action="<?echo $arResult["FORM_ACTION"]?>" method="get" class="smartfilter">
			<?foreach($arResult["HIDDEN"] as $arItem):?>
			<input type="hidden" name="<?echo $arItem["CONTROL_NAME"]?>" id="<?echo $arItem["CONTROL_ID"]?>" value="<?echo $arItem["HTML_VALUE"]?>" />
			<?endforeach;?>
			<div class="bx-filter-block">
				<div class="bx-filter-parameters-box-container">
					<input
						class="btn btn-link"
						type="submit"
						id="del_filter"
						name="del_filter"
						value="Удалить фильтры"
					/>
				</div>
			</div>
		</form>
</div>
<script type="text/javascript">
	var smartFilter = new JCSmartFilter('<?echo CUtil::JSEscape($arResult["FORM_ACTION"])?>', '<?=CUtil::JSEscape($arParams["FILTER_VIEW_MODE"])?>', <?=CUtil::PhpToJSObject($arResult["JS_FILTER_PARAMS"])?>);
</script>