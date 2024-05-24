<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 * @var string $templateFolder
 */

$this->setFrameMode(true);
$this->addExternalCss('/bitrix/css/main/bootstrap.css');

$templateLibrary = array('popup', 'fx');
$currencyList = '';

if (!empty($arResult['CURRENCIES']))
{
	$templateLibrary[] = 'currency';
	$currencyList = CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true);
}

$templateData = array(
	'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
	'TEMPLATE_LIBRARY' => $templateLibrary,
	'CURRENCIES' => $currencyList,
	'ITEM' => array(
		'ID' => $arResult['ID'],
		'IBLOCK_ID' => $arResult['IBLOCK_ID'],
		'OFFERS_SELECTED' => $arResult['OFFERS_SELECTED'],
		'JS_OFFERS' => $arResult['JS_OFFERS']
	)
);
unset($currencyList, $templateLibrary);

$mainId = $this->GetEditAreaId($arResult['ID']);
$itemIds = array(
	'ID' => $mainId,
	'DISCOUNT_PERCENT_ID' => $mainId.'_dsc_pict',
	'STICKER_ID' => $mainId.'_sticker',
	'BIG_SLIDER_ID' => $mainId.'_big_slider',
	'BIG_IMG_CONT_ID' => $mainId.'_bigimg_cont',
	'SLIDER_CONT_ID' => $mainId.'_slider_cont',
	'OLD_PRICE_ID' => $mainId.'_old_price',
	'PRICE_ID' => $mainId.'_price',
	'DISCOUNT_PRICE_ID' => $mainId.'_price_discount',
	'PRICE_TOTAL' => $mainId.'_price_total',
	'SLIDER_CONT_OF_ID' => $mainId.'_slider_cont_',
	'QUANTITY_ID' => $mainId.'_quantity',
	'QUANTITY_DOWN_ID' => $mainId.'_quant_down',
	'QUANTITY_UP_ID' => $mainId.'_quant_up',
	'QUANTITY_MEASURE' => $mainId.'_quant_measure',
	'QUANTITY_LIMIT' => $mainId.'_quant_limit',
	'BUY_LINK' => $mainId.'_buy_link',
	'ADD_BASKET_LINK' => $mainId.'_add_basket_link',
	'BASKET_ACTIONS_ID' => $mainId.'_basket_actions',
	'NOT_AVAILABLE_MESS' => $mainId.'_not_avail',
	'COMPARE_LINK' => $mainId.'_compare_link',
	'TREE_ID' => $mainId.'_skudiv',
	'DISPLAY_PROP_DIV' => $mainId.'_sku_prop',
	'DISPLAY_MAIN_PROP_DIV' => $mainId.'_main_sku_prop',
	'OFFER_GROUP' => $mainId.'_set_group_',
	'BASKET_PROP_DIV' => $mainId.'_basket_prop',
	'SUBSCRIBE_LINK' => $mainId.'_subscribe',
	'TABS_ID' => $mainId.'_tabs',
	'TAB_CONTAINERS_ID' => $mainId.'_tab_containers',
	'SMALL_CARD_PANEL_ID' => $mainId.'_small_card_panel',
	'TABS_PANEL_ID' => $mainId.'_tabs_panel'
);
$obName = $templateData['JS_OBJ'] = 'ob'.preg_replace('/[^a-zA-Z0-9_]/', 'x', $mainId);
$name = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'])
	? $arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']
	: $arResult['NAME'];
$title = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_TITLE'])
	? $arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_TITLE']
	: $arResult['NAME'];
$alt = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_ALT'])
	? $arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_ALT']
	: $arResult['NAME'];

