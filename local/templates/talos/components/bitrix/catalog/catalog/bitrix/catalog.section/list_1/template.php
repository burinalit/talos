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
if (!empty($arResult['ITEMS']))
{

$templateData = array(
	'TEMPLATE_CLASS' => 'bx_'.$arParams['TEMPLATE_THEME']
);

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
if ($arParams["DISPLAY_TOP_PAGER"]) echo $arResult["NAV_STRING"];

$strElementEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT");
$strElementDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE");
$arElementDeleteParams = array("CONFIRM" => GetMessage('CT_BCS_TPL_ELEMENT_DELETE_CONFIRM'));
?>

<?if($arParams['DISPLAY_COMPARE']){?>
	<input id="this_list" type="hidden" value="<?=$arParams['COMPARE_NAME']?>">
<?}?>

<div class="catalog_list_home <? echo $templateData['TEMPLATE_CLASS']; ?>">

	<?
	foreach ($arResult['ITEMS'] as $key => $arItem)
	{
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], $strElementEdit);
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], $strElementDelete, $arElementDeleteParams);
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
		
		//wrap items
		if(	$arItem['PROPERTIES']['EMARKET_BRAND']['VALUE'] != $temp &&
			$arResult['BRANDS'][$arItem['PROPERTIES']['EMARKET_BRAND']['VALUE']]['UF_NAME'])
		{
			if($temp) echo '</div><div style="clear:both;"></div></div>';
			?>
			<div class="item-brand">
                            <div class="title">
				<h2><?=$arResult['BRANDS'][$arItem['DISPLAY_PROPERTIES']['EMARKET_BRAND']['VALUE']]['UF_NAME']?></h2>
                            </div>    
				<div class="item-list_list">
			<?
			$temp = $arItem['DISPLAY_PROPERTIES']['EMARKET_BRAND']['VALUE'];
		}
		?>
		
		<div class="item" id="<? echo $strMainID; ?>">
                    <div class="item_list_img_hidden">
                        <div class="img" style="background-image: url(<? echo $arItem['DETAIL_PICTURE']['SRC']; ?>)">
                        </div>
                        <div class="triangle"></div>
                    </div>
                            <a href="<? echo $arItem['DETAIL_PAGE_URL']; ?>">
			
				<?//PICTURE?>
                                <div class="col-md-2 col-xs-4">
                                    <div class="product_img" style="background-image: url(<? echo $arItem['DETAIL_PICTURE']['SRC']; ?>)"
                                         title="<? echo $strTitle; ?>">                                            
                                    </div>  
                                </div>
				
				<?//SECOND PICTURE?>
				<?if ($arItem['SECOND_PICT']){?>
					<!-- <a id="<? echo $arItemIDs['SECOND_PICT']; ?>"
						href="<? echo $arItem['DETAIL_PAGE_URL']; ?>"
						class="bx_catalog_item_images_double"
						style="background-image: url(<? echo (
							!empty($arItem['PREVIEW_PICTURE_SECOND'])
							? $arItem['PREVIEW_PICTURE_SECOND']['SRC']
							: $arItem['PREVIEW_PICTURE']['SRC']); ?>)"
						title="<? echo $strTitle; ?>">
					<?if ($arItem['LABEL']){?>
						<div class="bx_stick average left top" title="<? echo $arItem['LABEL_VALUE']; ?>"><? echo $arItem['LABEL_VALUE']; ?></div>
					<?}?>
					</a> !-->
				<?}?>
				
                                <?//NAME?>
                                    <div class="col-md-5 col-xs-8">
					<h3 title="<? echo $arItem['NAME']; ?>"><? echo $arItem['NAME']; ?>
                                        <span><? echo $arItem['PROPERTIES']['EMARKET_PREVIEW_CH']['VALUE']; ?></span>
                                        </h3>
                                    </div>
                                <div class="hidden_clear_both"></div>
                                <?//PRICE?>
				<div class="col-md-2">
					<div id="<? echo $arItemIDs['PRICE']; ?>" class="price"><?
					if (!empty($arItem['MIN_PRICE']))
					{
						if ('N' == $arParams['PRODUCT_DISPLAY_MODE'] && isset($arItem['OFFERS']) && !empty($arItem['OFFERS']))
						{
							echo GetMessage(
								'CT_BCS_TPL_MESS_PRICE_SIMPLE_MODE',
								array(
									'#PRICE#' => $arItem['MIN_PRICE']['PRINT_DISCOUNT_VALUE'],
									'#MEASURE#' => GetMessage(
										'CT_BCS_TPL_MESS_MEASURE_SIMPLE_MODE',
										array(
											'#VALUE#' => $arItem['MIN_PRICE']['CATALOG_MEASURE_RATIO'],
											'#UNIT#' => $arItem['MIN_PRICE']['CATALOG_MEASURE_NAME']
										)
									)
								)
							);
						}
						else
						{
							echo $arItem['MIN_PRICE']['PRINT_DISCOUNT_VALUE'];
						}
						if ('Y' == $arParams['SHOW_OLD_PRICE'] && $arItem['MIN_PRICE']['DISCOUNT_VALUE'] < $arItem['MIN_PRICE']['VALUE'])
						{
							?> <span><? echo $arItem['MIN_PRICE']['PRINT_VALUE']; ?></span><?
						}
					}
					?>
					</div>
					<?if ('Y' == $arParams['SHOW_DISCOUNT_PERCENT']) {?>
						<div id="<? echo $arItemIDs['DSC_PERC']; ?>"
							class="bx_stick_disc right bottom"
							style="display:<? echo (0 < $arItem['MIN_PRICE']['DISCOUNT_DIFF_PERCENT'] ? '' : 'none'); ?>;">-<? echo $arItem['MIN_PRICE']['DISCOUNT_DIFF_PERCENT']; ?>%</div>

						<div id="<? echo $arItemIDs['SECOND_DSC_PERC']; ?>"
							class="bx_stick_disc right bottom"
							style="display:<? echo (0 < $arItem['MIN_PRICE']['DISCOUNT_DIFF_PERCENT'] ? '' : 'none'); ?>;">-<? echo $arItem['MIN_PRICE']['DISCOUNT_DIFF_PERCENT']; ?>%</div>
					<?}?>
				</div>                        
                                                        
                                <?//RATING?>
                                <div class="col-md-2">
                                    <div class="rating">
                                            <?	
                                            $rating = intval($arItem['PROPERTIES']['EMARKET_RATING']['VALUE']);
                                            for($i=1; $i<=10; $i++)
                                            {
                                                    if(($i == $rating) && ($i%2)) 
                                                    {
                                                            echo '<div class="star half"></div>';
                                                            $i++;
                                                            continue;
                                                    }
                                                    if(!($i%2))
                                                    {
                                                            if($i < $rating)
                                                            {
                                                                    echo '<div class="star"></div>';
                                                            }
                                                            elseif($i == $rating)
                                                            {
                                                                    echo '<div class="star"></div>';
                                                            }
                                                            elseif($i > $rating)
                                                            {
                                                                    echo '<div class="star empty"></div>';
                                                            }
                                                    }
                                            }
                                            ?>
                                    </div>
                                </div>
				

			
				
				<?//OFFERS
				if (!isset($arItem['OFFERS']) || empty($arItem['OFFERS'])) {?>
				
					<?if (isset($arItem['DISPLAY_PROPERTIES']) && !empty($arItem['DISPLAY_PROPERTIES'])){?>
						<div class="bx_catalog_item_articul">
						<?
						foreach ($arItem['DISPLAY_PROPERTIES'] as $arOneProp)
						{
							if('EMARKET_BRAND' == $arOneProp['CODE']) continue;
							?><br><strong><? echo $arOneProp['NAME']; ?></strong> <?
							echo (
								is_array($arOneProp['DISPLAY_VALUE'])
								? implode('<br>', $arOneProp['DISPLAY_VALUE'])
								: $arOneProp['DISPLAY_VALUE']
							);
						}
						?>
						</div>
					<?}?>
					
					<?
					$emptyProductProperties = empty($arItem['PRODUCT_PROPERTIES']);
					if ('Y' == $arParams['ADD_PROPERTIES_TO_BASKET'] && !$emptyProductProperties)
					{
					?>
						<div id="<? echo $arItemIDs['BASKET_PROP_DIV']; ?>" style="display: none;">
							<?
							if (!empty($arItem['PRODUCT_PROPERTIES_FILL']))
							{
								foreach ($arItem['PRODUCT_PROPERTIES_FILL'] as $propID => $propInfo)
								{?>
									<input
										type="hidden"
										name="<? echo $arParams['PRODUCT_PROPS_VARIABLE']; ?>[<? echo $propID; ?>]"
										value="<? echo htmlspecialcharsbx($propInfo['ID']); ?>"
										>
								<?
									if (isset($arItem['PRODUCT_PROPERTIES'][$propID]))
										unset($arItem['PRODUCT_PROPERTIES'][$propID]);
								}
							}
							$emptyProductProperties = empty($arItem['PRODUCT_PROPERTIES']);
							if (!$emptyProductProperties)
							{
							?>
								<table>
									<?foreach ($arItem['PRODUCT_PROPERTIES'] as $propID => $propInfo) {?>
										<tr>
											<td><? echo $arItem['PROPERTIES'][$propID]['NAME']; ?></td>
											<td><?
												if(
													'L' == $arItem['PROPERTIES'][$propID]['PROPERTY_TYPE']
													&& 'C' == $arItem['PROPERTIES'][$propID]['LIST_TYPE']
												)
												{
													foreach($propInfo['VALUES'] as $valueID => $value)
													{
														?>
														<label>
															<input
																type="radio"
																name="<? echo $arParams['PRODUCT_PROPS_VARIABLE']; ?>[<? echo $propID; ?>]"
																value="<? echo $valueID; ?>"
																<? echo ($valueID == $propInfo['SELECTED'] ? '"checked"' : ''); ?>
															><? echo $value; ?>
														</label><br><?
													}
												}
												else
												{
													?>
													<select name="<? echo $arParams['PRODUCT_PROPS_VARIABLE']; ?>[<? echo $propID; ?>]">
													<?
														foreach($propInfo['VALUES'] as $valueID => $value)
														{
															?>
															<option
															value="<? echo $valueID; ?>"
															<? echo ($valueID == $propInfo['SELECTED'] ? '"selected"' : ''); ?>
															><? echo $value; ?></option><?
														}
													?>
													</select>
													<?
												}?>
											</td>
										</tr>
									<?}?>
								</table>
							<?}?>
						</div>
					<?}?>
					
					 <div class="compare-control_list col-xs-1">
                                            <div class="controls-wrap">										
						<input id="compare_<?=$arItem['ID']?>" 
                                                    class="compare-control-input" 
                                                    type="checkbox" 
                                                    
                                                    data-id="<?=$arItem['ID']?>"
                                                    title="<?=GetMessage('CT_BCS_TPL_MESS_BTN_COMPARE')?>">
                                                                                
						<label class="mdi mdi-poll" for="compare_<?=$arItem['ID']?>" title="<?=GetMessage('CT_BCS_TPL_MESS_BTN_COMPARE')?>"></label> 								
                                            </div>														
							
						
						<div style="clear: both;"></div>
					</div> 
					
					<?
					$arJSParams = array(
						'PRODUCT_TYPE' => $arItem['CATALOG_TYPE'],
						'SHOW_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
						'SHOW_ADD_BASKET_BTN' => false,
						'SHOW_BUY_BTN' => true,
						'SHOW_ABSENT' => true,
						'PRODUCT' => array(
							'ID' => $arItem['ID'],
							'NAME' => $arItem['~NAME'],
							'PICT' => ('Y' == $arItem['SECOND_PICT'] ? $arItem['PREVIEW_PICTURE_SECOND'] : $arItem['PREVIEW_PICTURE']),
							'CAN_BUY' => $arItem["CAN_BUY"],
							'SUBSCRIPTION' => ('Y' == $arItem['CATALOG_SUBSCRIPTION']),
							'CHECK_QUANTITY' => $arItem['CHECK_QUANTITY'],
							'MAX_QUANTITY' => $arItem['CATALOG_QUANTITY'],
							'STEP_QUANTITY' => $arItem['CATALOG_MEASURE_RATIO'],
							'QUANTITY_FLOAT' => is_double($arItem['CATALOG_MEASURE_RATIO']),
							'ADD_URL' => $arItem['~ADD_URL'],
							'SUBSCRIBE_URL' => $arItem['~SUBSCRIBE_URL']
						),
						'BASKET' => array(
							'ADD_PROPS' => ('Y' == $arParams['ADD_PROPERTIES_TO_BASKET']),
							'QUANTITY' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
							'PROPS' => $arParams['PRODUCT_PROPS_VARIABLE'],
							'EMPTY_PROPS' => $emptyProductProperties
						),
						'VISUAL' => array(
							'ID' => $arItemIDs['ID'],
							'PICT_ID' => ('Y' == $arItem['SECOND_PICT'] ? $arItemIDs['SECOND_PICT'] : $arItemIDs['PICT']),
							'QUANTITY_ID' => $arItemIDs['QUANTITY'],
							'QUANTITY_UP_ID' => $arItemIDs['QUANTITY_UP'],
							'QUANTITY_DOWN_ID' => $arItemIDs['QUANTITY_DOWN'],
							'PRICE_ID' => $arItemIDs['PRICE'],
							'BUY_ID' => $arItemIDs['BUY_LINK'],
							'BASKET_PROP_DIV' => $arItemIDs['BASKET_PROP_DIV']
						),
						'LAST_ELEMENT' => $arItem['LAST_ELEMENT']
					);
					unset($emptyProductProperties);
					?>
					<script type="text/javascript">
						var <? echo $strObName; ?> = new JCCatalogSection(<? echo CUtil::PhpToJSObject($arJSParams, false, true); ?>);
					</script>
				<?} else { //OFFERS START?>

					<?
					$boolShowOfferProps = ('Y' == $arParams['PRODUCT_DISPLAY_MODE'] && $arItem['OFFERS_PROPS_DISPLAY']);
					$boolShowProductProps = (isset($arItem['DISPLAY_PROPERTIES']) && !empty($arItem['DISPLAY_PROPERTIES']));
					
					if ($boolShowProductProps || $boolShowOfferProps)
					{?>
						<div class="bx_catalog_item_articul">
						<?
						if ($boolShowProductProps)
						{
							foreach ($arItem['DISPLAY_PROPERTIES'] as $arOneProp)
							{
								if('EMARKET_BRAND' == $arOneProp['CODE']) continue;
								?><br><strong><? echo $arOneProp['NAME']; ?></strong> <?
								echo (
									is_array($arOneProp['DISPLAY_VALUE'])
									? implode(' / ', $arOneProp['DISPLAY_VALUE'])
									: $arOneProp['DISPLAY_VALUE']
								);
							}
						}
						?>
						
						<?if ($boolShowOfferProps) {?>
							<span id="<? echo $arItemIDs['DISPLAY_PROP_DIV']; ?>" style="display: none;"></span>
						<?}?>
						</div>
					<?
					}
					if ('Y' == $arParams['PRODUCT_DISPLAY_MODE'])
					{
						if (!empty($arItem['OFFERS_PROP']))
						{
							$arSkuProps = array();
							?>

							<?
							if ($arItem['OFFERS_PROPS_DISPLAY'])
							{
								foreach ($arItem['JS_OFFERS'] as $keyOffer => $arJSOffer)
								{
									$strProps = '';
									if (!empty($arJSOffer['DISPLAY_PROPERTIES']))
									{
										foreach ($arJSOffer['DISPLAY_PROPERTIES'] as $arOneProp)
										{
											$strProps .= '<br>'.$arOneProp['NAME'].' <strong>'.(
												is_array($arOneProp['VALUE'])
												? implode(' / ', $arOneProp['VALUE'])
												: $arOneProp['VALUE']
											).'</strong>';
										}
									}
									$arItem['JS_OFFERS'][$keyOffer]['DISPLAY_PROPERTIES'] = $strProps;
								}
							}
							$arJSParams = array(
								'PRODUCT_TYPE' => $arItem['CATALOG_TYPE'],
								'SHOW_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
								'SHOW_ADD_BASKET_BTN' => false,
								'SHOW_BUY_BTN' => true,
								'SHOW_ABSENT' => true,
								'SHOW_SKU_PROPS' => $arItem['OFFERS_PROPS_DISPLAY'],
								'SECOND_PICT' => $arItem['SECOND_PICT'],
								'SHOW_OLD_PRICE' => ('Y' == $arParams['SHOW_OLD_PRICE']),
								'SHOW_DISCOUNT_PERCENT' => ('Y' == $arParams['SHOW_DISCOUNT_PERCENT']),
								'DEFAULT_PICTURE' => array(
									'PICTURE' => $arItem['PRODUCT_PREVIEW'],
									'PICTURE_SECOND' => $arItem['PRODUCT_PREVIEW_SECOND']
								),
								'VISUAL' => array(
									'ID' => $arItemIDs['ID'],
									'PICT_ID' => $arItemIDs['PICT'],
									'SECOND_PICT_ID' => $arItemIDs['SECOND_PICT'],
									'QUANTITY_ID' => $arItemIDs['QUANTITY'],
									'QUANTITY_UP_ID' => $arItemIDs['QUANTITY_UP'],
									'QUANTITY_DOWN_ID' => $arItemIDs['QUANTITY_DOWN'],
									'QUANTITY_MEASURE' => $arItemIDs['QUANTITY_MEASURE'],
									'PRICE_ID' => $arItemIDs['PRICE'],
									'TREE_ID' => $arItemIDs['PROP_DIV'],
									'TREE_ITEM_ID' => $arItemIDs['PROP'],
									'BUY_ID' => $arItemIDs['BUY_LINK'],
									'ADD_BASKET_ID' => $arItemIDs['ADD_BASKET_ID'],
									'DSC_PERC' => $arItemIDs['DSC_PERC'],
									'SECOND_DSC_PERC' => $arItemIDs['SECOND_DSC_PERC'],
									'DISPLAY_PROP_DIV' => $arItemIDs['DISPLAY_PROP_DIV'],
								),
								'BASKET' => array(
									'QUANTITY' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
									'PROPS' => $arParams['PRODUCT_PROPS_VARIABLE'],
									'SKU_PROPS' => $arItem['OFFERS_PROP_CODES']
								),
								'PRODUCT' => array(
									'ID' => $arItem['ID'],
									'NAME' => $arItem['~NAME']
								),
								'OFFERS' => $arItem['JS_OFFERS'],
								'OFFER_SELECTED' => $arItem['OFFERS_SELECTED'],
								'TREE_PROPS' => $arSkuProps,
								'LAST_ELEMENT' => $arItem['LAST_ELEMENT']
							);

						}
					}
					?>
					<div class="compare-control_list col-xs-1">
                                            <div class="controls-wrap">										
						<input id="compare_<?=$arItem['ID']?>" 
                                                    class="compare-control-input" 
                                                    type="checkbox" 
                                                    
                                                    data-id="<?=$arItem['ID']?>"
                                                    title="<?=GetMessage('CT_BCS_TPL_MESS_BTN_COMPARE')?>">
                                                                                
						<label class="mdi mdi-poll" for="compare_<?=$arItem['ID']?>" title="<?=GetMessage('CT_BCS_TPL_MESS_BTN_COMPARE')?>"></label> 								
                                            </div>														
							
						
						<div style="clear: both;"></div>
					</div>
					
					<?if(('Y' == $arParams['PRODUCT_DISPLAY_MODE']) && !empty($arItem['OFFERS_PROP'])) {?>
						<script type="text/javascript">
							var <? echo $strObName; ?> = new JCCatalogSection(<? echo CUtil::PhpToJSObject($arJSParams, false, true); ?>);
						</script>
					<?}
				}?>
                            </a>
                        <div class="clear_both"></div>
                        
                <?if (0 < $arItem['MIN_PRICE']['DISCOUNT_DIFF']):?>
                    <div class="product_sale right"> <?=GetMessage("SALE")?>
                    </div>
                <?endif;?>                         
                        
                <?if(!empty($arItem["PROPERTIES"]["EMARKET_NEW"]["VALUE"])):?>                
                    <div class="product_new right"> <?=GetMessage("NEW")?>                    
                    </div>
                <?endif;?>
                <?if(!empty($arItem["PROPERTIES"]["EMARKET_HIT"]["VALUE"])):?>                
                    <div class="product_hit right"> <?=GetMessage("HIT")?>                    
                    </div>
                <?endif;?>
			</div>
                                    

	<?
	}
	?>
	<?if($temp){?>
		</div><div style="clear:both;"></div></div>
	<?}else{?>
		<div style="clear:both;"></div>
	<?}?>
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
<?//navigation
if ($arParams["DISPLAY_BOTTOM_PAGER"]) echo $arResult["NAV_STRING"];?>

<?
}
else
{
    ?>
    <div class="filter_empty">
         <div class="filter_empty">
			<?=GetMessage("NO_PROD")?>
		</div>
    </div>
    <?
}
?>
