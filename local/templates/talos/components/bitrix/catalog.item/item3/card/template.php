<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $item
 * @var array $actualItem
 * @var array $minOffer
 * @var array $itemIds
 * @var array $price
 * @var array $measureRatio
 * @var bool $haveOffers
 * @var bool $showSubscribe
 * @var array $morePhoto
 * @var bool $showSlider
 * @var bool $itemHasDetailUrl
 * @var string $imgTitle
 * @var string $productTitle
 * @var string $buttonSizeClass
 * @var CatalogSectionComponent $component
 */
?>
<a class="product-item-image-wrapper" href="<?=$item['DETAIL_PAGE_URL']?>" title="<?=$imgTitle?>" data-entity="image-wrapper">
    <img src="<?=$item['PREVIEW_PICTURE']['SRC']?>" alt="<?=$imgTitle?>" />
</a>
<div class="product-item-content">
<div class="product-item-title"><a href="<?=$item['DETAIL_PAGE_URL']?>" title="<?=$productTitle?>"><?=$productTitle?></a></div>
<? if (!empty($arParams['PRODUCT_BLOCKS_ORDER'])){
	foreach ($arParams['PRODUCT_BLOCKS_ORDER'] as $blockName){
		switch ($blockName){
			case 'props':
				if (!$haveOffers){
					if (!empty($item['DISPLAY_PROPERTIES'])){ ?>
						<div class="product-item-info" data-entity="props-block">
						<? foreach ($item['DISPLAY_PROPERTIES'] as $code => $displayProperty){ 
						    $arSection = CIBlockSection::GetByID($item['IBLOCK_SECTION_ID'])->Fetch();
						    $category = $arSection['IBLOCK_SECTION_ID'];
						    if($category == 7){
								if($displayProperty['CODE'] != 'K_MAIN_MMOSCH' && $displayProperty['CODE'] != 'K_MAIN_NAPR' && $displayProperty['CODE'] != 'K_MAIN_SILAT' && $displayProperty['CODE'] != 'K_MAIN_OBBAZ'){
									continue;
								}
							}
							if($category == 9){
								if($displayProperty['CODE'] != 'K_MAIN_MMOSCH_DVIG' && $displayProperty['CODE'] != 'K_MAIN_MAXPROIZ' && $displayProperty['CODE'] != 'K_MAIN_DIAMPAR' && $displayProperty['CODE'] != 'K_MAIN_OBBAZ'){
									continue;
								}
							}
						?>
						<p class="product_props_row">
							<span class="product_props_name">
								<?=$displayProperty['NAME']?>
							</span>
							<span class="product_props_value">
								<?=(is_array($displayProperty['DISPLAY_VALUE'])
									? implode(' / ', $displayProperty['DISPLAY_VALUE'])
									: $displayProperty['DISPLAY_VALUE'])?>
							</span>
						</p>	
						<? } ?>
						<p class="product_props_row">
							<span class="product_props_name">Масса, кг</span>
							<span class="product_props_value"><?= $item['PRODUCT']['WEIGHT']?></span>
						</p>
						</div>
					<? } ?>
					
					<?php if ($arParams['ADD_PROPERTIES_TO_BASKET'] === 'Y' && !empty($item['PRODUCT_PROPERTIES'])){ ?>
						<div id="<?=$itemIds['BASKET_PROP_DIV']?>" style="display: none;">
							<?
							if (!empty($item['PRODUCT_PROPERTIES_FILL']))
							{
								foreach ($item['PRODUCT_PROPERTIES_FILL'] as $propID => $propInfo)
								{
									?>
									<input type="hidden" name="<?=$arParams['PRODUCT_PROPS_VARIABLE']?>[<?=$propID?>]"
										value="<?=htmlspecialcharsbx($propInfo['ID'])?>">
									<?
									unset($item['PRODUCT_PROPERTIES'][$propID]);
								}
							}

							if (!empty($item['PRODUCT_PROPERTIES']))
							{
								?>
								<table>
									<?
									foreach ($item['PRODUCT_PROPERTIES'] as $propID => $propInfo)
									{
										?>
										<tr>
											<td><?=$item['PROPERTIES'][$propID]['NAME']?></td>
											<td>
												<?
												if (
													$item['PROPERTIES'][$propID]['PROPERTY_TYPE'] === 'L'
													&& $item['PROPERTIES'][$propID]['LIST_TYPE'] === 'C'
												)
												{
													foreach ($propInfo['VALUES'] as $valueID => $value)
													{
														?>
														<label>
															<? $checked = $valueID === $propInfo['SELECTED'] ? 'checked' : ''; ?>
															<input type="radio" name="<?=$arParams['PRODUCT_PROPS_VARIABLE']?>[<?=$propID?>]"
																value="<?=$valueID?>" <?=$checked?>>
															<?=$value?>
														</label>
														<br />
														<?
													}
												}
												else
												{
													?>
													<select name="<?=$arParams['PRODUCT_PROPS_VARIABLE']?>[<?=$propID?>]">
														<?
														foreach ($propInfo['VALUES'] as $valueID => $value)
														{
															$selected = $valueID === $propInfo['SELECTED'] ? 'selected' : '';
															?>
															<option value="<?=$valueID?>" <?=$selected?>>
																<?=$value?>
															</option>
															<?
														}
														?>
													</select>
													<?
												}
												?>
											</td>
										</tr>
										<?
									}
									?>
								</table>
								<?
							}
							?>
						</div>
						<?
					}
				}
				else
				{
					$showProductProps = !empty($item['DISPLAY_PROPERTIES']);
					$showOfferProps = $arParams['PRODUCT_DISPLAY_MODE'] === 'Y' && $item['OFFERS_PROPS_DISPLAY'];

					if ($showProductProps || $showOfferProps)
					{
						?>
						<div class="product-item-info-container product-item-hidden" data-entity="props-block">
							<dl class="product-item-properties">
								<?
								if ($showProductProps)
								{
									foreach ($item['DISPLAY_PROPERTIES'] as $code => $displayProperty)
									{
										?>
										<dt<?=(!isset($item['PROPERTY_CODE_MOBILE'][$code]) ? ' class="hidden-xs"' : '')?>>
											<?=$displayProperty['NAME']?>
										</dt>
										<dd<?=(!isset($item['PROPERTY_CODE_MOBILE'][$code]) ? ' class="hidden-xs"' : '')?>>
											<?=(is_array($displayProperty['DISPLAY_VALUE'])
												? implode(' / ', $displayProperty['DISPLAY_VALUE'])
												: $displayProperty['DISPLAY_VALUE'])?>
										</dd>
										<?
									}
								}

								if ($showOfferProps)
								{
									?>
									<span id="<?=$itemIds['DISPLAY_PROP_DIV']?>" style="display: none;"></span>
									<?
								}
								?>
							</dl>
						</div>
						<?
					}
				}

				break;
				
			case 'quantityLimit':
				if ($arParams['SHOW_MAX_QUANTITY'] !== 'N')
				{
					if ($haveOffers)
					{
						if ($arParams['PRODUCT_DISPLAY_MODE'] === 'Y')
						{
							?>
							<div class="product-item-info-container product-item-hidden" id="<?=$itemIds['QUANTITY_LIMIT']?>"
								style="display: none;" data-entity="quantity-limit-block">
								<div class="product-item-info-container-title">
									<?=$arParams['MESS_SHOW_MAX_QUANTITY']?>:
									<span class="product-item-quantity" data-entity="quantity-limit-value"></span>
								</div>
							</div>
							<?
						}
					}
					else
					{
						if (
							$measureRatio
							&& (float)$actualItem['CATALOG_QUANTITY'] > 0
							&& $actualItem['CATALOG_QUANTITY_TRACE'] === 'Y'
							&& $actualItem['CATALOG_CAN_BUY_ZERO'] === 'N'
						)
						{
							?>
							<div class="product-item-info-container product-item-hidden" id="<?=$itemIds['QUANTITY_LIMIT']?>">
								<div class="product-item-info-container-title">
									<?=$arParams['MESS_SHOW_MAX_QUANTITY']?>:
									<span class="product-item-quantity">
										<?
										if ($arParams['SHOW_MAX_QUANTITY'] === 'M')
										{
											if ((float)$actualItem['CATALOG_QUANTITY'] / $measureRatio >= $arParams['RELATIVE_QUANTITY_FACTOR'])
											{
												echo $arParams['MESS_RELATIVE_QUANTITY_MANY'];
											}
											else
											{
												echo $arParams['MESS_RELATIVE_QUANTITY_FEW'];
											}
										}
										else
										{
											echo $actualItem['CATALOG_QUANTITY'].' '.$actualItem['ITEM_MEASURE']['TITLE'];
										}
										?>
									</span>
								</div>
							</div>
							<?
						}
					}
				}

				break;
			case 'quantity':
				if (!$haveOffers){
					if ($actualItem['CAN_BUY'] && $arParams['USE_PRODUCT_QUANTITY']){ ?>
						<div class="product-item-info-container product-item-hidden" data-entity="quantity-block">
							<div class="product-item-amount">
								<div class="product-item-amount-field-container">
									<span class="product-item-amount-field-btn-minus no-select" id="<?=$itemIds['QUANTITY_DOWN']?>"></span>
									<input class="product-item-amount-field" id="<?=$itemIds['QUANTITY']?>" type="number"
										name="<?=$arParams['PRODUCT_QUANTITY_VARIABLE']?>"
										value="<?=$measureRatio?>">
									<span class="product-item-amount-field-btn-plus no-select" id="<?=$itemIds['QUANTITY_UP']?>"></span>
									<span class="product-item-amount-description-container">
										<span id="<?=$itemIds['QUANTITY_MEASURE']?>">
											<?=$actualItem['ITEM_MEASURE']['TITLE']?>
										</span>
										<span id="<?=$itemIds['PRICE_TOTAL']?>"></span>
									</span>
								</div>
							</div>
						</div>
						<?
					}
				}
				elseif ($arParams['PRODUCT_DISPLAY_MODE'] === 'Y')
				{
					if ($arParams['USE_PRODUCT_QUANTITY'])
					{
						?>
						<div class="product-item-info-container product-item-hidden" data-entity="quantity-block">
							<div class="product-item-amount">
								<div class="product-item-amount-field-container">
									<span class="product-item-amount-field-btn-minus no-select" id="<?=$itemIds['QUANTITY_DOWN']?>"></span>
									<input class="product-item-amount-field" id="<?=$itemIds['QUANTITY']?>" type="number"
										name="<?=$arParams['PRODUCT_QUANTITY_VARIABLE']?>"
										value="<?=$measureRatio?>">
									<span class="product-item-amount-field-btn-plus no-select" id="<?=$itemIds['QUANTITY_UP']?>"></span>
									<span class="product-item-amount-description-container">
										<span id="<?=$itemIds['QUANTITY_MEASURE']?>"><?=$actualItem['ITEM_MEASURE']['TITLE']?></span>
										<span id="<?=$itemIds['PRICE_TOTAL']?>"></span>
									</span>
								</div>
							</div>
						</div>
						<?
					}
				}
			break;
			case 'buttons': ?>
				<div class="product-item-buttons" data-entity="buttons-block">
				    <div class="product-item-button">
						<a class="btn btn-default" href="<?=$item['DETAIL_PAGE_URL']?>">
							<?=$arParams['MESS_BTN_DETAIL']?>
						</a>
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
							"PRODUCT_ID" => $item['ID'],
							"USE_CAPTCHA" => "N",
							"USE_FIELD_COMMENT" => "Y",
							"USE_FIELD_EMAIL" => "Y"
						)
					);?>
				</div>
			<? break;
		}
	}
} ?>
</div>	