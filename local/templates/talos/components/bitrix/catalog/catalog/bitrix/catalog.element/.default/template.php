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

$compareBtnMessage = ($arParams['MESS_BTN_COMPARE'] != '' ? $arParams['MESS_BTN_COMPARE'] : GetMessage('CT_BCE_CATALOG_COMPARE'));

$templateData = array(
	'TEMPLATE_CLASS' => 'bx_'.$arParams['TEMPLATE_THEME']
);

$strMainID = $this->GetEditAreaId($arResult['ID']);
$arItemIDs = array(
	'ID' => $strMainID,
	'PICT' => $strMainID.'_pict',
	'DISCOUNT_PICT_ID' => $strMainID.'_dsc_pict',
	'STICKER_ID' => $strMainID.'_sticker',
	'BIG_SLIDER_ID' => $strMainID.'_big_slider',
	'BIG_IMG_CONT_ID' => $strMainID.'_bigimg_cont',
	'SLIDER_CONT_ID' => $strMainID.'_slider_cont',
	'SLIDER_LIST' => $strMainID.'_slider_list',
	'SLIDER_LEFT' => $strMainID.'_slider_left',
	'SLIDER_RIGHT' => $strMainID.'_slider_right',
	'OLD_PRICE' => $strMainID.'_old_price',
	'PRICE' => $strMainID.'_price',
	'DISCOUNT_PRICE' => $strMainID.'_price_discount',
	'SLIDER_CONT_OF_ID' => $strMainID.'_slider_cont_',
	'SLIDER_LIST_OF_ID' => $strMainID.'_slider_list_',
	'SLIDER_LEFT_OF_ID' => $strMainID.'_slider_left_',
	'SLIDER_RIGHT_OF_ID' => $strMainID.'_slider_right_',
	'QUANTITY' => $strMainID.'_quantity',
	'QUANTITY_DOWN' => $strMainID.'_quant_down',
	'QUANTITY_UP' => $strMainID.'_quant_up',
	'QUANTITY_MEASURE' => $strMainID.'_quant_measure',
	'QUANTITY_LIMIT' => $strMainID.'_quant_limit',
	'BUY_LINK' => $strMainID.'_buy_link',
	'ADD_BASKET_LINK' => $strMainID.'_add_basket_link',
	'COMPARE_LINK' => $strMainID.'_compare_link',
	'PROP' => $strMainID.'_prop_',
	'PROP_DIV' => $strMainID.'_skudiv',
	'DISPLAY_PROP_DIV' => $strMainID.'_sku_prop',
	'OFFER_GROUP' => $strMainID.'_set_group_',
	'BASKET_PROP_DIV' => $strMainID.'_basket_prop',
);
$strObName = 'ob'.preg_replace("/[^a-zA-Z0-9_]/", "x", $strMainID);
$templateData['JS_OBJ'] = $strObName;

$strTitle = (
	isset($arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_TITLE"]) && '' != $arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_TITLE"]
	? $arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_TITLE"]
	: $arResult['NAME']
);
$strAlt = (
	isset($arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_ALT"]) && '' != $arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_ALT"]
	? $arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_ALT"]
	: $arResult['NAME']
);
?>

<?if($arParams['DISPLAY_COMPARE']){?>
	<input id="this_list" type="hidden" value="<?=$arParams['COMPARE_NAME']?>">
<?}?>

