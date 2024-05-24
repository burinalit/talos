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
<div class="block_line_image">
    <a class="product-item-image-wrapper" href="<?=$item['DETAIL_PAGE_URL']?>" title="<?=$imgTitle?>" data-entity="image-wrapper">
        <img src="<?=$item['PREVIEW_PICTURE']['SRC']?>" alt="<?=$imgTitle?>" />
    </a>
</div>
<div class="block_line_content">
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
						
					<?  
				}
			break;
		}
	}
    } ?>
</div>
<div class="block_line_buttons">
	<div class="product-item-buttons" data-entity="buttons-block">
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
		<div class="product-item-button">
			<a class="btn btn-default" href="<?=$item['DETAIL_PAGE_URL']?>">
				<?=$arParams['MESS_BTN_DETAIL']?>
			</a>
		</div>
	</div>
</div>