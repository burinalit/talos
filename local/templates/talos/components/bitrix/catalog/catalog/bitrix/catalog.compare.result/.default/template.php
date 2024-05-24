<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if(count($arResult["ITEMS_TO_ADD"])>0):?>
<p>
<form action="<?=$APPLICATION->GetCurPage()?>" method="get">
	<input type="hidden" name="IBLOCK_ID" value="<?=$arParams["IBLOCK_ID"]?>" />
	<input type="hidden" name="action" value="ADD_TO_COMPARE_RESULT" />
	<select name="id">
	<?foreach($arResult["ITEMS_TO_ADD"] as $ID=>$NAME):?>
		<option value="<?=$ID?>"><?=$NAME?></option>
	<?endforeach?>
	</select>
	<input type="submit" value="<?=GetMessage("CATALOG_ADD_TO_COMPARE_LIST")?>" />
</form>
</p>
<?endif?>

<div class="catalog-compare-result">
	<div class="head clear">
		<h1><?=GetMessage("CATALOG_COMPARE_TITLE")?></h1>
        </div>
    <div class="">
		<div class="control col-xs-3">
			<noindex>
			<form class="compare-switch" name="compare-switch">

				<?if($arResult["DIFFERENT"]) {?>


					<a href="<?=htmlspecialcharsbx($APPLICATION->GetCurPageParam("DIFFERENT=N",array("DIFFERENT")))?>" rel="nofollow"><?=GetMessage("CATALOG_ALL_CHARACTERISTICS")?></a>
					<span><?=GetMessage("CATALOG_ONLY_DIFFERENT")?></span>
				<?} else {?>


					<span><?=GetMessage("CATALOG_ALL_CHARACTERISTICS")?></span>
					<a href="<?=htmlspecialcharsbx($APPLICATION->GetCurPageParam("DIFFERENT=Y",array("DIFFERENT")))?>" rel="nofollow"><?=GetMessage("CATALOG_ONLY_DIFFERENT")?></a>
				<?}?>

			</form>
			</noindex>
		</div>

		<form class="item_top col-xs-9" name="compare_item_form" action="<?=$APPLICATION->GetCurPage()?>" method="get">
			<div class="item-list emarket-mSlider">
				<div class="mSlider-wrap">
					<ul class="mSlider-window">
					<?foreach($arResult["ITEMS"] as $key => $arElement) {?>
						<li data-slide="<?=$key?>" class="slide <?if(!$key) echo 'current';?>">
							<?//echo '<pre>'; print_r($arElement); echo '</pre>';?>
							<div class="slide-wrap">

									<a href="<?=$arElement['DETAIL_PAGE_URL']?>" title="<?=$arElement['NAME']?>">
                                                                            <?if($arElement['PREVIEW_PICTURE']["SRC"]):?>
                                                                            <div class="picture" style="background: url(<?=$arElement['PREVIEW_PICTURE']["SRC"]?>);"></div>
                                                                             <?else:?>
                                                                            <div class="picture" style="background: url(<?=$arElement['DETAIL_PICTURE']["SRC"]?>);"></div>
                                                                            <?endif;?>
									</a>

								<h3><?=$arElement['NAME']?></h3>

								<div class="price">
								<?if($arElement["PRICES"]["BASE"]["DISCOUNT_DIFF_PERCENT"]):?>
									<?=$arElement["PRICES"]["BASE"]["PRINT_DISCOUNT_VALUE_VAT"]?>
                                                                        <!-- <span><?=$arElement["PRICES"]["BASE"]["PRINT_VALUE_NOVAT"]?></span> !-->
                                                                <?else:?>
                                                                        <?=$arElement["PRICES"]["BASE"]["PRINT_VALUE_NOVAT"]?>
								<?endif;?>
                                                                </div>
							</div>
                                                    <div class="mdi mdi-close">
                                                        <input type="submit" name="ID[]" value="<?=$arElement["ID"]?>" class="close">
                                                    </div>
						</li>

					<?}?>
					</ul>
				</div>
				<a href="/error_js.php" class="mSlider-prev mdi mdi-chevron-left"></a>
				<a href="/error_js.php" class="mSlider-next mdi mdi-chevron-right active"></a>
			</div>
			<input type="hidden" name="action" value="DELETE_FROM_COMPARE_RESULT" />
			<input type="hidden" name="IBLOCK_ID" value="<?=$arParams["IBLOCK_ID"]?>" />
		</form>
        <div class="clear_both"></div>
	</div>

	<div class="property-list ">
		<h2><?=GetMessage("CHARACTERISTICS")?></h2>
		<div class="clear row">
		<?foreach($arResult["SHOW_PROPERTIES"] as $code=>$arProperty):
			$arCompare = Array();
			foreach($arResult["ITEMS"] as $arElement)
			{
				$arPropertyValue = $arElement["DISPLAY_PROPERTIES"][$code]["VALUE"];
				if(is_array($arPropertyValue))
				{
					sort($arPropertyValue);
					$arPropertyValue = implode(" / ", $arPropertyValue);
				}
				$arCompare[] = $arPropertyValue;
			}
			$diff = (count(array_unique($arCompare)) > 1 ? true : false);
			if($diff || !$arResult["DIFFERENT"]):?>
                                <div class="col-xs-12">
				<div class="property-name col-xs-3"><p><?=$arProperty["NAME"]?></p></div>
				<div class="property-value emarket-mSlider col-xs-9">
					<div class="mSlider-wrap">
						<ul class="mSlider-window">
						<?foreach($arResult["ITEMS"] as $key => $arElement) {?>
							<li data-slide="<?=$key?>" class="slide-prop <?if(!$key) echo 'current';?>">
								<div class="slide-wrap"><p>
									<?
									if($diff)
									{
										if(is_array($arElement["DISPLAY_PROPERTIES"][$code]["DISPLAY_VALUE"]))
										{
											echo implode("/ ", $arElement["DISPLAY_PROPERTIES"][$code]["DISPLAY_VALUE"]);
										}
										else
										{
											if($arElement["DISPLAY_PROPERTIES"][$code]["DISPLAY_VALUE"] == 'Y')
												echo '????';
											else
												echo $arElement["DISPLAY_PROPERTIES"][$code]["DISPLAY_VALUE"];
										}
									}
									else
									{
										if(is_array($arElement["DISPLAY_PROPERTIES"][$code]["DISPLAY_VALUE"]))
										{
											echo implode("/ ", $arElement["DISPLAY_PROPERTIES"][$code]["DISPLAY_VALUE"]);
										}
										else
										{
											if($arElement["DISPLAY_PROPERTIES"][$code]["DISPLAY_VALUE"] == 'Y')
												echo '????';
											else
												echo $arElement["DISPLAY_PROPERTIES"][$code]["DISPLAY_VALUE"];
										}
									}
									?>&nbsp; </p>
								</div>
							</li>
						<?}?>
						</ul>
					</div>
				</div>
                                </div>
			<?endif?>
		<?endforeach;?>
		</div>
	</div>




	<table>
		<?foreach($arResult["SHOW_OFFER_FIELDS"] as $code):
			$arCompare = Array();
			foreach($arResult["ITEMS"] as $arElement)
			{
				$Value = $arElement["OFFER_FIELDS"][$code];
				if(is_array($Value))
				{
					sort($Value);
					$Value = implode(" / ", $Value);
				}
				$arCompare[] = $Value;
			}
			$diff = (count(array_unique($arCompare)) > 1 ? true : false);
			if($diff || !$arResult["DIFFERENT"]):?>
				<tr>
					<th valign="top" nowrap>&nbsp;<?=GetMessage("IBLOCK_FIELD_".$code)?>&nbsp;</th>
					<?foreach($arResult["ITEMS"] as $arElement):?>
						<?if($diff):?>
						<td valign="top">&nbsp;
							<?=(is_array($arElement["OFFER_FIELDS"][$code])? implode("/ ", $arElement["OFFER_FIELDS"][$code]): $arElement["OFFER_FIELDS"][$code])?>
						</td>
						<?else:?>
						<th valign="top">&nbsp;
							<?=(is_array($arElement["OFFER_FIELDS"][$code])? implode("/ ", $arElement["OFFER_FIELDS"][$code]): $arElement["OFFER_FIELDS"][$code])?>
						</th>
						<?endif?>
					<?endforeach?>
				</tr>
			<?endif?>
		<?endforeach;?>


		<?foreach($arResult["SHOW_OFFER_PROPERTIES"] as $code=>$arProperty):
			$arCompare = Array();
			foreach($arResult["ITEMS"] as $arElement)
			{
				$arPropertyValue = $arElement["OFFER_DISPLAY_PROPERTIES"][$code]["VALUE"];
				if(is_array($arPropertyValue))
				{
					sort($arPropertyValue);
					$arPropertyValue = implode(" / ", $arPropertyValue);
				}
				$arCompare[] = $arPropertyValue;
			}
			$diff = (count(array_unique($arCompare)) > 1 ? true : false);
			if($diff || !$arResult["DIFFERENT"]):?>
				<tr>
					<th valign="top" nowrap>&nbsp;<?=$arProperty["NAME"]?>&nbsp;</th>
					<?foreach($arResult["ITEMS"] as $arElement):?>
						<?if($diff):?>
						<td valign="top">&nbsp;
							<?=(is_array($arElement["OFFER_DISPLAY_PROPERTIES"][$code]["DISPLAY_VALUE"])? implode("/ ", $arElement["OFFER_DISPLAY_PROPERTIES"][$code]["DISPLAY_VALUE"]): $arElement["OFFER_DISPLAY_PROPERTIES"][$code]["DISPLAY_VALUE"])?>
						</td>
						<?else:?>
						<th valign="top">&nbsp;
							<?=(is_array($arElement["OFFER_DISPLAY_PROPERTIES"][$code]["DISPLAY_VALUE"])? implode("/ ", $arElement["OFFER_DISPLAY_PROPERTIES"][$code]["DISPLAY_VALUE"]): $arElement["OFFER_DISPLAY_PROPERTIES"][$code]["DISPLAY_VALUE"])?>
						</th>
						<?endif?>
					<?endforeach?>
				</tr>
			<?endif?>
		<?endforeach;?>
	</table>


	<?if(!empty($arResult["DELETED_PROPERTIES"]) || !empty($arResult["DELETED_OFFER_FIELDS"]) || !empty($arResult["DELETED_OFFER_PROPS"])):?>
		<noindex><p>
		<?=GetMessage("CATALOG_REMOVED_FEATURES")?>:
		<?foreach($arResult["DELETED_PROPERTIES"] as $arProperty):?>
			<a href="<?=htmlspecialcharsbx($APPLICATION->GetCurPageParam("action=ADD_FEATURE&pr_code=".$arProperty["CODE"],array("op_code","of_code","pr_code","action")))?>" rel="nofollow"><?=$arProperty["NAME"]?></a>
		<?endforeach?>
		<?foreach($arResult["DELETED_OFFER_FIELDS"] as $code):?>
			<a href="<?=htmlspecialcharsbx($APPLICATION->GetCurPageParam("action=ADD_FEATURE&of_code=".$code,array("op_code","of_code","pr_code","action")))?>" rel="nofollow"><?=GetMessage("IBLOCK_FIELD_".$code)?></a>
		<?endforeach?>
		<?foreach($arResult["DELETED_OFFER_PROPERTIES"] as $arProperty):?>
			<a href="<?=htmlspecialcharsbx($APPLICATION->GetCurPageParam("action=ADD_FEATURE&op_code=".$arProperty["CODE"],array("op_code","of_code","pr_code","action")))?>" rel="nofollow"><?=$arProperty["NAME"]?></a>
		<?endforeach?>
		</p></noindex>
	<?endif?>
</div>
<?//echo '<pre>'; print_r($arResult); echo '</pre>';?>