<div class="emarket-catalog-detail" id="<? echo $arItemIDs['ID']; ?>">
	<?
	reset($arResult['MORE_PHOTO']);
	$arFirstPhoto = current($arResult['MORE_PHOTO']);
	?>

        <div class="header_catalog-detail">
            <div class="container-fluid">
                <div class="small_header hidden-lg hidden-md">
                    <h1>
                        <? echo $arResult["NAME"]; ?>
                    </h1>

                    <?if(!empty($arResult["PROPERTIES"]["EMARKET_ARTICLE"]["VALUE"])):?>
                        <span><?=GetMessage("ARTICLE")?> <? echo $arResult["PROPERTIES"]["EMARKET_ARTICLE"]["VALUE"]; ?>
                    </span>
                    <?endif;?>

                    <?if($arResult['PROPERTIES']['EMARKET_PREVIEW_CH']['VALUE']) {?>
                        <p><?=$arResult['PROPERTIES']['EMARKET_PREVIEW_CH']['VALUE']?>
                        </p>
                    <?}?>
                    <div class="rating">
                        <?
                        $rating = intval($arResult['PROPERTIES']['EMARKET_RATING']['VALUE']);
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


            <div class="block_img col-md-4 col-xs-12">
                    <div class="bx_item_slider" id="<? echo $arItemIDs['BIG_SLIDER_ID']; ?>">
                        <div class="wrp_big_img">
                            <a href="<? echo $arFirstPhoto['SRC']; ?>"  class="bx_bigimages" id="<? echo $arItemIDs['BIG_IMG_CONT_ID']; ?>" >
                                <img    onclick="openBox(this); return false;"
                                                                id="<? echo $arItemIDs['PICT']; ?>"
                                                                src="<? echo $arFirstPhoto['SRC']; ?>"
                                                                alt="<? echo $strAlt; ?>"
                                                                title="<? echo $strTitle; ?>"
                                    class='zoom-img'
                                >
                                <?if ($arResult['LABEL']) {?>
                                    <div class="bx_stick new" id="<? echo $arItemIDs['STICKER_ID'] ?>"><? echo $arResult['LABEL_VALUE']; ?></div>
                                <?}?>

                                <?if (0 < $arResult['MIN_PRICE']['DISCOUNT_DIFF']):?>
                                    <div class="product_sale"> <?=GetMessage("SALE")?>
                                    </div>
                                <?endif;?>

                                <?if(!empty($arResult["PROPERTIES"]["EMARKET_NEW"]["VALUE"])):?>
                                    <div class="product_new"> <?=GetMessage("NEW")?>
                                    </div>
                                <?endif;?>
                                <?if(!empty($arResult["PROPERTIES"]["EMARKET_HIT"]["VALUE"])):?>
                                    <div class="product_hit"> <?=GetMessage("HIT")?>
                                    </div>
                                <?endif;?>

                            </a>
                        </div>

				<?
				if ($arResult['SHOW_SLIDER'])
				{
					if (!isset($arResult['OFFERS']) || empty($arResult['OFFERS']))
					{
						if (3 < $arResult['MORE_PHOTO_COUNT'])
						{
							$strClass = 'bx_slider_conteiner full';
							$strOneWidth = (100/$arResult['MORE_PHOTO_COUNT']).'%';
							$strWidth = (33.3*$arResult['MORE_PHOTO_COUNT']).'%';
							$strSlideStyle = '';
						}
						else
						{
							$strClass = 'bx_slider_conteiner';
							$strOneWidth = '33.3%';
							$strWidth = '100%';
							$strSlideStyle = 'display: none;';
						}
						?>
						<div class="<? echo $strClass; ?>" id="<? echo $arItemIDs['SLIDER_CONT_ID']; ?>">
							<div class="bx_slider_scroller_container">
								<div class="bx_slide" id="gallery">
									<ul style="width: <? echo $strWidth; ?>;" id="<? echo $arItemIDs['SLIDER_LIST']; ?>">
									<?foreach ($arResult['MORE_PHOTO'] as &$arOnePhoto) {?>
										<li data-value="<? echo $arOnePhoto['ID']; ?>"
											style="width: <? echo $strOneWidth; ?>;">
                                            <a class="gallery_href" data-fancybox="gallery<? echo $arItemIDs['SLIDER_LIST']; ?>" href="<? echo $arOnePhoto['SRC']; ?>"></a>
    											<span class="cnt">
    												<span class="cnt_item" style="background-image:url('<? echo $arOnePhoto['SRC']; ?>');"></span>
    											</span>
										</li>
									<?}	unset($arOnePhoto);?>
                                                                                <div class="clear_both"></div>
									</ul>
								</div>

							</div>
                                <?if(count($arResult['MORE_PHOTO'])> 3):?>
								<div class="bx_slide_left" id="<? echo $arItemIDs['SLIDER_LEFT']; ?>" style="<? echo $strSlideStyle; ?>"></div>
								<div class="bx_slide_right" id="<? echo $arItemIDs['SLIDER_RIGHT']; ?>" style="<? echo $strSlideStyle; ?>"></div>
                                <?endif;?>
						</div>
						<?
					}
					else
					{
						foreach ($arResult['OFFERS'] as $key => $arOneOffer)
						{
							if (!isset($arOneOffer['MORE_PHOTO_COUNT']) || 0 >= $arOneOffer['MORE_PHOTO_COUNT'])
								continue;
							$strVisible = ($key == $arResult['OFFERS_SELECTED'] ? '' : 'none');
							if (3 < $arOneOffer['MORE_PHOTO_COUNT'])
							{
								$strClass = 'bx_slider_conteiner full';
								$strOneWidth = (100/$arOneOffer['MORE_PHOTO_COUNT']).'%';
								$strWidth = (33.3*$arOneOffer['MORE_PHOTO_COUNT']).'%';
								$strSlideStyle = '';
							}
							else
							{
								$strClass = 'bx_slider_conteiner';
								$strOneWidth = '33.3%';
								$strWidth = '100%';
								$strSlideStyle = 'display: none;';
							}
							?>
							<div class="<? echo $strClass; ?>" id="<? echo $arItemIDs['SLIDER_CONT_OF_ID'].$arOneOffer['ID']; ?>" style="display: <? echo $strVisible; ?>;">
								<div class="bx_slider_scroller_container">
									<div class="bx_slide" id="gallery">
										<ul style="width: <? echo $strWidth; ?>;" id="<? echo $arItemIDs['SLIDER_LIST_OF_ID'].$arOneOffer['ID']; ?>">
											<?foreach ($arOneOffer['MORE_PHOTO'] as &$arOnePhoto) {?>
											<li data-value="<? echo $arOneOffer['ID'].'_'.$arOnePhoto['ID']; ?>"
												style="width: <? echo $strOneWidth; ?>;">
                                                <a class="gallery_href" data-fancybox="gallery<? echo $arItemIDs['SLIDER_LIST_OF_ID'].$arOneOffer['ID']; ?>" href="<? echo $arOnePhoto['SRC']; ?>"></a>
                                                <span class="cnt">
													<span class="cnt_item" style="background-image:url('<? echo $arOnePhoto['SRC']; ?>');"></span>
												</span>
											</li>
											<?}	unset($arOnePhoto);?>
                                                                                        <div class="clear_both"></div>
										</ul>
									</div>

								</div>
                                    <?if(count($arOneOffer['MORE_PHOTO'])> 0):?>

									<div class="bx_slide_left <?if(count($arOneOffer['MORE_PHOTO'])<= 3):?>disabled<?endif;?>"
                                                                             id="<? echo $arItemIDs['SLIDER_LEFT_OF_ID'].$arOneOffer['ID'] ?>" style="<? echo $strSlideStyle; ?>" data-value="<? echo $arOneOffer['ID']; ?>"></div>
									<div class="bx_slide_right <?if(count($arOneOffer['MORE_PHOTO'])<= 3):?>disabled<?endif;?>"                                                                             "
                                                                             id="<? echo $arItemIDs['SLIDER_RIGHT_OF_ID'].$arOneOffer['ID'] ?>" style="<? echo $strSlideStyle; ?>" data-value="<? echo $arOneOffer['ID']; ?>"></div>

                                    <?endif;?>
							</div>
							<?
						}
					}
				}
				?>

                            <?
				if('Y' == $arResult['PROPERTIES']['EMARKET_HIT']['VALUE'])
					echo '<div class="item_hit"></div>';
				elseif('Y' == $arResult['PROPERTIES']['EMARKET_NEW']['VALUE'])
					echo '<div class="item_new"></div>';
                            ?>
                    </div>
            </div>
            <div class="info_main col-md-8 col-xs-12">
                <div class="hidden-sm hidden-xs">
                <?if(!empty($arResult["PROPERTIES"]["EMARKET_ARTICLE"]["VALUE"])):?>
                    <span><?=GetMessage("ARTICLE")?> <? echo $arResult["PROPERTIES"]["EMARKET_ARTICLE"]["VALUE"]; ?>
                    </span>
                <?endif;?>
                <h1>
                    <? echo $arResult["NAME"]; ?>
                </h1>

                <?if($arResult['PROPERTIES']['EMARKET_PREVIEW_CH']['VALUE']) {?>
                    <p><?=$arResult['PROPERTIES']['EMARKET_PREVIEW_CH']['VALUE']?>
                    </p>
               <?}?>
                <div class="rating">
                    <?$rating = intval($arResult['PROPERTIES']['EMARKET_RATING']['VALUE']);
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
						}?>
                    </div>
                </div>
				<?
				if (isset($arResult['OFFERS']) && !empty($arResult['OFFERS']))
					$available = $arResult['OFFERS'][$arResult['OFFERS_SELECTED']]['CAN_BUY'];
				else
					$available = $arResult['CAN_BUY'];

				if ($available)
				{
					$buyMessage = GetMessage('K_available');
					$buyClass = 'available';
				}
				else
				{
					$buyMessage = GetMessage('K_not_available');
					$buyClass = 'not_available';
				}

				{?>
                                <? if($arResult["PROPERTIES"]["NEED_ORDER"]["VALUE"] == "Y"):?>
                                    <div class="available_block">
                                        <p class="need_order mdi mdi-clock" >
                                            <?=GetMessage("NEED_ORDER")?>
					</p>
                                    </div>
                                <?else:?>
                                    <div class="available_block">
                                        <p class="<? echo $buyClass; ?> mdi mdi-check-circle" >
                                            <? echo $buyMessage; ?>
					</p>
                                    </div>
                                <? endif;?>
                                <?}?>


                <?$APPLICATION->IncludeComponent(
                    "bitrix:news.list",
                    "additional_info_catalog",
                    array(
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
                        "CACHE_TYPE" => "A",
                        "CHECK_DATES" => "Y",
                        "DETAIL_URL" => "",
                        "DISPLAY_BOTTOM_PAGER" => "N",
                        "DISPLAY_DATE" => "Y",
                        "DISPLAY_NAME" => "Y",
                        "DISPLAY_PICTURE" => "Y",
                        "DISPLAY_PREVIEW_TEXT" => "Y",
                        "DISPLAY_TOP_PAGER" => "N",
                        "FIELD_CODE" => array(
                            0 => "",
                            1 => "",
                        ),
                        "FILTER_NAME" => "",
                        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                        "IBLOCK_ID" => $arParams['IBLOCK_ID_DOPINFO'],
                        "IBLOCK_TYPE" => $arParams['IBLOCK_TYPE'],
                        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                        "INCLUDE_SUBSECTIONS" => "Y",
                        "MESSAGE_404" => "",
                        "NEWS_COUNT" => "10",
                        "PAGER_BASE_LINK_ENABLE" => "N",
                        "PAGER_DESC_NUMBERING" => "N",
                        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                        "PAGER_SHOW_ALL" => "N",
                        "PAGER_SHOW_ALWAYS" => "N",
                        "PAGER_TEMPLATE" => "",
                        "PAGER_TITLE" => "",
                        "PARENT_SECTION" => "",
                        "PARENT_SECTION_CODE" => "",
                        "PREVIEW_TRUNCATE_LEN" => "",
                        "PROPERTY_CODE" => array(
                            0 => "",
                            1 => "",
                        ),
                        "SET_BROWSER_TITLE" => "N",
                        "SET_LAST_MODIFIED" => "N",
                        "SET_META_DESCRIPTION" => "N",
                        "SET_META_KEYWORDS" => "N",
                        "SET_STATUS_404" => "N",
                        "SET_TITLE" => "N",
                        "SHOW_404" => "N",
                        "SORT_BY1" => "ACTIVE_FROM",
                        "SORT_BY2" => "SORT",
                        "SORT_ORDER1" => "DESC",
                        "SORT_ORDER2" => "ASC",
                        "COMPONENT_TEMPLATE" => "additional_info_catalog"
                    ),
                    $component
                );?>

                <div class="section_product_info">
			<?if(isset($arResult['OFFERS']) && !empty($arResult['OFFERS']) && !empty($arResult['OFFERS_PROP'])) {?>
				<div class="scu_section"  id="<? echo $arItemIDs['PROP_DIV']; ?>">
				<?
					$arSkuProps = array();
					foreach ($arResult['SKU_PROPS'] as &$arProp)
					{
						if (!isset($arResult['OFFERS_PROP'][$arProp['CODE']]))
							continue;
						$arSkuProps[] = array(
							'ID' => $arProp['ID'],
							'SHOW_MODE' => $arProp['SHOW_MODE'],
							'VALUES_COUNT' => $arProp['VALUES_COUNT']
						);
						if ('TEXT' == $arProp['SHOW_MODE'])
						{
							if (5 < $arProp['VALUES_COUNT'])
							{
								$strClass = 'bx_item_detail_size full';
								$strOneWidth = (100/$arProp['VALUES_COUNT']).'%';
								$strWidth = (20*$arProp['VALUES_COUNT']).'%';
								$strSlideStyle = '';
							}
							else
							{
								$strClass = 'bx_item_detail_size';
								$strOneWidth = '20%';
								$strWidth = '100%';
								$strSlideStyle = 'display: none;';
							}
							?>
							<div class="<? echo $strClass; ?>" id="<? echo $arItemIDs['PROP'].$arProp['ID']; ?>_cont"> <!--  !-->


                                                                    <h5><? echo htmlspecialcharsex($arProp['NAME']); ?>:</h5>
									<div class="txt">
										<ul id="<? echo $arItemIDs['PROP'].$arProp['ID']; ?>_list" style="width: <? echo $strWidth; ?>;margin-left:0;">
										<?foreach ($arProp['VALUES'] as $arOneValue){?>
											<li	data-treevalue="<? echo $arProp['ID'].'_'.$arOneValue['ID']; ?>"
												data-onevalue="<? echo $arOneValue['ID']; ?>"
												<i>
                                                                                                    <? echo htmlspecialcharsex($arOneValue['NAME']); ?>
                                                                                                </i>
											</li>
										<?}?>
										</ul>
									</div>

									<div class="bx_slide_left" style="<? echo $strSlideStyle; ?>" id="<? echo $arItemIDs['PROP'].$arProp['ID']; ?>_left" data-treevalue="<? echo $arProp['ID']; ?>"></div>
									<div class="bx_slide_right" style="<? echo $strSlideStyle; ?>" id="<? echo $arItemIDs['PROP'].$arProp['ID']; ?>_right" data-treevalue="<? echo $arProp['ID']; ?>"></div>


							</div>
							<?
						}
						elseif ('PICT' == $arProp['SHOW_MODE'])
						{
							if (5 < $arProp['VALUES_COUNT'])
							{
								$strClass = 'bx_item_detail_scu full';
								$strOneWidth = (100/$arProp['VALUES_COUNT']).'%';
								$strWidth = (20*$arProp['VALUES_COUNT']).'%';
								$strSlideStyle = '';
							}
							else
							{
								$strClass = 'bx_item_detail_scu';
								$strOneWidth = '20%';
								$strWidth = '100%';
								$strSlideStyle = 'display: none;';
							}
							?>
							<div class="<? echo $strClass; ?>" id="<? echo $arItemIDs['PROP'].$arProp['ID']; ?>_cont"> <!--  !-->
								<h5><? echo htmlspecialcharsex($arProp['NAME']); ?>:</h5>
										<ul id="<? echo $arItemIDs['PROP'].$arProp['ID']; ?>_list" class="pic_item">
										<?foreach ($arProp['VALUES'] as $arOneValue) {?>
											<li data-treevalue="<? echo $arProp['ID'].'_'.$arOneValue['ID'] ?>"
												data-onevalue="<? echo $arOneValue['ID']; ?>">
												<i title="<? echo htmlspecialcharsbx($arOneValue['NAME']); ?>"></i>

													<span class="cnt_item"
														style="background-image:url('<? echo $arOneValue['PICT']['SRC']; ?>');"
														title="<? echo htmlspecialcharsbx($arOneValue['NAME']); ?>"></span>

											</li>
										<?}?>
										</ul>

									<div class="bx_slide_left" style="<? echo $strSlideStyle; ?>" id="<? echo $arItemIDs['PROP'].$arProp['ID']; ?>_left" data-treevalue="<? echo $arProp['ID']; ?>"></div>
									<div class="bx_slide_right" style="<? echo $strSlideStyle; ?>" id="<? echo $arItemIDs['PROP'].$arProp['ID']; ?>_right" data-treevalue="<? echo $arProp['ID']; ?>"></div>

							</div>
							<?
						}
					}
					unset($arProp);
				?>
				</div>
			<?}?>

                <div class="option_block">
                    <div class="item_info_section">

                        <div class="price_block">
                            <div class="price" id="<? echo $arItemIDs['PRICE']; ?>">
                                <? echo $arResult['MIN_PRICE']['PRINT_DISCOUNT_VALUE']; ?>
                            </div>

                            <?$boolDiscountShow = (0 < $arResult['MIN_PRICE']['DISCOUNT_DIFF']);?>
                            <div class="old_price" id="<? echo $arItemIDs['OLD_PRICE']; ?>" style="display: <? echo ($boolDiscountShow ? '' : 'none'); ?>">
                                <? echo ($boolDiscountShow ? $arResult['MIN_PRICE']['PRINT_VALUE'] : ''); ?>
                            </div>

                            <?if('Y' == $arParams['SHOW_DISCOUNT_PERCENT']) {?>
                                <div class="bx_stick_disc" id="<? echo $arItemIDs['DISCOUNT_PICT_ID'] ?>"
                                     style="display:<? echo (0 < $arResult['MIN_PRICE']['DISCOUNT_DIFF_PERCENT'] ? '' : 'none'); ?>;">-<? echo $arResult['MIN_PRICE']['DISCOUNT_DIFF_PERCENT']; ?>%</div>
                            <?}?>
                        </div>
                        <?/*Price block end*/?>

                        <?
                        if (isset($arResult['OFFERS']) && !empty($arResult['OFFERS']))
                            $canBuy = $arResult['OFFERS'][$arResult['OFFERS_SELECTED']]['CAN_BUY'];
                        else
                            $canBuy = $arResult['CAN_BUY'];

                        if ($canBuy)
                        {
                            $buyBtnMessage = ('' != $arParams['MESS_BTN_BUY'] ? $arParams['MESS_BTN_BUY'] : GetMessage('CT_BCE_CATALOG_BUY'));
                            $buyBtnClass = 'btn_buy';
                            $avClass = '';
                        }
                        else
                        {
                            $buyBtnMessage = ('' != $arParams['MESS_NOT_AVAILABLE'] ? $arParams['MESS_NOT_AVAILABLE'] : GetMessageJS('CT_BCE_CATALOG_NOT_AVAILABLE'));
                            $buyBtnClass = 'btn_not_buy';
                            $avClass = 'disable';
                        }

                        if ('Y' == $arParams['USE_PRODUCT_QUANTITY']) {?>

                            <div class="quantity">
                                <span class="small_button left <? echo $avClass?>" id="<? echo $arItemIDs['QUANTITY_DOWN']; ?>">-</span>
                                <input id="<? echo $arItemIDs['QUANTITY']; ?>"
                                        class="<?echo $avClass?>"
                                       type="text"
                                       value="<? echo (isset($arResult['OFFERS']) && !empty($arResult['OFFERS'])
                                           ? 1
                                           : $arResult['CATALOG_MEASURE_RATIO']
                                       ); ?>">
                                <span class="<?echo $avClass?>" href="javascript:void(0)" id="<? echo $arItemIDs['QUANTITY_UP']; ?>">+</span>
                                <div class="clear_both"></div>
                            </div>

                            <div class="<? echo $buyBtnClass; ?>">
                                <span class="on_basket"> </span>
                                <a  href="javascript:void(0);"
                                    class="btn btn_blue not_av"
                                    id="<? echo $arItemIDs['BUY_LINK']; ?>">
                                    <? echo $buyBtnMessage; ?>
                                </a>

                                <div id="BasketEmodal">
                                    <div class="emodal-data">

                                    </div>
                                </div>
                                <?$APPLICATION->IncludeComponent(
                                	"krayt:one.click",
                                	"",
                                	Array(
                                		"ELEMENT_ID" => $arResult['ID'],
                                		"K_ONE_BNT_NAME" => "",
                                		"K_ONE_BTN_SEND" => "",
                                		"K_ONE_EVENT_TYPE" => "EMARKET_FEEDBACK_PROPD",
                                		"K_ONE_FORM_TITLE" => "",
                                		"K_ONE_TEXT_OK" => ""

                                	),
                                    $component
                                );?>
                                <?if($arParams['DISPLAY_COMPARE']){?>
                                    <div class="compare-control">
                                        <input id="compare_<?=$arResult['ID']?>"
                                               class="compare-control-input"
                                               type="checkbox"
                                            <?if(!empty($_SESSION[$arParams['COMPARE_NAME']][$arResult['IBLOCK_ID']]['ITEMS'][$arResult['ID']])) echo 'checked="checked"';?>
                                               data-id="<?=$arResult['ID']?>">
                                        <label class="mdi mdi-poll" for="compare_<?=$arResult['ID']?>" title="<?=GetMessage('CT_BCE_CATALOG_COMPARE')?>">
                                            <span><?=GetMessage('CT_BCE_CATALOG_COMPARE')?></span>
                                        </label>
                                        <div class="load"></div>
                                    </div>
                                <?}?>
                            </div>

                            <?
                            if ('Y' == $arParams['SHOW_MAX_QUANTITY'])
                            {
                                if (isset($arResult['OFFERS']) && !empty($arResult['OFFERS']))
                                {
                                    ?>
                                    <p id="<? echo $arItemIDs['QUANTITY_LIMIT']; ?>" style="display: none;">
                                        <? echo GetMessage('OSTATOK'); ?>: <span></span>
                                    </p>
                                    <?
                                }
                                else
                                {
                                    if ('Y' == $arResult['CATALOG_QUANTITY_TRACE'] && 'N' == $arResult['CATALOG_CAN_BUY_ZERO'])
                                    {
                                        ?>
                                        <p id="<? echo $arItemIDs['QUANTITY_LIMIT']; ?>">
                                            <? echo GetMessage('OSTATOK'); ?>: <span><? echo $arResult['CATALOG_QUANTITY']; ?></span>
                                        </p>
                                        <?
                                    }
                                }
                            }
                        } else {?>
                            <div class="item_buttons vam">
                                <a  href="javascript:void(0);"
                                    class="bx_medium_2 ico1"
                                    id="<? echo $arItemIDs['BUY_LINK']; ?>">
                                    <? echo $buyBtnMessage; ?>
                                </a>
                                <a  href="#"
                                    data-id="<?=$arItem['ID']?>"
                                    class="bx_medium_2 ico2"
                                    rel="nofollow">
                                    <?=GetMessage('CT_BCE_CATALOG_BUY_1')?>
                                </a>
                            </div>
                        <?}?>
                    </div>

                    </div>
                </div>

            </div>

        </div>
        </div>
