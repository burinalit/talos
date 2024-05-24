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
?>
<div class="news_detail">
    <h2><?=$arResult["NAME"]?></h2>
	<?if($arParams["DISPLAY_DATE"]!="N" && $arResult["DISPLAY_ACTIVE_FROM"]):?>
		<span><?=$arResult["DISPLAY_ACTIVE_FROM"]?></span>
	<?endif;?>
    <?if(!empty($arResult['DETAIL_PICTURE'])):?>
    <div class="news_img"  style="background-image: url(<?echo $arResult["DETAIL_PICTURE"]["SRC"]?>)">
    </div>
    <?endif;?>

	<?if($arResult["NAV_RESULT"]):?>
		<?if($arParams["DISPLAY_TOP_PAGER"]):?><?=$arResult["NAV_STRING"]?><br /><?endif;?>
		<?echo $arResult["NAV_TEXT"];?>
		<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?><br /><?=$arResult["NAV_STRING"]?><?endif;?>
	<?elseif(strlen($arResult["DETAIL_TEXT"])>0):?>
		<?echo $arResult["DETAIL_TEXT"];?>
	<?else:?>
		<?echo $arResult["PREVIEW_TEXT"];?>
	<?endif?>
    <div style="clear: both;"></div>
	<?
	if(array_key_exists("USE_SHARE", $arParams) && $arParams["USE_SHARE"] == "Y")
	{
		?>
		<div class="news-detail-share">
			<noindex>
			<?
			$APPLICATION->IncludeComponent("bitrix:main.share", "", array(
					"HANDLERS" => $arParams["SHARE_HANDLERS"],
					"PAGE_URL" => $arResult["~DETAIL_PAGE_URL"],
					"PAGE_TITLE" => $arResult["~NAME"],
					"SHORTEN_URL_LOGIN" => $arParams["SHARE_SHORTEN_URL_LOGIN"],
					"SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],
					"HIDE" => $arParams["SHARE_HIDE"],
				),
				$component,
				array("HIDE_ICONS" => "Y")
			);
			?>
			</noindex>
		</div>
		<?
	}
	?>
</div>

<?
$arFilter = array("IBLOCK_ID" => $arResult['IBLOCK_ID']);
// Выбиреам записи
$rs = CIBlockElement::GetList(array("ACTIVE_FROM"=>"ASC"),$arFilter,false,false,array('ID','NAME','DETAIL_PAGE_URL'));
$i=0;
while ($ar = $rs -> GetNext()) {
    $arNavi[$i] = $ar;
    // Если ID полученной записи равен ID новости которая отображается, то запоминаем ее номер
    if ($ar['ID'] == $arResult['ID']) $iCurPos = $i;
    $i++;
}
$arLink = array();
$arLink['PREVIOUS'] = isset($arNavi[$iCurPos - 1]) ? $arNavi[$iCurPos - 1] : '';
$arLink['NEXT'] = isset($arNavi[$iCurPos+1]) ? $arNavi[$iCurPos+1] : '';

?>
<div class="news_navigation">
    <div class="prev_next">
        <?
        // Если есть предыдущий элемент то выводим ссылку
        if (is_array($arLink['PREVIOUS']))
        {
            ?>
            <a class="prev" href="<?=$arLink['PREVIOUS']['DETAIL_PAGE_URL']?>">
                <i class="mdi mdi-chevron-left"></i>
                <span class="full"><?=GetMessage("NEWS_PREV")?></span>
            </a>
        <?
        }
        ?>
        <?
        // Если есть следущий элемент то выводим ссылку
        if (is_array($arLink['NEXT']))
        {
            ?>
            <a class="next" href="<?=$arLink['NEXT']['DETAIL_PAGE_URL']?>">
                <span class="full"><?=GetMessage("NEWS_NEXT")?></span>
                <i class="mdi mdi-chevron-right"></i>
            </a>

        <?
        }
        ?>
        <div class="clear_both"></div>
    </div>
</div>