$haveOffers = !empty($arResult['OFFERS']);
if ($haveOffers)
{
	$actualItem = isset($arResult['OFFERS'][$arResult['OFFERS_SELECTED']])
		? $arResult['OFFERS'][$arResult['OFFERS_SELECTED']]
		: reset($arResult['OFFERS']);
	$showSliderControls = false;

	foreach ($arResult['OFFERS'] as $offer)
	{
		if ($offer['MORE_PHOTO_COUNT'] > 1)
		{
			$showSliderControls = true;
			break;
		}
	}
}
else
{
	$actualItem = $arResult;
	$showSliderControls = $arResult['MORE_PHOTO_COUNT'] > 1;
}

$skuProps = array();
$price = $actualItem['ITEM_PRICES'][$actualItem['ITEM_PRICE_SELECTED']];
$measureRatio = $actualItem['ITEM_MEASURE_RATIOS'][$actualItem['ITEM_MEASURE_RATIO_SELECTED']]['RATIO'];
$showDiscount = $price['PERCENT'] > 0;

$showDescription = !empty($arResult['PREVIEW_TEXT']) || !empty($arResult['DETAIL_TEXT']);
$showBuyBtn = in_array('BUY', $arParams['ADD_TO_BASKET_ACTION']);
$buyButtonClassName = in_array('BUY', $arParams['ADD_TO_BASKET_ACTION_PRIMARY']) ? 'btn-default' : 'btn-link';
$showAddBtn = in_array('ADD', $arParams['ADD_TO_BASKET_ACTION']);
$showButtonClassName = in_array('ADD', $arParams['ADD_TO_BASKET_ACTION_PRIMARY']) ? 'btn-default' : 'btn-link';
$showSubscribe = $arParams['PRODUCT_SUBSCRIPTION'] === 'Y' && ($arResult['PRODUCT']['SUBSCRIBE'] === 'Y' || $haveOffers);

$arParams['MESS_BTN_BUY'] = $arParams['MESS_BTN_BUY'] ?: Loc::getMessage('CT_BCE_CATALOG_BUY');
$arParams['MESS_BTN_ADD_TO_BASKET'] = $arParams['MESS_BTN_ADD_TO_BASKET'] ?: Loc::getMessage('CT_BCE_CATALOG_ADD');
$arParams['MESS_NOT_AVAILABLE'] = $arParams['MESS_NOT_AVAILABLE'] ?: Loc::getMessage('CT_BCE_CATALOG_NOT_AVAILABLE');
$arParams['MESS_BTN_COMPARE'] = $arParams['MESS_BTN_COMPARE'] ?: Loc::getMessage('CT_BCE_CATALOG_COMPARE');
$arParams['MESS_PRICE_RANGES_TITLE'] = $arParams['MESS_PRICE_RANGES_TITLE'] ?: Loc::getMessage('CT_BCE_CATALOG_PRICE_RANGES_TITLE');
$arParams['MESS_DESCRIPTION_TAB'] = $arParams['MESS_DESCRIPTION_TAB'] ?: Loc::getMessage('CT_BCE_CATALOG_DESCRIPTION_TAB');
$arParams['MESS_PROPERTIES_TAB'] = $arParams['MESS_PROPERTIES_TAB'] ?: Loc::getMessage('CT_BCE_CATALOG_PROPERTIES_TAB');
$arParams['MESS_COMMENTS_TAB'] = $arParams['MESS_COMMENTS_TAB'] ?: Loc::getMessage('CT_BCE_CATALOG_COMMENTS_TAB');
$arParams['MESS_SHOW_MAX_QUANTITY'] = $arParams['MESS_SHOW_MAX_QUANTITY'] ?: Loc::getMessage('CT_BCE_CATALOG_SHOW_MAX_QUANTITY');
$arParams['MESS_RELATIVE_QUANTITY_MANY'] = $arParams['MESS_RELATIVE_QUANTITY_MANY'] ?: Loc::getMessage('CT_BCE_CATALOG_RELATIVE_QUANTITY_MANY');
$arParams['MESS_RELATIVE_QUANTITY_FEW'] = $arParams['MESS_RELATIVE_QUANTITY_FEW'] ?: Loc::getMessage('CT_BCE_CATALOG_RELATIVE_QUANTITY_FEW');