<div class="catalog_bg">
        <div class="element_description">
            <div class="tabs">

                 <div class="tabs-menu">
                     <div class="container-fluid">
                        <a href="#tab_1" data-toggle="tab" class="active"><?=GetMessage('TAB1');?></a>
                        <a href="#tab_2" data-toggle="tab"><?=GetMessage('TAB2');?></a>
                        <a href="#tab_3" data-toggle="tab"><?=GetMessage('TAB3');?></a>
                        <a href="#tab_4" data-toggle="tab"><?=GetMessage('TAB4');?></a>
                     </div>
                </div>
    <div class="container-fluid">
                <div class="tabs-content">
                    <div class="toogle_title tab_1 mdi mdi-chevron-right"><?=GetMessage('TAB1');?></div>
                    <div class="tab row active" id="tab_1">
                        <div class="col-sm-6 col-xs-12">
                            <h2><?=GetMessage('TAB1')?></h2>
                                <?if(!empty($arResult['PREVIEW_TEXT'])):?>
                                    <p> <? echo $arResult['PREVIEW_TEXT']; ?>
                                    </p>
                                    <a data-toggle="tab" class="link tab_link text_link" href="#tab_2"><?=GetMessage("TEXT_MORE")?></a>
                                <?else:?>
                                    <p><?=GetMessage('TEXT_NO_DESC')?></p>
                                <?endif;?>
                        </div>
                        <div class="col-sm-6 col-xs-12">
                            <h2><?=GetMessage('TAB3')?></h2>
                                <div class="property-list">
                                                        <?
                                                        $i=0;
                                                        foreach($arResult['PROPERTY_ITEMS'] as $property)
                                                        {

                                                                if($i >= 15)  break;

                                                                //wrap items
                                                                $property_val = '';
                                                                $property_code = $property['CODE'];
                                                                $property_table_name = $arResult['PROPERTIES'][$property_code]['USER_TYPE_SETTINGS']['TABLE_NAME'];
                                                                switch($arResult['PROPERTIES'][$property_code]['PROPERTY_TYPE'])
                                                                {
                                                                        case 'S':
                                                                                if( !isset($property_table_name) || empty($property_table_name))
                                                                                {
                                                                                        $property_val = $arResult['PROPERTIES'][$property_code]['VALUE'];
                                                                                }
                                                                                else
                                                                                {
                                                                                        $property_val = $arResult['HL_PROP_LIST'][$property_table_name][$arResult['PROPERTIES'][$property_code]['VALUE']]['UF_NAME'];
                                                                                }
                                                                        break;

                                                                        case 'L':
                                                                                if($arResult['PROPERTIES'][$property_code]['VALUE'] == 'Y')
                                                                                        $property_val = GetMessage('CATALOG_TC_YES');
                                                                                else
                                                                                        $property_val = $arResult['PROPERTIES'][$property_code]['VALUE'];
                                                                        break;
                                                                        case 'N':
                                                                                if($arResult['PROPERTIES'][$property_code]['VALUE'] > 0)
                                                                                        $property_val = $arResult['PROPERTIES'][$property_code]['VALUE'].' '.$property['PROPERTIES']['property_measure']['VALUE'];
                                                                        break;
                                                                }

                                                                if(!$property_val)
                                                                        continue;
                                                                else
                                                                        $i++;

                                                                if(	$property['PROPERTIES']['property_group']['VALUE'] != $temp &&
                                                                        $property['PROPERTIES']['property_group']['VALUE'])
                                                                {
                                                                        if($temp) echo '</div></div>';
                                                                        ?>
                                                                        <div class="property-item">
                                                                                <h3><?=$arResult['HL_PROP_LIST'][$property['PROPERTIES']['property_group']['USER_TYPE_SETTINGS']['TABLE_NAME']][$property['PROPERTIES']['property_group']['VALUE']]['UF_NAME']?></h3>
                                                                                <div class="row">
                                                                        <?
                                                                        $temp = $property['PROPERTIES']['property_group']['VALUE'];
                                                                }
                                                                ?>
                                                                    <div class="col-xs-12">
                                                                        <div class="row">
                                                                        <div class="col-xs-6">
                                                                            <div class="title">
                                                                                <span><?=$property['NAME']?></span> </div>
                                                                            </div>
                                                                        <div class="col-xs-6">
                                                                            <?if(is_array($arResult['PROPERTIES'][$property_code]['VALUE'])):?>
                                                                                <?foreach($arResult['PROPERTIES'][$property_code]['VALUE'] as $propertyMnVal){?>
                                                                                    <?=$propertyMnVal?>,
                                                                                <? } ?>

                                                                            <?else:?>
                                                                                <?=$property_val?>
                                                                            <?endif;?>


                                                                        </div>
                                                                        </div>
                                                                    </div>

                                                        <?
                                                        }

                                                        if($temp)
                                                                echo '</div></div>';

                                                        unset($temp);
                                                        ?>
                                                        <?if($i >= 15):?>
                                                        	<a data-toggle="tab" class="link tab_link" href="#tab_3"><?=GetMessage("ALL_PROPERTIES")?></a>
                                                        <?endif;?>
                                                </div>
                        </div>

                    </div>

                    <div class="toogle_title tab_2 mdi mdi-chevron-right"><?=GetMessage('TAB2');?></div>
                    <div class="tab" id="tab_2">
                        <h2><?=GetMessage('TEXT_DESC_OBZ');?>: <? echo $arResult['NAME'];?></h2>
                        <?if(!empty($arResult['DETAIL_TEXT'])):?>
                            <? echo $arResult['DETAIL_TEXT'];?>
                        <?else:?>
                            <p><?=GetMessage('TEXT_DESC_OBZ')?></p>
                        <?endif;?>

                    </div>
                    <div class="toogle_title tab_3 mdi mdi-chevron-right"><?=GetMessage('TAB3');?></div>
                    <div class="tab" id="tab_3">
                        <h2><?=GetMessage('TEXT_PROPERTY')?>: <? echo $arResult['NAME'];?></h2>
                        <div class="row">
                             <?
                                                        $i=0;
                                                        foreach($arResult['PROPERTY_ITEMS'] as $property)
                                                        {

                                                                if($i >= 20) break;

                                                                //wrap items
                                                                $property_val = '';
                                                                $property_code = $property['CODE'];
                                                                $property_table_name = $arResult['PROPERTIES'][$property_code]['USER_TYPE_SETTINGS']['TABLE_NAME'];
                                                                switch($arResult['PROPERTIES'][$property_code]['PROPERTY_TYPE'])
                                                                {
                                                                        case 'S':
                                                                                if( !isset($property_table_name) || empty($property_table_name))
                                                                                {
                                                                                        $property_val = $arResult['PROPERTIES'][$property_code]['VALUE'];
                                                                                }
                                                                                else
                                                                                {
                                                                                        $property_val = $arResult['HL_PROP_LIST'][$property_table_name][$arResult['PROPERTIES'][$property_code]['VALUE']]['UF_NAME'];
                                                                                }
                                                                        break;

                                                                        case 'L':
                                                                                if($arResult['PROPERTIES'][$property_code]['VALUE'] == 'Y')
                                                                                        $property_val = GetMessage('CATALOG_TC_YES');
                                                                                else
                                                                                        $property_val = $arResult['PROPERTIES'][$property_code]['VALUE'];
                                                                        break;
                                                                        case 'N':
                                                                                if($arResult['PROPERTIES'][$property_code]['VALUE'] > 0)
                                                                                        $property_val = $arResult['PROPERTIES'][$property_code]['VALUE'].' '.$property['PROPERTIES']['property_measure']['VALUE'];
                                                                        break;
                                                                }

                                                                if(!$property_val)
                                                                        continue;
                                                                else
                                                                        $i++;

                                                                if(	$property['PROPERTIES']['property_group']['VALUE'] != $temp &&
                                                                        $property['PROPERTIES']['property_group']['VALUE'])
                                                                {
                                                                        if($temp) echo '</div></div>';
                                                                        ?>

                                                                        <div class="property-item col-sm-6 col-xs-12">
                                                                                <h3><?=$arResult['HL_PROP_LIST'][$property['PROPERTIES']['property_group']['USER_TYPE_SETTINGS']['TABLE_NAME']][$property['PROPERTIES']['property_group']['VALUE']]['UF_NAME']?></h3>
                                                                                <div class="row">
                                                                        <?
                                                                        $temp = $property['PROPERTIES']['property_group']['VALUE'];
                                                                }
                                                                ?>

                                                                    <div class="col-xs-12">
                                                                        <div class="row">
                                                                        <div class="col-xs-6">
                                                                            <div class="title">
                                                                                <span><?=$property['NAME']?></span> </div>
                                                                            </div>
                                                                        <div class="col-xs-6">
                                                                            <?if(is_array($arResult['PROPERTIES'][$property_code]['VALUE'])):?>
                                                                                <?foreach($arResult['PROPERTIES'][$property_code]['VALUE'] as $propertyMnVal){?>
                                                                                    <?=$propertyMnVal?>,
                                                                                <? } ?>

                                                                            <?else:?>
                                                                                <?=$property_val?>
                                                                            <?endif;?>
                                                                        </div>
                                                                        </div>
                                                                    </div>

                                                        <?
                                                        }

                                                        if($temp)
                                                                echo '</div></div>';

                                                        unset($temp);
                                                        ?>

                        </div>
                    </div>

                    <div class="toogle_title tab_4 mdi mdi-chevron-right"><?=GetMessage('TAB4');?></div>
                    <div class="tab " id="tab_4">
                        <?if ('Y' == $arParams['USE_COMMENTS']) {?>
					<?$APPLICATION->IncludeComponent(
						"krayt:emarket.comments",
						"",
						Array(
							"IBLOCK_TYPE" => $arParams['IBLOCK_TYPE_ID'],
							"IBLOCK_ID" => $arResult['IBLOCK_ID'],
							"ELEMENT_ID" => $arResult["ID"],
							"ELEMENT_CODE" => '',
							"HLBLOCK_PROP_CODE" => $arParams['BLOG_HLBLOCK_PROP_CODE'],
							"HLBLOCK_CR_PROP_CODE" => $arParams['BLOG_HLBLOCK_CR_PROP_CODE'],
							"EMARKET_COMMENT_PREMODERATION" => "N",
							"EMARKET_CUR_RATING" => $arResult['PROPERTIES']['EMARKET_RATING']['VALUE'],
							"EMARKET_CUR_COMMENTS_COUNT" => $arResult['PROPERTIES']['EMARKET_COMMENTS_COUNT']['VALUE']
						),
					$component
					);?>
			<?}?>
                    </div>
                </div>

            </div>

        </div>

        </div>

        </div>

        </div>
