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

$arFilter = Array(
	"IBLOCK_ID"=>$arParams["IBLOCK_ID"], 
	"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
	"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
);
$countElements = CIBlockElement::GetList(Array(), $arFilter, Array());

if (!$arParams['FILTER_VIEW_MODE'])
	$arParams['FILTER_VIEW_MODE'] = 'VERTICAL';
$arParams['USE_FILTER'] = (isset($arParams['USE_FILTER']) && $arParams['USE_FILTER'] == 'Y' ? 'Y' : 'N');

$fSections = CIBlockSection::GetList(
    false,
    Array("IBLOCK_ID" => $arParams["IBLOCK_ID"], "ID" => $arResult["VARIABLES"]["SECTION_ID"], "ACTIVE"=>"Y", "GLOBAL_ACTIVE"=>"Y", "SECTION_ACTIVE" => "Y", 'ELEMENT_SUBSECTIONS' => 'Y'),
    true,
    Array("UF_SECTION_TITLE", 
	"UF_SECTION_WORK", 
	"UF_SECTION_WORK_TITLE", 
	"UF_SECTION_WORK_TEXT", 
	"UF_SECTION_WORK_IMAGE", 
	"UF_SECTION_SERTIF", 
	"UF_SECTION_CHARACT",
	"UF_SECTION_CHARACT_TITLE",
	"UF_SECTION_CHARACT_IMAGE",
	"UF_SECTION_CHARACT_LIST",
	"UF_SECTION_CHARACT_TEXT",
	"UF_SECTION_PROCESS",
	"UF_SECTION_PROCESS_IMAGE",
	"UF_SECTION_PROCESS_TEXT",
	"UF_SECTION_PROCESS_TEXT2",
	"UF_SECTION_WHY",
	"UF_SECTION_WHY_TITLE",
	"UF_SECTION_WHY_LIST"),
    false
);
$arElem = $fSections->Fetch();
if ($arElem['UF_SECTION_TITLE']) {
    $APPLICATION->SetPageProperty("title", $arElem['UF_SECTION_TITLE']);
}
$APPLICATION->SetTitle($arElem['NAME']);
?>
<div class="about-section gallery-page">
    <div class="container">
        <div class="content-gallery border-box">
			<div class="sidebar-left content">
				<div class="anchors">
				    <?$APPLICATION->IncludeComponent("bitrix:menu", "solutions-menu", array(
						"ROOT_MENU_TYPE" => "catalog",
						"MENU_CACHE_TYPE" => "N",
						"MENU_CACHE_TIME" => "3600",
						"MENU_CACHE_USE_GROUPS" => "Y",
						"MENU_CACHE_GET_VARS" => array(
						),
						"MAX_LEVEL" => "3",
						"CHILD_MENU_TYPE" => "catalog",
						"USE_EXT" => "Y",
						"DELAY" => "N",
						"ALLOW_MULTI_SELECT" => "N"
						),
						false
					);?>
				</div>
			</div>
			<div class="grid-galleries">
			    <?php if($arElem['ELEMENT_CNT'] > 0):?>
				    <?php 
					$arOrder = Array("SORT"=>"ASC");
					$arSelect = Array("ID", "NAME", "IBLOCK_ID", "DETAIL_PAGE_URL" ,"PROPERTY_*");
					$arFilter = Array("IBLOCK_ID" => 7, 'SECTION_ID'=>$arElem['ID'], "ACTIVE"=>"Y");
					$res = CIBlockElement::GetList($arOrder, $arFilter, false, false, $arSelect);
				    $listElements = array();
					while($ob = $res->GetNextElement())
					{
						$listElements[] = $ob->GetFields();
					} ?>
			        <div class="content-block no-padding">
                        <?php if ($arElem['UF_SECTION_TITLE']): ?>
							<h1><?= $arElem['UF_SECTION_TITLE'] ?></h1>
						<?php else: ?>
							<h1><?= $arElem['NAME'] ?></h1>
						<?php endif; ?>	
                    </div>
                    <div class="auto-row tab">
					<?php foreach($listElements as $key => $elem): if($key == 0) $first_elem = $elem['ID']; ?>
                        <a class="solutions_element_id" data-solutions-element-id="<?= $elem['ID']?>" href="#"><?= $elem['NAME']?></a>
					<?php endforeach; ?>	
                    </div>
					<script>
					$(function(){
						$(".solutions_element_id").click(function(){
						  var modalNumber =  $(this).data("solutions-element-id");
						  $(this).addClass("active");
						  window.location.href="?element-id="+modalNumber;						  
						});
					});
					</script>
					<?php 
					if($_GET['element-id']) $element_id = $_GET['element-id'];
					else $element_id = $first_elem;
					 ?>
					 <script>
					$('[data-solutions-element-id=<?php echo $element_id; ?>]')
					    .addClass("active");
                    </script>
					<?$APPLICATION->IncludeComponent(
						"bitrix:catalog.element",
						"solutions_elem",
						Array(
							"ACTION_VARIABLE" => "action",
							"ADD_DETAIL_TO_SLIDER" => "Y",
							"ADD_ELEMENT_CHAIN" => "Y",
							"ADD_PICT_PROP" => "-",
							"ADD_PROPERTIES_TO_BASKET" => "Y",
							"ADD_SECTIONS_CHAIN" => "Y",
							"ADD_TO_BASKET_ACTION" => array("BUY"),
							"ADD_TO_BASKET_ACTION_PRIMARY" => array("BUY"),
							"BACKGROUND_IMAGE" => "-",
							"BASKET_URL" => "/personal/basket/",
							"BRAND_USE" => "N",
							"BROWSER_TITLE" => "-",
							"CACHE_GROUPS" => "Y",
							"CACHE_TIME" => "36000000",
							"CACHE_TYPE" => "A",
							"CHECK_SECTION_ID_VARIABLE" => "N",
							"COMPATIBLE_MODE" => "Y",
							"CONVERT_CURRENCY" => "N",
							"DETAIL_PICTURE_MODE" => array("POPUP", "MAGNIFIER"),
							"DETAIL_URL" => "",
							"DISABLE_INIT_JS_IN_COMPONENT" => "N",
							"DISPLAY_COMPARE" => "N",
							"DISPLAY_NAME" => "Y",
							"DISPLAY_PREVIEW_TEXT_MODE" => "E",
							"ELEMENT_CODE" => "",
							"ELEMENT_ID" => $element_id,
							"GIFTS_DETAIL_BLOCK_TITLE" => "Выберите один из подарков",
							"GIFTS_DETAIL_HIDE_BLOCK_TITLE" => "N",
							"GIFTS_DETAIL_PAGE_ELEMENT_COUNT" => "4",
							"GIFTS_DETAIL_TEXT_LABEL_GIFT" => "Подарок",
							"GIFTS_MAIN_PRODUCT_DETAIL_BLOCK_TITLE" => "Выберите один из товаров, чтобы получить подарок",
							"GIFTS_MAIN_PRODUCT_DETAIL_HIDE_BLOCK_TITLE" => "N",
							"GIFTS_MAIN_PRODUCT_DETAIL_PAGE_ELEMENT_COUNT" => "4",
							"GIFTS_MESS_BTN_BUY" => "Выбрать",
							"GIFTS_SHOW_DISCOUNT_PERCENT" => "Y",
							"GIFTS_SHOW_IMAGE" => "Y",
							"GIFTS_SHOW_NAME" => "Y",
							"GIFTS_SHOW_OLD_PRICE" => "Y",
							"HIDE_NOT_AVAILABLE_OFFERS" => "N",
							"IBLOCK_ID" => "2",
							"IBLOCK_TYPE" => "catalog",
							"IMAGE_RESOLUTION" => "16by9",
							"LABEL_PROP" => array(),
							"LINK_ELEMENTS_URL" => "link.php?PARENT_ELEMENT_ID=#ELEMENT_ID#",
							"LINK_IBLOCK_ID" => "",
							"LINK_IBLOCK_TYPE" => "",
							"LINK_PROPERTY_SID" => "",
							"MESSAGE_404" => "",
							"MESS_BTN_ADD_TO_BASKET" => "В корзину",
							"MESS_BTN_BUY" => "Купить",
							"MESS_BTN_SUBSCRIBE" => "Подписаться",
							"MESS_COMMENTS_TAB" => "Комментарии",
							"MESS_DESCRIPTION_TAB" => "Описание",
							"MESS_NOT_AVAILABLE" => "Нет в наличии",
							"MESS_PRICE_RANGES_TITLE" => "Цены",
							"MESS_PROPERTIES_TAB" => "Характеристики",
							"META_DESCRIPTION" => "-",
							"META_KEYWORDS" => "-",
							"OFFERS_LIMIT" => "0",
							"PARTIAL_PRODUCT_PROPERTIES" => "N",
							"PRICE_CODE" => array("BASE"),
							"PRICE_VAT_INCLUDE" => "N",
							"PRICE_VAT_SHOW_VALUE" => "N",
							"PRODUCT_ID_VARIABLE" => "id",
							"PRODUCT_INFO_BLOCK_ORDER" => "sku,props",
							"PRODUCT_PAY_BLOCK_ORDER" => "rating,price,priceRanges,quantityLimit,quantity,buttons",
							"PRODUCT_PROPS_VARIABLE" => "prop",
							"PRODUCT_QUANTITY_VARIABLE" => "quantity",
							"PRODUCT_SUBSCRIPTION" => "Y",
							"SECTION_CODE" => "",
							"SECTION_ID" => $arElem['ID'],
							"SECTION_ID_VARIABLE" => "SECTION_ID",
							"SECTION_URL" => "",
							"SEF_MODE" => "N",
							"SET_BROWSER_TITLE" => "Y",
							"SET_CANONICAL_URL" => "N",
							"SET_LAST_MODIFIED" => "N",
							"SET_META_DESCRIPTION" => "Y",
							"SET_META_KEYWORDS" => "Y",
							"SET_STATUS_404" => "N",
							"SET_TITLE" => "N",
							"SET_VIEWED_IN_COMPONENT" => "N",
							"SHOW_404" => "N",
							"SHOW_CLOSE_POPUP" => "N",
							"SHOW_DEACTIVATED" => "N",
							"SHOW_DISCOUNT_PERCENT" => "N",
							"SHOW_MAX_QUANTITY" => "N",
							"SHOW_OLD_PRICE" => "N",
							"SHOW_PRICE_COUNT" => "1",
							"SHOW_SLIDER" => "N",
							"STRICT_SECTION_CHECK" => "N",
							"TEMPLATE_THEME" => "blue",
							"USE_COMMENTS" => "N",
							"USE_ELEMENT_COUNTER" => "Y",
							"USE_ENHANCED_ECOMMERCE" => "N",
							"USE_GIFTS_DETAIL" => "N",
							"USE_GIFTS_MAIN_PR_SECTION_LIST" => "N",
							"USE_MAIN_ELEMENT_SECTION" => "N",
							"USE_PRICE_COUNT" => "N",
							"USE_PRODUCT_QUANTITY" => "N",
							"USE_RATIO_IN_RANGES" => "N",
							"USE_VOTE_RATING" => "N"
						)
					);?>		
			    <?php else: ?>
					<div class="content-block no-padding">
					<?php if ($arElem['UF_SECTION_TITLE']): ?>
						<h1><?= $arElem['UF_SECTION_TITLE'] ?></h1>
					<?php else: ?>
						<h1><?= $arElem['NAME'] ?></h1>
					<?php endif; ?>				
					</div>
					<?$APPLICATION->IncludeComponent(
					   "bitrix:catalog.section.list",
					   "subsolutions",
					   Array(
						  "ADD_SECTIONS_CHAIN" => "Y",
						  "CACHE_FILTER" => "N",
						  "CACHE_GROUPS" => "Y",
						  "CACHE_TIME" => "36000000",
						  "CACHE_TYPE" => "A",
						  "COMPONENT_TEMPLATE" => "tree",
						  "COMPOSITE_FRAME_MODE" => "A",
						  "COMPOSITE_FRAME_TYPE" => "AUTO",
						  "COUNT_ELEMENTS" => "N",
						  "FILTER_NAME" => "",
						  "IBLOCK_ID" => "7",
						  "IBLOCK_TYPE" => "catalog",
						  "SECTION_CODE" => $arFilter['SECTION_CODE'],
						  "SECTION_FIELDS" => array(0=>"NAME",1=>"",),
						  "SECTION_ID" => $arFilter['SECTION_ID'],  // Тут передали ID
						  "SECTION_URL" => "#SECTION_CODE#",
						  "SECTION_USER_FIELDS" => array(0=>"",1=>"",),
						  "SHOW_PARENT_NAME" => "Y",
						  "TOP_DEPTH" => "1",
						  "VIEW_MODE" => "LINE"
					   )
					);?>
					<?
					$arFile = CFile::GetFileArray($arElem['UF_SECTION_SERTIF']);?>
					<?php if ($arElem['UF_SECTION_WORK'] == 1): ?>
					<div class="air-desc">
						<div class="air-info">
							<div class="title"><?= $arElem['UF_SECTION_WORK_TITLE'] ?></div>
							<p><?= $arElem['UF_SECTION_WORK_TEXT'] ?></p>
						</div>
						<div class="air-bg" style="background-image: url('<?= CFile::GetPath($arElem['UF_SECTION_WORK_IMAGE']) ?>');"></div>
					</div>
					<?php endif; ?>
					<?php if ($arFile): ?>
					<div class="link-download">
						<a href="<?= $arFile['SRC'] ?>"><img src="<?=SITE_TEMPLATE_PATH?>/images/dowloand.svg" alt="<?= $arFile['ORIGINAL_NAME'] ?>"><?= $arFile['ORIGINAL_NAME'] ?></a>
					</div>
					<?php endif; ?>
					<?php if ($arElem['UF_SECTION_CHARACT'] == 1): ?>
					<div class="desc-product">
						<div class="product-bg" style="background-image: url(<?= CFile::GetPath($arElem['UF_SECTION_CHARACT_IMAGE']) ?>);">

						</div>
						<div class="list-desc">
							<div class="list">
								<div class="title"><?= $arElem['UF_SECTION_CHARACT_TITLE'] ?>:</div>
								<ol>
								<?php foreach($arElem['UF_SECTION_CHARACT_LIST'] as $item):?>
									<li><?= $item ?></li>
								<?php endforeach; ?>	
								</ol>
							</div>
						</div>
					</div>
					<div class="content-block no-padding air"><p><?= $arElem['UF_SECTION_CHARACT_TEXT'] ?></p></div>
					<?php endif; ?>
					<?php if ($arElem['UF_SECTION_PROCESS'] == 1): ?>
					<div class="air-foto">
						<div class="item" style="background-image: url(<?=SITE_TEMPLATE_PATH?>/images/air-foto1.jpg);"></div>
						<div class="item opacity" style="background-image: url(<?= CFile::GetPath($arElem['UF_SECTION_PROCESS_IMAGE']) ?>);">
							<div class="text"><?= $arElem['UF_SECTION_PROCESS_TEXT'] ?></div>
						</div>
					</div>
					<div class="content-block no-padding air"><p><?= $arElem['UF_SECTION_PROCESS_TEXT2'] ?></p></div>
					<?php endif; ?>
					<?php if ($arElem['UF_SECTION_WHY'] == 1): ?>
					<div class="help-air">
						<div class="title"><?= $arElem['UF_SECTION_WHY_TITLE'] ?></div>
						<ul>
						<?php foreach($arElem['UF_SECTION_WHY_LIST'] as $key => $item): $key++; ?>
							<li><span><?= $key ?>.</span><?= $item ?></li>
						<?php endforeach; ?>	
						</ul>
					</div>
					<?php endif; ?>
				<?php endif; ?>
			</div>
        </div>
    </div>
</div>