$positionClassMap = array(
	'left' => 'product-item-label-left',
	'center' => 'product-item-label-center',
	'right' => 'product-item-label-right',
	'bottom' => 'product-item-label-bottom',
	'middle' => 'product-item-label-middle',
	'top' => 'product-item-label-top'
);

$discountPositionClass = 'product-item-label-big';
if ($arParams['SHOW_DISCOUNT_PERCENT'] === 'Y' && !empty($arParams['DISCOUNT_PERCENT_POSITION']))
{
	foreach (explode('-', $arParams['DISCOUNT_PERCENT_POSITION']) as $pos)
	{
		$discountPositionClass .= isset($positionClassMap[$pos]) ? ' '.$positionClassMap[$pos] : '';
	}
}

$labelPositionClass = 'product-item-label-big';
if (!empty($arParams['LABEL_PROP_POSITION']))
{
	foreach (explode('-', $arParams['LABEL_PROP_POSITION']) as $pos)
	{
		$labelPositionClass .= isset($positionClassMap[$pos]) ? ' '.$positionClassMap[$pos] : '';
	}
}

$arFile = CFile::GetFileArray($arResult['PROPERTIES']['S_DOC']['VALUE']);
?>
<div class="product-air" id="<?=$itemIds['ID']?>">
    <?php if($arResult['DETAIL_PICTURE']['SRC'] || $arResult['PROPERTIES']['S_GALLERY']['VALUE']):?>
	<div class="product-gallary">
	    <div class="product-slider">
			<?php if($arResult['DETAIL_PICTURE']):?>
			<img data-fancybox="images" src="<?=$arResult['DETAIL_PICTURE']['SRC']?>" alt="<?=$arResult['DETAIL_PICTURE']['ALT']?>" width=" 90 " height=" 60 " />
			<?php endif; ?>
			<?php if($arResult['PROPERTIES']['S_GALLERY']):?>
			     <?php foreach($arResult['PROPERTIES']['S_GALLERY']['VALUE'] as $elem):?>
				    <img data-fancybox="images" src="<?= CFile::GetPath($elem) ?>" alt="" width=" 90 " height=" 60 " />
				 <?php endforeach; ?>
			<?php endif; ?>
		</div>
		<div class="product_thumb-slider">
			<?php if($arResult['DETAIL_PICTURE']):?>
			<img src="<?=$arResult['DETAIL_PICTURE']['SRC']?>" alt="<?=$arResult['DETAIL_PICTURE']['ALT']?>" width=" 90 " height=" 60 " />
			<?php endif; ?>
			<?php if($arResult['PROPERTIES']['S_GALLERY']):?>
			     <?php foreach($arResult['PROPERTIES']['S_GALLERY']['VALUE'] as $elem):?>
				    <img src="<?= CFile::GetPath($elem) ?>" alt="" width=" 90 " height=" 60 " />
				 <?php endforeach; ?>
			<?php endif; ?>
		</div>
	</div>
	<?php endif; ?>
	<div class="info-block">
		<div class="product-info">
		    <?php if($arResult['PROPERTIES']['S_MARKA']['VALUE']):?>
			    <div class="type">Марка автомобиля: <span><?=$arResult['PROPERTIES']['S_MARKA']['VALUE'] ?></span></div>
			<?php endif; ?>
			<?php if($arResult['PROPERTIES']['S_CHARACT']['VALUE']):?>
			<div class="type">
				<?=$arResult['PROPERTIES']['S_CHARACT']['DESCRIPTION'] ?>: <span><?=$arResult['PROPERTIES']['S_CHARACT']['VALUE'] ?></span>
			</div>
			<?php endif; ?>
			<?php if($arResult['PROPERTIES']['S_PRIMEN']['VALUE']):?>
			<div class="type">
				Применяемость: <span><?=$arResult['PROPERTIES']['S_PRIMEN']['VALUE'] ?></span>
			</div>
			<?php endif; ?>
			<?php if($arResult['PROPERTIES']['S_FOTO']['VALUE']):?>
			<?php 
			$res = CIBlockSection::GetByID($arResult['PROPERTIES']['S_FOTO']['VALUE']);
			if($ar_res = $res->GetNext())
			  $link = $ar_res['SECTION_PAGE_URL'];
			?>
			<a href="<?= $link ?>">Фотогалерея</a>
			<?php endif; ?>
			<?php if($arResult['PROPERTIES']['S_LINK']['VALUE']):?>
			<a href="<?=$arResult['PROPERTIES']['S_LINK']['VALUE'] ?>"><?=$arResult['PROPERTIES']['S_LINK_TITLE']['VALUE'] ?></a>
			<?php endif; ?>
			<?php if($arFile):?>
			<a href="<?= $arFile['SRC'] ?>" class="dowloand-btn"><img src="<?=SITE_TEMPLATE_PATH?>/images/dowloand.svg" alt="<?= $arFile['ORIGINAL_NAME'] ?>"> <?= $arFile['ORIGINAL_NAME'] ?></a>
			<?php endif; ?>
		</div>		
		<?$APPLICATION->IncludeComponent(
			"interlabs:oneclick",
			".popup",
			Array(
				"AGREE_PROCESSING" => "Y",
				"AJAX_MODE" => "N",
				"AJAX_OPTION_ADDITIONAL" => "",
				"AJAX_OPTION_HISTORY" => "N",
				"AJAX_OPTION_JUMP" => "N",
				"AJAX_OPTION_STYLE" => "Y",
				"BUY_STRATEGY" => "ProductAndBasket",
				"PRODUCT_ID" => $arResult['ID'],
				"USE_CAPTCHA" => "N",
				"USE_FIELD_COMMENT" => "Y",
				"USE_FIELD_EMAIL" => "Y"
			)
		);?>
	</div>