<?
if (isset($arResult['OFFERS']) && !empty($arResult['OFFERS']))
{
	foreach ($arResult['JS_OFFERS'] as &$arOneJS)
	{
		if ($arOneJS['PRICE']['DISCOUNT_VALUE'] != $arOneJS['PRICE']['VALUE'])
		{
			$arOneJS['PRICE']['PRINT_DISCOUNT_DIFF'] = GetMessage('ECONOMY_INFO', array('#ECONOMY#' => $arOneJS['PRICE']['PRINT_DISCOUNT_DIFF']));
			$arOneJS['PRICE']['DISCOUNT_DIFF_PERCENT'] = -$arOneJS['PRICE']['DISCOUNT_DIFF_PERCENT'];
		}
		$strProps = '';
		if ($arResult['SHOW_OFFERS_PROPS'])
		{
			if (!empty($arOneJS['DISPLAY_PROPERTIES']))
			{
				foreach ($arOneJS['DISPLAY_PROPERTIES'] as $arOneProp)
				{
					$strProps .= '<dt>'.$arOneProp['NAME'].'</dt><dd>'.(
						is_array($arOneProp['VALUE'])
						? implode(' / ', $arOneProp['VALUE'])
						: $arOneProp['VALUE']
					).'</dd>';
				}
			}
		}
		$arOneJS['DISPLAY_PROPERTIES'] = $strProps;
	}
	if (isset($arOneJS))
		unset($arOneJS);
	$arJSParams = array(
		'CONFIG' => array(
			'USE_CATALOG' => $arResult['CATALOG'],
			'SHOW_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
			'SHOW_PRICE' => true,
			'SHOW_DISCOUNT_PERCENT' => ('Y' == $arParams['SHOW_DISCOUNT_PERCENT']),
			'SHOW_OLD_PRICE' => ('Y' == $arParams['SHOW_OLD_PRICE']),
			'DISPLAY_COMPARE' => ('Y' == $arParams['DISPLAY_COMPARE']),
			'SHOW_SKU_PROPS' => $arResult['SHOW_OFFERS_PROPS'],
			'OFFER_GROUP' => $arResult['OFFER_GROUP'],
			'MAIN_PICTURE_MODE' => $arParams['DETAIL_PICTURE_MODE']
		),
		'PRODUCT_TYPE' => $arResult['CATALOG_TYPE'],
		'VISUAL' => array(
			'ID' => $arItemIDs['ID'],
		),
		'DEFAULT_PICTURE' => array(
			'PREVIEW_PICTURE' => $arResult['DEFAULT_PICTURE'],
			'DETAIL_PICTURE' => $arResult['DEFAULT_PICTURE']
		),
		'PRODUCT' => array(
			'ID' => $arResult['ID'],
			'NAME' => $arResult['~NAME']
		),
		'BASKET' => array(
			'QUANTITY' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
			'BASKET_URL' => $arParams['BASKET_URL'],
			'SKU_PROPS' => $arResult['OFFERS_PROP_CODES']
		),
		'OFFERS' => $arResult['JS_OFFERS'],
		'OFFER_SELECTED' => $arResult['OFFERS_SELECTED'],
		'TREE_PROPS' => $arSkuProps
	);
}
else
{
	$emptyProductProperties = empty($arResult['PRODUCT_PROPERTIES']);
	if ('Y' == $arParams['ADD_PROPERTIES_TO_BASKET'] && !$emptyProductProperties)
	{
		?><div id="<? echo $arItemIDs['BASKET_PROP_DIV']; ?>" style="display: none;"><?

		if (!empty($arResult['PRODUCT_PROPERTIES_FILL']))
		{
			foreach ($arResult['PRODUCT_PROPERTIES_FILL'] as $propID => $propInfo)
			{
				?>
					<input
						type="hidden"
						name="<? echo $arParams['PRODUCT_PROPS_VARIABLE']; ?>[<? echo $propID; ?>]"
						value="<? echo htmlspecialcharsbx($propInfo['ID']); ?>"
					>
				<?
				if (isset($arResult['PRODUCT_PROPERTIES'][$propID]))
					unset($arResult['PRODUCT_PROPERTIES'][$propID]);
			}
		}
		$emptyProductProperties = empty($arResult['PRODUCT_PROPERTIES']);
		if (!$emptyProductProperties)
		{
			?><table><?
			foreach ($arResult['PRODUCT_PROPERTIES'] as $propID => $propInfo)
			{
				?>
				<tr>
					<td><? echo $arResult['PROPERTIES'][$propID]['NAME']; ?></td>
					<td>
					<?
						if('L' == $arResult['PROPERTIES'][$propID]['PROPERTY_TYPE'] &&
							'C' == $arResult['PROPERTIES'][$propID]['LIST_TYPE']
						)
						{
							foreach($propInfo['VALUES'] as $valueID => $value)
							{
								?><label><input
									type="radio"
									name="<? echo $arParams['PRODUCT_PROPS_VARIABLE']; ?>[<? echo $propID; ?>]"
									value="<? echo $valueID; ?>"
									<? echo ($valueID == $propInfo['SELECTED'] ? '"checked"' : ''); ?>
								><? echo $value; ?></label><br><?
							}
						}
						else
						{
							?><select name="<? echo $arParams['PRODUCT_PROPS_VARIABLE']; ?>[<? echo $propID; ?>]"><?
							foreach($propInfo['VALUES'] as $valueID => $value)
							{
								?>
								<option
									value="<? echo $valueID; ?>"
									<? echo ($valueID == $propInfo['SELECTED'] ? '"selected"' : ''); ?>
								><? echo $value; ?></option><?
							}
							?></select><?
						}
					?>
					</td>
				</tr>
				<?
			}
			?></table><?
		}
		?></div><?
	}
	$arJSParams = array(
		'CONFIG' => array(
			'USE_CATALOG' => $arResult['CATALOG'],
			'SHOW_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
			'SHOW_PRICE' => (isset($arResult['MIN_PRICE']) && !empty($arResult['MIN_PRICE']) && is_array($arResult['MIN_PRICE'])),
			'SHOW_DISCOUNT_PERCENT' => ('Y' == $arParams['SHOW_DISCOUNT_PERCENT']),
			'SHOW_OLD_PRICE' => ('Y' == $arParams['SHOW_OLD_PRICE']),
			'DISPLAY_COMPARE' => ('Y' == $arParams['DISPLAY_COMPARE']),
			'MAIN_PICTURE_MODE' => $arParams['DETAIL_PICTURE_MODE']
		),
		'VISUAL' => array(
			'ID' => $arItemIDs['ID'],
		),
		'PRODUCT_TYPE' => $arResult['CATALOG_TYPE'],
		'PRODUCT' => array(
			'ID' => $arResult['ID'],
			'PICT' => $arFirstPhoto,
			'NAME' => $arResult['~NAME'],
			'SUBSCRIPTION' => true,
			'PRICE' => $arResult['MIN_PRICE'],
			'SLIDER_COUNT' => $arResult['MORE_PHOTO_COUNT'],
			'SLIDER' => $arResult['MORE_PHOTO'],
			'CAN_BUY' => $arResult['CAN_BUY'],
			'CHECK_QUANTITY' => $arResult['CHECK_QUANTITY'],
			'QUANTITY_FLOAT' => is_double($arResult['CATALOG_MEASURE_RATIO']),
			'MAX_QUANTITY' => $arResult['CATALOG_QUANTITY'],
			'STEP_QUANTITY' => $arResult['CATALOG_MEASURE_RATIO'],
			'BUY_URL' => $arResult['~BUY_URL'],
		),
		'BASKET' => array(
			'ADD_PROPS' => ('Y' == $arParams['ADD_PROPERTIES_TO_BASKET']),
			'QUANTITY' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
			'PROPS' => $arParams['PRODUCT_PROPS_VARIABLE'],
			'EMPTY_PROPS' => $emptyProductProperties,
			'BASKET_URL' => $arParams['BASKET_URL']
		)
	);
	unset($emptyProductProperties);
}
?>

