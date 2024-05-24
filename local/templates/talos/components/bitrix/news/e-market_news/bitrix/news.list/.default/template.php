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
<div class="news-list">
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
    <div class="news row">
        <div class="col-xs-12">
            <h2><?=$arResult['NAME']?></h2>
            <div>
            <?foreach($arResult["ITEMS"] as $arItem):?>
                        <?
                        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                        ?>
                <div class="item col-xs-12 col-sm-6" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                    <a class="news_img col-xs-4" href="<?echo $arItem["DETAIL_PAGE_URL"]?>" style="background-image: url(<?echo $arItem["PREVIEW_PICTURE"]["SRC"]?>)">                

                    </a>

                    <!-- <a class="news_img col-xs-4" href="<?echo $arItem["DETAIL_PAGE_URL"]?>">                
                        <?
                            $renderImage = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], Array("width" => 170, "height" => 135), BX_RESIZE_IMAGE_EXACT, false);
                            echo '<img alt="'.$arItem["NAME"].'" src="'.$renderImage["src"].'" />';
                        ?>
                    </a> !-->
                    <div class="news_content col-xs-8">
                        <span><?echo $arItem["ACTIVE_FROM"]?></span>
                        <a href="<?echo $arItem["DETAIL_PAGE_URL"]?>">
                            <h3><?echo $arItem["NAME"]?></h3>
                        </a>
                        <?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
                            <p><?echo $arItem["PREVIEW_TEXT"];?></p>
                        <?endif;?>
                    </div>
                </div>    
            <?endforeach;?>
            <div class="clear_both"></div>
            </div>
        </div>
    </div>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>