</div>
<div class="tabs">
<?php if($arResult['PROPERTIES']['S_SOSTAV']):?>
	<input type="radio" name="tab-btn" id="tab-btn-1" value="" checked>
	<label for="tab-btn-1">Состав</label>
<?php endif; ?>	
<?php if($arResult['PROPERTIES']['S_CHARACTEST']['VALUE']):?>
	<input type="radio" name="tab-btn" id="tab-btn-2" value="">
	<label for="tab-btn-2">Характеристики</label>
<?php endif; ?>		
<?php if($arResult['PROPERTIES']['S_GARANT']['VALUE']):?>
	<input type="radio" name="tab-btn" id="tab-btn-3" value="">
	<label for="tab-btn-3">Гарантия</label>
<?php endif; ?>		
	<div id="content-1" class="tabs_content_block">
		<div class="layer">
			<table class="blueTable" width="100%">
				<thead>
					<tr>
					    <th>№ </th>
						<th class="table_title_subname">Обозначение </th>
						<th class="table_title_name">Наименование</th>
						<th>Кол-во на 1 маш. комплект
						</th>
						<th>Кол-во на 2 маш. комплект
						</th>
						<th>Кол-во на 3 маш. комплект
						</th>
						<th>Кол-во на 4 маш. комплект
						</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach($arResult['PROPERTIES']['S_SOSTAV']['VALUE'] as $key => $item): $key++;?>
					<? $dbElm = CIBlockElement::GetByID($item); $dbEl = CIBlockElement::GetByID($item); 
					if ($obElm = $dbElm->GetNext()){ 
					    $title = $obElm['NAME'];
						$pict = $obElm['DETAIL_PICTURE'];
					}
					if ($obEl = $dbEl->GetNextElement()){ 				
						$arProps = $obEl->GetProperties();    
					}
					?> 
					<tr>
					    <td><?= $key ?></td>
						<td><?= $title ?></td>
						<td>
						    <img src="<?= CFile::GetPath($pict) ?>" class="resize_thumb" alt="">
							<span><img src="<?= CFile::GetPath($pict) ?>" class="resize_big" alt=""></span>
							<?= $arProps['SOST_NAME']['VALUE'] ?>
						</td>
						<td><?= $arProps['SOST_MASH1']['VALUE'] ?></td>
						<td><?= $arProps['SOST_MASH2']['VALUE'] ?></td>
						<td><?= $arProps['SOST_MASH3']['VALUE'] ?></td>
						<td><?= $arProps['SOST_MASH4']['VALUE'] ?></td>
					</tr>
				<?php endforeach; ?>		
				</tbody>
			</table>
		</div>
	</div>
	<div id="content-2" class="tabs_content_block">
		<div class="layer">
			<div class="type-list">
				<ul>
				<?php foreach($arResult["PROPERTIES"]['S_CHARACTEST']['VALUE'] as $key => $item): ?>
					<li><?= $arResult["PROPERTIES"]['S_CHARACTEST']['DESCRIPTION'][$key]; ?>: <span><?= $item; ?></span></li>
				<?php endforeach; ?>
				</ul>
			</div>
		</div>
	</div>
	<div id="content-3" class="tabs_content_block">
		<div class="content_garant"><?=htmlspecialcharsBack($arResult['PROPERTIES']['S_GARANT']['VALUE']['TEXT'])?></div>
	</div>
