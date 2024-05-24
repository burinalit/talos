<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<div class="search-page">
	<form action="" method="get">
		<input type="hidden" name="tags" value="<?echo $arResult["REQUEST"]["TAGS"]?>" />
		<input type="hidden" name="how" value="<?echo $arResult["REQUEST"]["HOW"]=="d"? "d": "r"?>" />
		<?if($arParams["USE_SUGGEST"] === "Y"):
			if(strlen($arResult["REQUEST"]["~QUERY"]) && is_object($arResult["NAV_RESULT"]))
			{
				$arResult["FILTER_MD5"] = $arResult["NAV_RESULT"]->GetFilterMD5();
				$obSearchSuggest = new CSearchSuggest($arResult["FILTER_MD5"], $arResult["REQUEST"]["~QUERY"]);
				$obSearchSuggest->SetResultCount($arResult["NAV_RESULT"]->NavRecordCount);
			}
			?>
			<?$APPLICATION->IncludeComponent(
				"bitrix:search.suggest.input",
				"",
				array(
					"NAME" => "q",
					"VALUE" => $arResult["REQUEST"]["~QUERY"],
					"INPUT_SIZE" => -1,
					"DROPDOWN_SIZE" => 10,
					"FILTER_MD5" => $arResult["FILTER_MD5"],
				),
				$component, array("HIDE_ICONS" => "Y")
			);?>
		<?else:?>
			<input class="search-query" type="text" name="q" value="<?=$arResult["REQUEST"]["QUERY"]?>" />
		<?endif;?>
		<input class="search-button" type="submit" value="<?echo GetMessage("CT_BSP_GO")?>" />
	</form>
<?if(isset($arResult["REQUEST"]["ORIGINAL_QUERY"])): ?>
	<div class="search-language-guess">
		<?echo GetMessage("CT_BSP_KEYBOARD_WARNING", array("#query#"=>'<a href="'.$arResult["ORIGINAL_QUERY_URL"].'">'.$arResult["REQUEST"]["ORIGINAL_QUERY"].'</a>'))?>
	</div><br /><?
endif;?>

	<div class="search-result">
	<?if($arResult["REQUEST"]["QUERY"] === false && $arResult["REQUEST"]["TAGS"] === false):?>
	<?elseif($arResult["ERROR_CODE"]!=0):?>
		<p><?=GetMessage("CT_BSP_ERROR")?></p>
		<?ShowError($arResult["ERROR_TEXT"]);?>
		<p><?=GetMessage("CT_BSP_CORRECT_AND_CONTINUE")?></p>
	<?elseif(count($arResult["SEARCH"])>0):?>
		<?if($arParams["DISPLAY_TOP_PAGER"] != "N") echo $arResult["NAV_STRING"]?>	
        <div class="catalog-section_elements catalog_items1">		
		<?foreach($arResult["SEARCH"] as $item): ?>
			<div class="product_list_item">
				<div class="block_line_image">
					<a class="product-item-image-wrapper" href="<?=$item['DETAIL_PAGE_URL']?>" title="<?=$imgTitle?>" data-entity="image-wrapper">
						<img src="<?=$item['PREVIEW_PICTURE']['SRC']?>" alt="<?=$imgTitle?>" />
					</a>
				</div>
				<div class="block_line_content">
					<div class="product-item-title"><a href="<?=$item['DETAIL_PAGE_URL']?>" title="<?=$item['TITLE']?>"><?=$item['TITLE']?></a></div>
					<? if (!empty($arParams['PRODUCT_BLOCKS_ORDER'])){
					foreach ($arParams['PRODUCT_BLOCKS_ORDER'] as $blockName){
						switch ($blockName){
							case 'props':
								if (!$haveOffers){
									if (!empty($item['DISPLAY_PROPERTIES'])){ ?>
										<div class="product-item-info" data-entity="props-block">
											<div class="items_list">
											<? foreach ($item['DISPLAY_PROPERTIES'] as $key => $displayProperty){
												if($item['IBLOCK_SECTION_ID'] == 7){
													if($displayProperty['CODE'] != 'K_MMOSCH' && $displayProperty['CODE'] != 'K_NAPR' && $displayProperty['CODE'] != 'K_SILAT'){
														continue;
													}
												}
												if($item['IBLOCK_SECTION_ID'] == 9){
													if($displayProperty['CODE'] != 'K_MMOSCH_DVIG' && $displayProperty['CODE'] != 'K_MAXPROIZ' && $displayProperty['CODE'] != 'K_DIAMPAR'){
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
											</div>
											<div class="items_list">
											<? foreach ($item['DISPLAY_PROPERTIES'] as $key => $displayProperty){
												if($item['IBLOCK_SECTION_ID'] == 7){
													if($displayProperty['CODE'] != 'K_OBBAZ'){
														continue;
													}
												}
												if($item['IBLOCK_SECTION_ID'] == 9){
													if($displayProperty['CODE'] != 'K_OBBAZ'){
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
										</div>
									<? } 
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
								Подробнее
							</a>
						</div>
					</div>
				</div>
			</div>
		<?endforeach;?>
		</div>
		<?if($arParams["DISPLAY_BOTTOM_PAGER"] != "N") echo $arResult["NAV_STRING"]?>
		<?if($arParams["SHOW_ORDER_BY"] != "N"):?>
			<div class="search-sorting"><label><?echo GetMessage("CT_BSP_ORDER")?>:</label>&nbsp;
			<?if($arResult["REQUEST"]["HOW"]=="d"):?>
				<a href="<?=$arResult["URL"]?>&amp;how=r"><?=GetMessage("CT_BSP_ORDER_BY_RANK")?></a>&nbsp;<b><?=GetMessage("CT_BSP_ORDER_BY_DATE")?></b>
			<?else:?>
				<b><?=GetMessage("CT_BSP_ORDER_BY_RANK")?></b>&nbsp;<a href="<?=$arResult["URL"]?>&amp;how=d"><?=GetMessage("CT_BSP_ORDER_BY_DATE")?></a>
			<?endif;?>
			</div>
		<?endif;?>
	<?else:?>
		<?ShowNote(GetMessage("CT_BSP_NOTHING_TO_FOUND"));?>
	<?endif;?>

	</div>
</div>