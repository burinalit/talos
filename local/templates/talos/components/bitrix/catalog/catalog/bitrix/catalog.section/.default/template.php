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
/** @unique code EMARKET_BRAND */
/** @unique code EMARKET_SKU_COLOR */
/** @default CATALOG_COMPARE_LIST */
//echo '<pre>'; print_r($arParams); echo '</pre>';
//echo '<pre>'; print_r($_SESSION); echo '</pre>';

$this->setFrameMode(true);

if (!empty($arResult['ITEMS'])){

CJSCore::Init(array("popup"));
$arSkuTemplate = array();
if (!empty($arResult['SKU_PROPS']))
{
	foreach ($arResult['SKU_PROPS'] as &$arProp)
	{
		
		ob_start();
		if ('TEXT' == $arProp['SHOW_MODE'])
		{
			if (5 < $arProp['VALUES_COUNT'])
			{
				$strClass = 'bx_item_detail_size full';
				$strWidth = ($arProp['VALUES_COUNT']*20).'%';
				$strOneWidth = (100/$arProp['VALUES_COUNT']).'%';
				$strSlideStyle = '';
			}
			else
			{
				$strClass = 'bx_item_detail_size';
				$strWidth = '100%';
				$strOneWidth = '20%';
				$strSlideStyle = 'display: none;';
			}
			?>			
			<div class="<? echo $strClass; ?>" id="#ITEM#_prop_<? echo $arProp['ID']; ?>_cont">
				<span class="bx_item_section_name_gray"><? echo htmlspecialcharsex($arProp['NAME']); ?></span>
				<div class="bx_size_scroller_container">
					<div class="bx_size">
						<ul id="#ITEM#_prop_<? echo $arProp['ID']; ?>_list" style="width: <? echo $strWidth; ?>;">
							<?foreach ($arProp['VALUES'] as $arOneValue) {?>
								<li
									data-treevalue="<? echo $arProp['ID'].'_'.$arOneValue['ID']; ?>"
									data-onevalue="<? echo $arOneValue['ID']; ?>"
									style="width: <? echo $strOneWidth; ?>;"
								>
									<i></i>
									<span class="cnt"><? echo htmlspecialcharsex($arOneValue['NAME']); ?></span>
								</li>
							<?}?>
						</ul>
					</div>
					<div class="bx_slide_left" id="#ITEM#_prop_<? echo $arProp['ID']; ?>_left" data-treevalue="<? echo $arProp['ID']; ?>" style="<? echo $strSlideStyle; ?>"></div>
					<div class="bx_slide_right" id="#ITEM#_prop_<? echo $arProp['ID']; ?>_right" data-treevalue="<? echo $arProp['ID']; ?>" style="<? echo $strSlideStyle; ?>"></div>
				</div>
			</div>
		<?
		}
		elseif ('PICT' == $arProp['SHOW_MODE'])
		{
			if (5 < $arProp['VALUES_COUNT'])
			{
				$strClass = 'bx_item_detail_scu full';
				$strWidth = ($arProp['VALUES_COUNT']*20).'%';
				$strOneWidth = (100/$arProp['VALUES_COUNT']).'%';
				$strSlideStyle = '';
			}
			else
			{
				$strClass = 'bx_item_detail_scu';
				$strWidth = '100%';
				$strOneWidth = '20%';
				$strSlideStyle = 'display: none;';
			}
			?>
			<div class="<? echo $strClass; ?>" id="#ITEM#_prop_<? echo $arProp['ID']; ?>_cont">
				<?if('EMARKET_SKU_COLOR' != $arProp['CODE']){?>
				<span class="bx_item_section_name_gray"><? echo htmlspecialcharsex($arProp['NAME']); ?></span>
				<?}?>
				<div class="bx_scu_scroller_container">
					<div class="bx_scu">
						<ul id="#ITEM#_prop_<? echo $arProp['ID']; ?>_list" style="width: <? echo $strWidth; ?>;">
						<?foreach ($arProp['VALUES'] as $arOneValue) {?>
							<li
								data-treevalue="<? echo $arProp['ID'].'_'.$arOneValue['ID'] ?>"
								data-onevalue="<? echo $arOneValue['ID']; ?>"
								style="width: <? echo $strOneWidth; ?>; padding-top: <? echo $strOneWidth; ?>;"
								>
								
								<i title="<? echo htmlspecialcharsbx($arOneValue['NAME']); ?>"></i>
								<span class="cnt">
									<span class="cnt_item"
										style="background-image:url('<? echo $arOneValue['PICT']['SRC']; ?>');"
										title="<? echo htmlspecialcharsbx($arOneValue['NAME']); ?>"
									></span>
								</span>
							</li>
						<?}?>
						</ul>
					</div>
					<div class="bx_slide_left" id="#ITEM#_prop_<? echo $arProp['ID']; ?>_left" data-treevalue="<? echo $arProp['ID']; ?>" style="<? echo $strSlideStyle; ?>"></div>
					<div class="bx_slide_right" id="#ITEM#_prop_<? echo $arProp['ID']; ?>_right" data-treevalue="<? echo $arProp['ID']; ?>" style="<? echo $strSlideStyle; ?>"></div>
				</div>
			</div>
			<?
		}
		$arSkuTemplate[$arProp['CODE']] = ob_get_contents();
		ob_end_clean();
	}
	unset($arProp);
}

//navigation
if ($arParams["DISPLAY_TOP_PAGER"]) echo $arResult["NAV_STRING"]; ?>
<div class="catalog_list_category items_card">
	<? foreach ($arResult['ITEMS'] as $key => $arItem):
		$strMainID = $this->GetEditAreaId($arItem['ID']);

		$arItemIDs = array(
			'ID' => $strMainID,
			'PICT' => $strMainID.'_pict',
			'SECOND_PICT' => $strMainID.'_secondpict',

			'QUANTITY' => $strMainID.'_quantity',
			'QUANTITY_DOWN' => $strMainID.'_quant_down',
			'QUANTITY_UP' => $strMainID.'_quant_up',
			'QUANTITY_MEASURE' => $strMainID.'_quant_measure',
			'BUY_LINK' => $strMainID.'_buy_link',
			'SUBSCRIBE_LINK' => $strMainID.'_subscribe',

			'PRICE' => $strMainID.'_price',
			'DSC_PERC' => $strMainID.'_dsc_perc',
			'SECOND_DSC_PERC' => $strMainID.'_second_dsc_perc',

			'PROP_DIV' => $strMainID.'_sku_tree',
			'PROP' => $strMainID.'_prop_',
			'DISPLAY_PROP_DIV' => $strMainID.'_sku_prop',
			'BASKET_PROP_DIV' => $strMainID.'_basket_prop',
		);

		$strObName = 'ob'.preg_replace("/[^a-zA-Z0-9_]/", "x", $strMainID);

		$strTitle = (
			isset($arItem["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_TITLE"]) && '' != isset($arItem["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_TITLE"])
			? $arItem["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_TITLE"]
			: $arItem['NAME']
		);
		?>
		<div class="item <? echo ($arItem['SECOND_PICT'] ? 'bx_catalog_item double' : 'bx_catalog_item'); ?>">
			<div class="item_content" id="<? echo $strMainID; ?>" data-elemid="<? echo $strMainID; ?>" >
			    <a href="<? echo $arItem['DETAIL_PAGE_URL']; ?>" class="button_item">
				    <div class="btn btn_card">
					    <span class="text">Заказать</span><span class="plus">+</span>
					</div>
				</a>
				<div class="slider_item">
				<?php if(empty($arItem['PROPERTIES']['MORE_PHOTO'])): ?>
				    <div class="product_img" style="background-image: url(<? echo $arItem['PREVIEW_PICTURE']['SRC']; ?>)"
						 title="<? echo $strTitle; ?>">                                            
					</div>
				<?php else: ?>
				    <div class="product_slider">
					    <div class="product_img" style="background-image: url(<? echo $arItem['PREVIEW_PICTURE']['SRC']; ?>)"></div>
						<? foreach($arItem['PROPERTIES']['MORE_PHOTO']['VALUE'] as $key => $image): 
						    if($key >=0 && $key <= 2): ?>
						    <div class="product_img" style="background-image: url(<?= CFile::GetPath($image)?>)"></div>
						<? endif; endforeach; ?>
					</div>
				<?php endif; ?>
				</div>
				<div class="title_sect_item">
					<h3 class="title_item" title="<? echo $arItem['NAME']; ?>"><? echo $arItem['PROPERTIES']['MODEL']['VALUE']; ?></h3> 
					<div class="subtitle_item"><? echo $arItem['NAME']; ?> <? echo $arItem['PROPERTIES']['CASE_SERIOS']['VALUE']; ?></div>
				</div>
				<div class="params_item">
					<div class="title_params_item">Внутренние габариты (ДхШхВ)</div>
					<div class="params_item_elems"><? echo $arItem['PROPERTIES']['CASE_VN_DLINA']['VALUE']; ?>x<? echo $arItem['PROPERTIES']['CASE_VN_SHIR']['VALUE']; ?>x<? echo $arItem['PROPERTIES']['CASE_VN_VUS']['VALUE']; ?></div>
				</div>	
				<?php if (isset($arItem['OFFERS']) || !empty($arItem['OFFERS'])) {?>
					<? $boolShowOfferProps = ('Y' == $arParams['PRODUCT_DISPLAY_MODE'] && $arItem['OFFERS_PROPS_DISPLAY']);
					$boolShowProductProps = (isset($arItem['DISPLAY_PROPERTIES']) && !empty($arItem['DISPLAY_PROPERTIES']));
					 if ($boolShowProductProps || $boolShowOfferProps){?>
						<div class="bx_catalog_item_articul">
						<? if ($boolShowProductProps){
							foreach ($arItem['DISPLAY_PROPERTIES'] as $arOneProp){
								foreach($arOneProp['VALUE_XML_ID'] as $elem): ?>
									<span class="color <?= $elem ?>"><?= $elem ?></span>
							<?php endforeach; 
							}
						}
						?>
						<?if ($boolShowOfferProps) {?>
							<span id="<? echo $arItemIDs['DISPLAY_PROP_DIV']; ?>" style="display: none;"></span>
						<?}?>
						</div>
					<? }
				}?>
			</div>
		</div>
	<?php endforeach; ?>
</div>

<script type="text/javascript">
	BX.message({
		MESS_BTN_BUY: '<? echo ('' != $arParams['MESS_BTN_BUY'] ? CUtil::JSEscape($arParams['MESS_BTN_BUY']) : GetMessageJS('CT_BCS_TPL_MESS_BTN_BUY')); ?>',
		MESS_BTN_ADD_TO_BASKET: '<? echo ('' != $arParams['MESS_BTN_ADD_TO_BASKET'] ? CUtil::JSEscape($arParams['MESS_BTN_ADD_TO_BASKET']) : GetMessageJS('CT_BCS_TPL_MESS_BTN_ADD_TO_BASKET')); ?>',
		MESS_NOT_AVAILABLE: '<? echo ('' != $arParams['MESS_NOT_AVAILABLE'] ? CUtil::JSEscape($arParams['MESS_NOT_AVAILABLE']) : GetMessageJS('CT_BCS_TPL_MESS_PRODUCT_NOT_AVAILABLE')); ?>',
		BTN_MESSAGE_BASKET_REDIRECT: '<? echo GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_BASKET_REDIRECT'); ?>',
		BASKET_URL: '<? echo $arParams["BASKET_URL"]; ?>',
		ADD_TO_BASKET_OK: '<? echo GetMessageJS('ADD_TO_BASKET_OK'); ?>',
		TITLE_ERROR: '<? echo GetMessageJS('CT_BCS_CATALOG_TITLE_ERROR') ?>',
		TITLE_BASKET_PROPS: '<? echo GetMessageJS('CT_BCS_CATALOG_TITLE_BASKET_PROPS') ?>',
		TITLE_SUCCESSFUL: '<? echo GetMessageJS('ADD_TO_BASKET_OK'); ?>',
		BASKET_UNKNOWN_ERROR: '<? echo GetMessageJS('CT_BCS_CATALOG_BASKET_UNKNOWN_ERROR') ?>',
		BTN_MESSAGE_SEND_PROPS: '<? echo GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_SEND_PROPS'); ?>',
		BTN_MESSAGE_CLOSE: '<? echo GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_CLOSE') ?>'
	});
</script>
<script>
	$( ".bx_catalog_item" ).each(function( index ) {
		var elem = $(this).children('.item_content').data('elemid');
		$('#'+elem+' .slider_item .product_slider').slick({
		  infinite: true,
		  arrows: false,
		  fade: false,
		  dots: true,
		  autoplay: false,
		  speed: 800,
		  slidesToShow: 1,
		  slidesToScroll: 1
		});
	});
</script>
<?//navigation
if ($arParams["DISPLAY_BOTTOM_PAGER"]) echo $arResult["NAV_STRING"];?>

<?
}
else
{
    ?>
    <div class="filter_empty">
        <?=GetMessage("NO_PROD")?>
    </div>
    <?
}
?>