</div>
					
<script>
	BX.message({
		ECONOMY_INFO_MESSAGE: '<?=GetMessageJS('CT_BCE_CATALOG_ECONOMY_INFO2')?>',
		TITLE_ERROR: '<?=GetMessageJS('CT_BCE_CATALOG_TITLE_ERROR')?>',
		TITLE_BASKET_PROPS: '<?=GetMessageJS('CT_BCE_CATALOG_TITLE_BASKET_PROPS')?>',
		BASKET_UNKNOWN_ERROR: '<?=GetMessageJS('CT_BCE_CATALOG_BASKET_UNKNOWN_ERROR')?>',
		BTN_SEND_PROPS: '<?=GetMessageJS('CT_BCE_CATALOG_BTN_SEND_PROPS')?>',
		BTN_MESSAGE_BASKET_REDIRECT: '<?=GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_BASKET_REDIRECT')?>',
		BTN_MESSAGE_CLOSE: '<?=GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_CLOSE')?>',
		BTN_MESSAGE_CLOSE_POPUP: '<?=GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_CLOSE_POPUP')?>',
		TITLE_SUCCESSFUL: '<?=GetMessageJS('CT_BCE_CATALOG_ADD_TO_BASKET_OK')?>',
		BTN_MESSAGE_COMPARE_REDIRECT: '<?=GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_COMPARE_REDIRECT')?>',
		PRODUCT_GIFT_LABEL: '<?=GetMessageJS('CT_BCE_CATALOG_PRODUCT_GIFT_LABEL')?>',
		PRICE_TOTAL_PREFIX: '<?=GetMessageJS('CT_BCE_CATALOG_MESS_PRICE_TOTAL_PREFIX')?>',
		RELATIVE_QUANTITY_MANY: '<?=CUtil::JSEscape($arParams['MESS_RELATIVE_QUANTITY_MANY'])?>',
		RELATIVE_QUANTITY_FEW: '<?=CUtil::JSEscape($arParams['MESS_RELATIVE_QUANTITY_FEW'])?>',
		SITE_ID: '<?=CUtil::JSEscape($component->getSiteId())?>'
	});

	var <?=$obName?> = new JCCatalogElement(<?=CUtil::PhpToJSObject($jsParams, false, true)?>);
</script>
<?
unset($actualItem, $itemIds, $jsParams);