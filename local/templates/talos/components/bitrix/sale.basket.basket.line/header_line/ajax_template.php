<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

$this->IncludeLangFile('template.php');

$cartId = $arParams['cartId'];

require(realpath(dirname(__FILE__)).'/top_template.php');

if ($arParams["SHOW_PRODUCTS"] == "Y" && $arResult['NUM_PRODUCTS'] > 0)
{
?>
	<div data-role="basket-item-list" class="bx-basket-item-list">

		<?if ($arParams["POSITION_FIXED"] == "Y"):?>
			<div id="<?=$cartId?>status" class="bx-basket-item-list-action" onclick="<?=$cartId?>.toggleOpenCloseCart()"><?=GetMessage("TSB1_COLLAPSE")?></div>
		<?endif?>

		<div id="<?=$cartId?>products" class="bx-basket-item-list-container">
			<?foreach ($arResult["CATEGORIES"] as $category => $items):
				if (empty($items))
					continue;
				?>
				<?foreach ($items as $v):?>
					<div class="bx-basket-item-list-item">
                                            <div class="bx-basket-item-list-item-remove mdi mdi-close" onclick="<?=$cartId?>.removeItemFromCart(<?=$v['ID']?>)" title="<?=GetMessage("TSB1_DELETE")?>"></div>

							<?if ($arParams["SHOW_IMAGE"] == "Y" && $v["PICTURE_SRC"]):?>

								<?if($v["DETAIL_PAGE_URL"]):?>
                                                                <a href="<?=$v["DETAIL_PAGE_URL"]?>">
                                                                    <div class="bx-basket-item-list-item-img" style="background-image: url(<?=$v["PICTURE_SRC"]?>);" alt="<?=$v["NAME"]?>">
                                                                    </div>
                                                                </a>
								<?else:?>
                                                                    <div class="bx-basket-item-list-item-img" style="background-image: url(<?=$v["PICTURE_SRC"]?>);" alt="<?=$v["NAME"]?>"></div>
								<?endif?>

							<?endif?>
						<div class="basket_content">
                                                    <div class="bx-basket-item-list-item-name">
                                                            <?if ($v["DETAIL_PAGE_URL"]):?>
                                                                    <a href="<?=$v["DETAIL_PAGE_URL"]?>"><?=$v["NAME"]?></a>
                                                            <?else:?>
                                                                    <?=$v["NAME"]?>
                                                            <?endif?>
                                                            <div class="clear_both"></div>
                                                    </div>
                                                    <?if (true):/*$category != "SUBSCRIBE") TODO */?>
                                                            <div class="price">
                                                                    <?if ($arParams["SHOW_PRICE"] == "Y"):?>
                                                                            <?=$v["PRICE_FMT"]?>
                                                                            <?if ($v["FULL_PRICE"] != $v["PRICE_FMT"]):?>
                                                                                    <span><?=$v["FULL_PRICE"]?></span>
                                                                            <?endif?>
                                                                    <?endif?>
                                                                    <?if ($arParams["SHOW_SUMMARY"] == "Y"):?>
                                                                            <div class="bx-basket-item-list-item-price-summ">
                                                                                    <strong><?=$v["QUANTITY"]?></strong> <?=$v["MEASURE_NAME"]?> <?=GetMessage("TSB1_SUM")?>
                                                                                    <strong><?=$v["SUM"]?></strong>
                                                                            </div>
                                                                    <?endif?>
                                                            </div>
                                                    <?endif?>
                                                </div>
                                                <div class="clear_both"></div>
					</div>
				<?endforeach?>
			<?endforeach?>
		</div>
                <div class="total_price">
                    <?=GetMessage("TOTAL_PRICE")?> <? echo $arResult["TOTAL_PRICE"];?>
                </div>
                <?if ($arParams["PATH_TO_BASKET"] && $arResult["CATEGORIES"]["READY"]):?>
			<div class="bx-basket-item-list-button-container">
				<a href="<?=$arParams["PATH_TO_BASKET"]?>" class="btn btn_blue"><?=GetMessage("TSB1_2ORDER")?></a>
			</div>
		<?endif?>

	</div>

	<script>
		BX.ready(function(){
			<?=$cartId?>.fixCart();
		});

        
	</script>
<?
}