<script type="text/javascript">
	var <? echo $strObName; ?> = new JCCatalogElement(<? echo CUtil::PhpToJSObject($arJSParams, false, true); ?>);
	BX.message({
		MESS_BTN_BUY: '<? echo ('' != $arParams['MESS_BTN_BUY'] ? CUtil::JSEscape($arParams['MESS_BTN_BUY']) : GetMessageJS('CT_BCE_CATALOG_BUY')); ?>',
		MESS_BTN_ADD_TO_BASKET: '<? echo ('' != $arParams['MESS_BTN_ADD_TO_BASKET'] ? CUtil::JSEscape($arParams['MESS_BTN_ADD_TO_BASKET']) : GetMessageJS('CT_BCE_CATALOG_ADD')); ?>',
		MESS_NOT_AVAILABLE: '<? echo ('' != $arParams['MESS_NOT_AVAILABLE'] ? CUtil::JSEscape($arParams['MESS_NOT_AVAILABLE']) : GetMessageJS('CT_BCE_CATALOG_NOT_AVAILABLE')); ?>',
		TITLE_ERROR: '<? echo GetMessageJS('CT_BCE_CATALOG_TITLE_ERROR') ?>',
		TITLE_BASKET_PROPS: '<? echo GetMessageJS('CT_BCE_CATALOG_TITLE_BASKET_PROPS') ?>',
		BASKET_UNKNOWN_ERROR: '<? echo GetMessageJS('CT_BCE_CATALOG_BASKET_UNKNOWN_ERROR') ?>',
		BTN_SEND_PROPS: '<? echo GetMessageJS('CT_BCE_CATALOG_BTN_SEND_PROPS'); ?>',
		BTN_MESSAGE_CLOSE: '<? echo GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_CLOSE') ?>',
		SITE_ID: '<? echo SITE_ID; ?>'
	});
</script>